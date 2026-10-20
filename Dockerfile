FROM php:8.4-fpm-bookworm AS app

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    ca-certificates

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (pdo_mysql TiDB-এর জন্য জরুরি)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents (ca.pem সহ সব ফাইল এখানে কপি হবে)
COPY . /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# ✅ জরুরি: Laravel storage এবং bootstrap/cache ফোল্ডারের পারমিশন ঠিক করা
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ✅ জরুরি: ca.pem ফাইলটি যাতে PHP পড়তে পারে তা নিশ্চিত করা
RUN chmod 644 /var/www/html/ca.pem

# Copy nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# ==========================================
# FRONTEND BUILD STAGE
# ==========================================
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json pnpm-lock.yaml ./
RUN corepack enable \
    && corepack prepare pnpm@10.23.0 --activate \
    && pnpm install --frozen-lockfile

COPY resources ./resources
COPY vite.config.js ./
COPY --from=app /var/www/html/vendor/laravel/framework/src/Illuminate/Pagination/resources/views ./vendor/laravel/framework/src/Illuminate/Pagination/resources/views
RUN pnpm build

# ==========================================
# FINAL RUNTIME STAGE
# ==========================================
FROM app AS runtime

# Copy built frontend assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# ✅ Render-এর জন্য পোর্ট ১০০০০ এক্সপোজ করা (বাধ্যতামূলক)
EXPOSE 10000

# Start supervisor
CMD ["supervisord", "-n", "-c", "/var/www/html/supervisord.conf"]

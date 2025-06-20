# Node.js stage for building assets
FROM node:22-alpine AS node
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# PHP production stage
FROM ubuntu:24.04

LABEL maintainer="SonicStack"

# Set environment variables
ENV DEBIAN_FRONTEND=noninteractive \
    TZ=UTC \
    SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan octane:start --server=swoole --host=0.0.0.0 --port=8000 --workers=auto --task-workers=auto"

# Install system dependencies and PHP repository
RUN apt-get update && apt-get install -y \
        ca-certificates \
        curl \
        gnupg \
        libvips \
        libvips-dev \
        lsb-release \
        software-properties-common \
        sqlite3 \
        supervisor \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    \
    # Install PHP 8.3 and extensions
    && apt-get install -y \
        php8.3-cli \
        php8.3-common \
        php8.3-bcmath \
        php8.3-curl \
        php8.3-dom \
        php8.3-ffi \
        php8.3-gmp \
        php8.3-intl \
        php8.3-mbstring \
        php8.3-opcache \
        php8.3-pdo \
        php8.3-pgsql \
        php8.3-redis \
        php8.3-sqlite3 \
        php8.3-swoole \
        php8.3-xml \
        php8.3-zip \
    \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY --chown=ubuntu:ubuntu . .

# Copy built assets from node stage
COPY --from=node --chown=ubuntu:ubuntu /app/public/build ./public/build

# Copy packages from checked out repo
COPY --chown=ubuntu:ubuntu ./packages-repo/laravel ./packages/laravel

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy configuration files
COPY --chown=root:root _docker/files/99-custom-php.ini /etc/php/8.3/cli/conf.d/99-custom-php.ini
COPY --chown=root:root _docker/files/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set proper permissions
RUN chown -R ubuntu:ubuntu /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8000

# Switch to non-root user
USER ubuntu

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8000/health || exit 1

# Start supervisor
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

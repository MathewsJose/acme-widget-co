# Use official PHP 8.3 CLI image
FROM php:8.3-cli

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install

# Default command
CMD ["php", "bin/run.php"]

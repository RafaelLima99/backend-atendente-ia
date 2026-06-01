FROM php:8.2-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev

# Extensões PHP necessárias pro Laravel
RUN docker-php-ext-install zip pdo pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório da aplicação
WORKDIR /app

# Copia projeto
COPY . .

# Instala dependências
RUN composer install

# Permissões (Laravel)
RUN chown -R www-data:www-data /app
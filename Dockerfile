# Use a imagem oficial do PHP como base
FROM php:8.0-fpm

# Atualize e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  zip \
  unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd pdo pdo_mysql

# Configure o diretório de trabalho
WORKDIR /var/www/html

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie os arquivos do projeto para o contêiner
COPY . .

# Instale as dependências do Composer
RUN composer install

# Expõe a porta 9000 para o servidor PHP-FPM
EXPOSE 9000

# Comando para iniciar o servidor PHP-FPM
CMD ["php-fpm"]

# Usar PHP 8.2 con FPM como base
FROM php:8.2-fpm

# Metadatos
LABEL Name="gestion-proyectos" \
      Version="1.0" \
      Description="Imagen Docker para el proyecto Laravel gestion-proyectos"

# Actualizar e instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip nodejs npm \
    && docker-php-ext-install zip pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto al contenedor
COPY . .

# Instalar dependencias PHP sin paquetes de desarrollo y optimizar autoloaders
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias Node.js y construir assets
RUN npm install && npm run build

# Generar clave de aplicación Laravel (solo si no está ya generada)
RUN php artisan key:generate

# Exponer el puerto para PHP-FPM
EXPOSE 9000

# Ejecutar PHP-FPM en primer plano
CMD ["php-fpm", "-F"]

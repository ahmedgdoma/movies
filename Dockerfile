#pull image
FROM php:7.2-apache

# start php config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

#install git
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y vim && \
    apt-get install -y cron
#copy cron file
COPY movies-cron /etc/cron.d/

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/movies-cron

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Give read rights on the cron job
RUN chmod 777 /var/log/cron.log

#install php mysql
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#change working directory
WORKDIR /var/www/html



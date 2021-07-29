FROM wyveo/nginx-php-fpm:latest
WORKDIR /usr/share/nginx/
RUN rm -rf /usr/share/ngix/html
RUN ln -s public html

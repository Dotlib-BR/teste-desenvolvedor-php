FROM wyveo/nginx-php-fpm:latest
WORKDIR /usr/share/nginx/
RUN rm -rf /usr/share/ngix/html
RUN ln -s public html
RUN apt-get install && apt-get update
RUN apt-get install -y nodejs npm

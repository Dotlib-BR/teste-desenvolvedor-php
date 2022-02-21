FROM wyveo/nginx-php-fpm:latest

COPY . /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

RUN ln -s public html

RUN apt update; \
    apt install nano -y; \
    apt install nodejs -y; \
    apt install npm -y

EXPOSE 80

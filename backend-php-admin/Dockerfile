FROM php:7.2-apache

ENV LC_ALL=C.UTF-8
ENV DEBIAN_FRONTEND noninteractive
ENV DB_HOST "127.0.0.1"
ENV DB_NAME "unitcode"
ENV DB_USER "unitcode"
ENV DB_USER_PASSWORD "unitcode123"
ENV IMPORT_FILE default_env_value

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y default-mysql-server mysql-common default-mysql-client
RUN docker-php-ext-install pdo_mysql

RUN cat /etc/mysql/my.cnf
RUN /etc/init.d/mysql start
RUN sleep 5;
RUN ls -l /var/run/ | grep mysqld

COPY ./ /var/www/html/
WORKDIR /var/www/html/

CMD [ "php", "./index.php", "${IMPORT_FILE}" ]

EXPOSE 80
EXPOSE 443
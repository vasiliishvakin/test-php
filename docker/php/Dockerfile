FROM php:fpm-bullseye

RUN apt-get update && apt-get -y dist-upgrade

RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo UTC > /etc/timezone

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apt-get update && apt-get -y install git mc ssh wget curl ca-certificates iputils-ping bind9-dnsutils

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd pdo_mysql redis apcu imagick yaml igbinary mbstring xml bcmath gmp decimal bz2 curl intl opcache xsl zip xdebug msgpack

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal;" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=develop,coverage,debug,profile;" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request = trigger;" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.profiler_output_name=cachegrind.out.%t;" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.output_dir = /var/lib/php/profiling;" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

ADD https://github.com/gordalina/cachetool/releases/latest/download/cachetool.phar /usr/local/bin
RUN chmod +x /usr/local/bin/cachetool.phar && mv /usr/local/bin/cachetool.phar /usr/local/bin/cachetool

#RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash - &&\
#    apt-get install -y nodejs

RUN rm -rf /var/lib/apt/lists/*

FROM debian:9.3

ARG SYSTEM_TZ

ENV SYSTEM_TZ_ENV=$SYSTEM_TZ
ENV \
    # Environment variable to use in derived images to find exact paths
    ETC_HTTPD=/etc/apache2 \
    DOCUMENT_ROOT=/var/www/html

RUN set -xe \
    && export DEBIAN_FRONTEND=noninteractive \
    && apt-get update \
    && apt-get -y install \
        apt-utils \
        apache2 \
        apt-transport-https \
        lsb-release \
        ca-certificates \
        curl \
        zip \
        unzip \
        alien \
        libgcj-common \
        ghostscript \
        git \
        wget \
        fontconfig \
        fonts-liberation \
        xdg-utils \
        libasound2 \
        libatk1.0-0 \
        libcairo2 \
        libgtk-3-0 \
        libpango-1.0-0 \
        libappindicator3-1 \
        libxss1

RUN set -xe \
    && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && curl -o- -L https://deb.nodesource.com/setup_16.x | bash \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN set -xe \
    && apt-get update \
    && apt-get -y install \
        php7.4 \
        php7.4-dev \
        php7.4-bcmath \
        php7.4-common \
        php7.4-curl \
        php7.4-dom \
        php7.4-gd \
        php7.4-imagick \
        php7.4-mbstring \
        php7.4-mysqli \
        php7.4-mysqlnd \
        php7.4-pdo \
        php7.4-tidy \
        php7.4-xml \
        php7.4-xdebug \
        php7.4-zip \
        php7.4-intl \
        libapache2-mod-php7.4 \
        php-pear \
        libmcrypt-dev \
        pdftk \
        nodejs \
        yarn \
    && apt-get -y upgrade

RUN set -xe \
    # Composer
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer && chmod +x /usr/local/bin/composer

RUN set -xe \
    && update-alternatives --set php /usr/bin/php7.4

RUN ln -snf /usr/share/zoneinfo/$SYSTEM_TZ /etc/localtime && echo $SYSTEM_TZ > /etc/timezone

# Customize php setup
RUN set -xe \
    && /bin/echo 'date.timezone='"${SYSTEM_TZ}" > "/etc/php/7.4/mods-available/custom.ini" \
    && ln -s "/etc/php/7.4/mods-available/custom.ini" "/etc/php/7.4/apache2/conf.d/40-custom.ini"

WORKDIR $DOCUMENT_ROOT

COPY composer.json ./
COPY composer.lock ./
RUN composer install --no-scripts --no-autoloader

COPY . ./
RUN composer install --no-scripts

RUN set -x && chown -R www-data ${DOCUMENT_ROOT} && chmod -R 0777 ${DOCUMENT_ROOT}/storage/logs

RUN /bin/echo -e '\
ErrorLog "/dev/stderr"\n\
CustomLog "/dev/stdout" common\n\
<VirtualHost *:80>\n\
    DocumentRoot "${DOCUMENT_ROOT}/public"\n\
    <Directory "${DOCUMENT_ROOT}/public">\n\
        AllowOverride All\n\
    </Directory>\n\
</VirtualHost>\n\
' > ${ETC_HTTPD}/sites-available/000-default.conf

RUN a2enmod rewrite

RUN /bin/echo -e "#!/bin/bash\n\
chmod 0777 ${DOCUMENT_ROOT}/public\n\
exec apachectl -D FOREGROUND\n\
" > /usr/sbin/docker-entrypoint.sh \
    && chmod +x /usr/sbin/docker-entrypoint.sh

CMD /usr/sbin/docker-entrypoint.sh

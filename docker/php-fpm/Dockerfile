FROM alpine:3.9
ARG php_version=7.3.2
ARG node_version=10.15.3
ARG time_zone="Asia/Tokyo"
ENV PREFIX="/usr/local" \
    PHP_INI_DIR="/usr/local/etc/php" \
    SESSION_SAVE_PATH="/var/lib/php/session"
RUN apk --update --no-cache add \
    ca-certificates \
    curl \
    tar \
    xz \
    openssl \
    gcc \
    g++ \
    libedit-dev \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    icu-dev \
    argon2-dev \
  && apk --no-cache add --virtual build-dependencies \
    autoconf \
    dpkg-dev dpkg \
    file \
    libc-dev \
    make \
    pkgconf \
    re2c \
    coreutils \
    curl-dev \
    libsodium-dev \
    openssl-dev \
    sqlite-dev \
    linux-headers \
    python \
  && : "PHP-FPMインストール" \
  && curl -SLo php.tar.xz http://jp2.php.net/get/php-${php_version}.tar.xz/from/this/mirror \
  && tar -Jxvf php.tar.xz \
  && cd php-${php_version} \
  && ./configure \
      --prefix="$PREFIX" \
      --with-config-file-path="$PHP_INI_DIR" \
      --with-config-file-scan-dir="$PHP_INI_DIR/conf.d" \
      --enable-option-checking=fatal \
      --with-mhash \
      --enable-mysqlnd \
      --with-openssl \
      --with-zlib \
      --enable-exif \
      --with-gd \
      --with-libedit \
      --enable-mbstring \
      --enable-pcntl \
      --enable-soap \
      --enable-zip \
      --enable-fpm \
      --enable-opcache \
      --with-curl \
      --enable-intl \
      --with-pdo-mysql \
      --with-password-argon2 \
    && make -j "$(nproc)"\
    && make install \
    && cd / \
    && : "node.jsインストール" \
    && curl -SLo node.tar.gz https://nodejs.org/dist/v10.15.3/node-v${node_version}.tar.gz \
    && tar -zxvf node.tar.gz \
    && cd node-v${node_version} \
    && ./configure \
        --prefix="$PREFIX" \
    && make -j "$(nproc)" \
    && make install \
    && cd / \
    && : "タイムゾーン合わせ" \
    && apk add tzdata \
    && cp "/usr/share/zoneinfo/${time_zone}" /etc/localtime \
    && : "不要ファイルの削除" \
    && apk del build-dependencies \
    && apk del tzdata \
    && rm -rf \
       php-${php_version} \
       php.tar.xz \
       node-v${node_version} \
       node.tar.gz \
       /var/cache/apk/* \
    && : "ユーザ作成" \
    && addgroup -g 1000 -S www-data \
    && adduser -u 1000 -D -S -h /var/cache/www-data -s /sbin/nologin -G www-data www-data \
    && : "ディレクトリ関連" \
    && cp $PREFIX/etc/php-fpm.conf.default $PREFIX/etc/php-fpm.conf \
    && mkdir -p "$PHP_INI_DIR/conf.d" \
    && mkdir -p "$SESSION_SAVE_PATH" \
    && chown www-data:www-data "$SESSION_SAVE_PATH" \
    && chmod 777 "$SESSION_SAVE_PATH" \
    && mkdir -p /var/www/html \
	  && chown www-data:www-data /var/www/html \
    && chmod 777 /var/www/html \
    && : "composer 1.8.5をインストール" \
    && curl -sS https://raw.githubusercontent.com/composer/getcomposer.org/5eb0614d3fa7130b363698d3dca52c619b463615/web/installer | php \
    && mv composer.phar /usr/local/bin/composer
COPY ./www.conf $PREFIX/etc/php-fpm.d/www.conf
COPY ./php.ini $PHP_INI_DIR/php.ini
WORKDIR /var/www
CMD ["php-fpm", "-F"]

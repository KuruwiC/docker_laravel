FROM alpine:3.9
ARG nginx_version=1.15.9
ENV TZ="Asia/Tokyo"
# ソースからnginxをインストールする
RUN apk --update --no-cache add pcre-dev openssl-dev zlib-dev \
  && apk add --no-cache --virtual build-dependencies build-base curl \
  && addgroup -g 82 -S www-data \
  && adduser -u 82 -D -S -h /var/cache/www-data -s /sbin/nologin -G www-data www-data \
  && curl -SLO http://nginx.org/download/nginx-${nginx_version}.tar.gz \
  && tar xzvf nginx-${nginx_version}.tar.gz \
  && cd nginx-${nginx_version} \
  && ./configure \
      --prefix=/etc/nginx \
      --sbin-path=/usr/sbin/nginx \
      --modules-path=/usr/lib/nginx/modules \
      --conf-path=/etc/nginx/nginx.conf \
      --error-log-path=/var/log/nginx/error.log \
      --http-log-path=/var/log/nginx/access.log \
      --pid-path=/var/run/nginx.pid \
      --user=www-data \
      --group=www-data \
      --with-http_ssl_module \
      --with-http_gzip_static_module \
  && make -j "$(nproc)" \
  && make install \
  && : "ログの出力先をstdout, stderrのシンボリックリンクにする" \
  && ln -sf /dev/stdout /var/log/nginx/access.log \
  && ln -sf /dev/stderr /var/log/nginx/error.log \
  && cd / \
  && : "タイムゾーン合わせ" \
  && apk add tzdata \
  && cp "/usr/share/zoneinfo/$TZ" /etc/localtime \
  && : "不要ファイルの削除" \
  && apk del build-dependencies \
  && apk del tzdata \
  && rm -rf \
     nginx-${nginx_version} \
     nginx-${nginx_version}.tar.gz \
     /var/cache/apk/*
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./default.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]

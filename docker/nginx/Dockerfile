FROM alpine:3.9
ENV NGINX_VERSION 1.15.9
# ソースからnginxをインストールする
RUN apk --update --no-cache add pcre-dev openssl-dev zlib-dev \
  && apk add --no-cache --virtual build-dependencies build-base curl \
  && addgroup -S nginx \
  && adduser -D -S -h /var/cache/nginx -s /sbin/nologin -G nginx nginx \
  && curl -SLO http://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz \
  && tar xzvf nginx-${NGINX_VERSION}.tar.gz \
  && cd nginx-${NGINX_VERSION} \
  && ./configure \
      --prefix=/etc/nginx \
      --sbin-path=/usr/sbin/nginx \
      --modules-path=/usr/lib/nginx/modules \
      --conf-path=/etc/nginx/nginx.conf \
      --error-log-path=/var/log/nginx/error.log \
      --http-log-path=/var/log/nginx/access.log \
      --pid-path=/var/run/nginx.pid \
      --user=nginx \
      --group=nginx \
      --with-http_ssl_module \
      --with-http_gzip_static_module \
  && make \
  && make install \
  && : "ログの出力先をstdout, stderrのシンボリックリンクにする" \
  && ln -sf /dev/stdout /var/log/nginx/access.log \
  && ln -sf /dev/stderr /var/log/nginx/error.log \
  && cd / \
  && : "タイムゾーン合わせ" \
  && apk add tzdata \
  && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
  && : "不要ファイルの削除" \
  && apk del build-dependencies \
  && apk del tzdata \
  && rm -rf \
     nginx-${NGINX_VERSION} \
     nginx-${NGINX_VERSION}.tar.gz \
     /var/cache/apk/*
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./default.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]

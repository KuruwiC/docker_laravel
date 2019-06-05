FROM mysql:8.0
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update \
  && apt-get install -y locales \
  && rm -rf /var/lib/apt/lists/* \
  && echo "ja_JP.UTF-8 UTF-8" > /etc/locale.gen \
  && locale-gen ja_JP.UTF-8
ENV LC_ALL=ja_JP.UTF-8 \
    TZ='Asia/Tokyo'
COPY ./my.cnf /etc/mysql/conf.d/my.cnf
EXPOSE 3306
CMD ["mysqld"]

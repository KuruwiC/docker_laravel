FROM redis:5.0.4-alpine
ENV TZ="Asia/Tokyo"
RUN : "タイムゾーン合わせ" \
  && apk add tzdata \
  && cp "/usr/share/zoneinfo/$TZ" /etc/localtime \
  && : "不要ファイルの削除" \
  && apk del tzdata \
  && rm -rf /var/cache/apk/* \
EXPOSE 6379
CMD ["redis-server"]

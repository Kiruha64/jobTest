FROM redis:latest

COPY redis.conf /etc/redis.conf

EXPOSE 6379

CMD ["redis-server", "/etc/redis.conf", "--appendonly", "yes"]

#!/bin/sh
chown -R www-data:www-data /usr/share/nginx/www
exec /usr/sbin/nginx -c /etc/nginx/nginx.conf

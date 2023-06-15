# IntroTask

## Инструкция по развертыванию приложения:

<code>
cp docker/.env-example docker/.env
</code><br>
<code>
docker-compose -f docker/docker-compose.yml up -d --build
</code><br>
<code>
docker exec -i yii-app bash -c "cd /var/www/app && composer install && php yii migrate --migrationPath=../migrations"
</code><br>
<code>
docker exec -i yii-app bash -c "php /var/www/app/yii migrate --migrationPath=/var/www/migrations"
</code>
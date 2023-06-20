# IntroTask

## Инструкция по развертыванию приложения:

<code>
cp docker/.env-example docker/.env
</code>
<code>
docker-compose -f docker/docker-compose.yml up -d --build
</code>
<code>
docker exec -i yii-app bash -c "cd /var/www/app && composer install && php yii migrate --migrationPath=/var/www/migrations"
</code>

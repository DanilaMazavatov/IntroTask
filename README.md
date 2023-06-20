# Вводное задание (Orders)

## Инструкция по развертыванию приложения:

1. ### Настроить окружение в файле *docker/.env-example*

2. ### Выполнить следющий команды из каталога проекта:
```console
cp docker/.env-example docker/.env
docker-compose -f docker/docker-compose.yml up -d --build
docker exec -i yii-app bash -c "cd /var/www/app && composer install && php yii migrate"
```

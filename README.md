# IntroTask

## Инструкция по развертыванию приложения:

1) Загрузить репозиторий в локальную папку.
2) Выполнить команду <code>docker-compose -f docker/docker-compose.yml up -d</code>.
3) Выпонить команду <code>php app/yii migrate</code>.
4) Добавить данные в test_db.
5Открыть в браузере страницу по адресу <code>http://localhost:8000</code>
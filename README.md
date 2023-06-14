# IntroTask

## Инструкция по развертыванию приложения:

1) Загрузить репозиторий в локальную папку.
2) Выполнить команду <code>docker-compose -f docker/docker-compose.yml up -d</code>.
3) Выпонить команду <code>php app/yii serve</code>.
4) Создать базу данных test_db в запущенном контейнере с MySQL.
5) Выпонить команду <code>php app/yii migrate</code>.
6) Восстановить базу данных из приложенного к задаче файла дампа.
7) Запустить Yii2- приложение: <code>php app/yii serve</code>
8) Открыть в браузере страницу по адресу <code>http://localhost:8080</code>
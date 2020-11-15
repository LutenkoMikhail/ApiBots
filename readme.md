
#Техническое задание.

Требуется создать серверную часть веб-сервиса по созданию новостных ботов
(использовать laravel и postgresql). 
Каждый пользователь может создавать, редактировать и удалять ботов.

####Авторизация/регистрация пользователя
Для регистрации необходим логин и пароль. 
При регистрации, в базе сохраняется хэш от пароля.
В случае успешной авторизации/регистрации пользователь получает JWT токен. 
Доступ к методам API осуществляется только при наличии и успешной проверке jwt токена.

####Методы API
- получение списка ботов пользователя.
- создание нового бота.
- редактирование существующего бота.
- удаление существующего бота.

####Из чего состоит бот?
- Имя бота (строка).
- Описание бота (строка).
- Дата последнего редактирования бота (дата).

##Установка:
####Выполнить команду: 
- composer install (update).
- php artisan storage:link.
- php artisan migrate --seed.
- php artisan optimize:clear(при необходимости).
- npm install (при необходимости).
- Переименовать файл env-example в файл env и настроить подключение к базе данных и пр.


#### Дамп базы данный ?????.sql;


#### Пароль для админа:
- Email    : 1@1.
- Password : 123456789.

##Стартовая страница:
- public\index.php.

## Использованы :
- Laravel (5.8).
- tymon/jwt-auth.



## Техническое задание.

Требуется создать серверную часть веб-сервиса по созданию новостных ботов
(использовать laravel и postgresql). 
Каждый пользователь может создавать, редактировать и удалять ботов.

## Авторизация/регистрация пользователя
Для регистрации необходим логин и пароль. 
При регистрации, в базе сохраняется хэш от пароля.
В случае успешной авторизации/регистрации пользователь получает JWT токен. 
Доступ к методам API осуществляется только при наличии и успешной проверке jwt токена.

## Методы API
- получение списка ботов пользователя.
- создание нового бота.
- редактирование существующего бота.
- удаление существующего бота.

## Из чего состоит бот?
- Имя бота (строка).
- Описание бота (строка).
- Дата последнего редактирования бота (дата).

## Установка:
## Выполнить команду: 
- composer install (update).
- php artisan storage:link.
- php artisan migrate --seed.
- php artisan optimize:clear(при необходимости).
- npm install (при необходимости).
- Переименовать файл env-example в файл env и настроить подключение к базе данных и пр.


## Дамп базы данный apibots.sql;

## Использованы :
- Laravel (5.8).
- tymon/jwt-auth.

## Список API routers с методами

## REGISTER: метод:POST, URL:http:{URL}/api/v1/registration
Параметры запроса:
    $data=  array(
        'name'=> 'admin',
        'email'=> '1@1',
        'password'=> '123456789',
    );
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "success": true,
    "data": [],
    "message": "Successfully registration!"
}

Ошибка :    
1-Ответ 400
2-Тело ответа на запрос
{
    "success": false,
    "message": "Validation Error.",
    "data": {
        "email": [
            "The email has already been taken."
        ]
    }
}

## LOGIN  метод:GET, URL:http:{URL}/api/v1/login
Параметры запроса:
    $data=  array(
        'email'=> '1@1',
        'password'=> '123456789',
    );
    
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU3MDA0MzUsImV4cCI6MTYwNTcwNDAzNSwibmJmIjoxNjA1NzAwNDM1LCJqdGkiOiJGYWF2bU5CNFptdHB3TFBTIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.pufA0uPu88YrqP0FzDQaJNhAh909uWdo20DW6CEcNs4",
    "token_type": "bearer",
    "expires_in": 3600
} 
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "error": "Unauthorized"
}

## LOGOUT метод:POST, URL:http:{URL}/api/v1/logout
Параметры запроса:
    $data=  array(
        'Authorization'=> '"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU2MjE0MTMsImV4cCI6MTYwNTYyNTAxMywibmJmIjoxNjA1NjIxNDEzLCJqdGkiOiJDN3JpTGJZSmJxaDY2c2FVIiwic3ViIjo2LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.I9fXAZhcWmBewDKKpXwBGdL1QXjq53vu5h8IZutaEG4",
    );
    
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "message": "Successfully logged out"
}
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "message": "Unauthenticated."
}
## ACCOUNT метод:POST, URL:http:{URL}/api/v1/account
Параметры запроса:
    $data=  array(
        'Authorization'=> ' "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU2MjE0MTMsImV4cCI6MTYwNTYyNTAxMywibmJmIjoxNjA1NjIxNDEzLCJqdGkiOiJDN3JpTGJZSmJxaDY2c2FVIiwic3ViIjo2LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.I9fXAZhcWmBewDKKpXwBGdL1QXjq53vu5h8IZutaEG4",
    );
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "id": 6,
    "name": "admin",
    "email": "1@1",
    "email_verified_at": null,
    "created_at": "2020-11-17 11:04:27",
    "updated_at": "2020-11-17 11:04:27"
}
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "message": "Unauthenticated."
}  

## ALL BOTS метод:GET, URL:http:{URL}/api/v1/bots/index
Параметры запроса:
    $data=  array(
        'Authorization'=> ' "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU2MjU4MzYsImV4cCI6MTYwNTYyOTQzNiwibmJmIjoxNjA1NjI1ODM2LCJqdGkiOiJoUDZuUm5BRzFpdW5uQnNPIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.VCwxf7Lyijm3OKvB-SO_ELzT-uPsmnPxqVnIpH4aq4k",
    );
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "name": "dolor",
            "description": "Alice could not.",
            "created_at": "2020-11-17 14:46:55",
            "updated_at": "2020-11-17 14:46:55"
        },
        {
            "id": 2,
            "user_id": 1,
            "name": "rerum",
            "description": "His voice has a timid.",
            "created_at": "2020-11-17 14:46:55",
            "updated_at": "2020-11-17 14:46:55"
        }
    ],
    "message": "Bots retrieved successfully."
}
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "message": "Unauthenticated."
} 
## DESTROY BOT метод:POST, URL:http:{URL}/api/v1/bots/{id}/destroy
Параметры запроса:
    $data=  array(
        'Authorization'=> ' "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU3MDQ2MjYsImV4cCI6MTYwNTcwODIyNiwibmJmIjoxNjA1NzA0NjI2LCJqdGkiOiJKc1dRTDB1U1JIR2FpNzJIIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.y4gC0G80W5Vdob_QqHH_Gce5N3LX6pzOMBxmSt5Elx4",
    );
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "success": true,
    "data": {
        "bot ": 11
    },
    "message": "Bot has been successfully deleted!"
}
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "success": false,
    "message": "Delete Error.",
    "data": {
        "bot ": 12
    }
}
## SHOW BOT метод:GET, URL:http:{URL}/api/v1/bots/{id}/show
Параметры запроса:
    $data=  array(
        'Authorization'=> ' "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU3MDQ2MjYsImV4cCI6MTYwNTcwODIyNiwibmJmIjoxNjA1NzA0NjI2LCJqdGkiOiJKc1dRTDB1U1JIR2FpNzJIIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.y4gC0G80W5Vdob_QqHH_Gce5N3LX6pzOMBxmSt5Elx4",
    );
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "success": true,
    "data": {
        "id": 1,
        "user_id": 1,
        "name": "deserunt",
        "description": "There was a little.",
        "created_at": "2020-11-18 11:52:54",
        "updated_at": "2020-11-18 11:52:54"
    },
    "message": "Bot received!"
}
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "success": false,
    "message": "Load bot error.",
    "data": {
        "bot ": "2"
    }
}

## NEW BOT метод:POST, URL:http:{URL}/api/v1/bots/create
Параметры запроса:
    $data=  array(
        'Authorization'=> ' "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2MDU3MDQ2MjYsImV4cCI6MTYwNTcwODIyNiwibmJmIjoxNjA1NzA0NjI2LCJqdGkiOiJKc1dRTDB1U1JIR2FpNzJIIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.y4gC0G80W5Vdob_QqHH_Gce5N3LX6pzOMBxmSt5Elx4",
    );
Нет ошибок :    
1-Ответ 200
2-Тело ответа на запрос
{
    "success": true,
    "data": {
        "bot ": 14
    },
    "message": "The new bot has been created!"
}
Ошибка :    
1-Ответ 401
2-Тело ответа на запрос
{
    "success": false,
    "message": "An error occurred while creating a new bot.",
    "data": 
    {  
    }
}


# Lumen API Test

Project Test API With : <br>

-   CRUD data barang using MongoDB <br>
-   CRUD data User using Firebase Realtime Database <br>
-   Auth with JWT Token <br>
-   Integrating with another API <br>
-   Filtering Denom

## Package Used

[SwaggerLume](https://github.com/DarkaOnLine/SwaggerLume) : for API Documentation <br>
[Lumen Generator](https://github.com/flipboxstudio/lumen-generator) : To provide Laravel code generator <br>
[Sentry](https://docs.sentry.io/platforms/php/guides/laravel/) : for monitoring error in application <br>
[jenssegers/mongodb](https://github.com/jenssegers/laravel-mongodb) : Management Database mongoDB <br>
[Session](https://packagist.org/packages/illuminate/session) : for using session in lumen that store jwt token <br>
[Jwt-auth](https://github.com/tymondesigns/jwt-auth) : Management JWT Auth <br>
[Guzzle](https://github.com/guzzle/guzzle) : Http Client for integration with another API <br>
[kreait/laravel-firebase](https://github.com/kreait/laravel-firebase) : A Laravel package for the Firebase PHP Admin SDK.

## Installation

Before composer install please install MongoDB PHP Driver or Using
[mongodb/mongo-php-driver](https://github.com/mongodb/mongo-php-driver) <br>

Install all package via Composer

```
$ composer install
```

Start server via Terminal

```
$ php -S localhost:8000 public/index.php
```

Installation using docker compose

```
$ docker compose up
```

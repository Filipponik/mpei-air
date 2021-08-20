# MPEI Air

![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

![Code Size](https://img.shields.io/github/languages/code-size/filipponik/mpei-air)
![Last Commit](https://img.shields.io/github/last-commit/filipponik/mpei-air)

Дипломный проект на тему "Разработка информационной системы продажи авиабилетов" для НИУ "МЭИ"

## Стек технологий

**Фронтенд:** HTML, CSS, JS, VueJS, TailwindCSS

**Бэкенд:** PHP, MySQL, Laravel

## Установка

Клонировать репозиторий:

```bash
  git clone git@github.com:Filipponik/mpei-air.git
  cd mpei-air
```

Установить зависимости:

```bash
  composer install
  npm install
```

Сконфигурировать окружение:

Настроить в файле [.env](.env) подключение к базе данных (аналогично [файлу](.env.example))

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=diplom_db
DB_USERNAME=root
DB_PASSWORD=
```

А также подключение к почте

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.domain.com
MAIL_PORT=465
MAIL_USERNAME="username@domain.com"
MAIL_PASSWORD=PASSWORD
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="username@domain.com"
MAIL_FROM_NAME="MPEIAir"
```

Мигрировать базу данных

С сидами:

```bash
  php artisan migrate --seed
```

Без сидов:

```bash
  php artisan migrate
```

## Скриншоты

Подбор рейса

![Подбор рейса](https://user-images.githubusercontent.com/44286080/130289797-e95454fd-c09f-4247-a8b1-96431daa7558.png)

Форма обратной связи

![Форма обратной связи](https://user-images.githubusercontent.com/44286080/130289865-f5231b52-b99a-42f4-834c-934a78870a80.png)

Форма регистрации

![Форма регистрации](https://user-images.githubusercontent.com/44286080/130289929-010d6f91-d064-41b3-bcd8-ac2c49b383bc.png)
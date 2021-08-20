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

![App Screenshot](https://via.placeholder.com/468x300?text=App+Screenshot+Here)
![App Screenshot](https://via.placeholder.com/468x300?text=App+Screenshot+Here)
![App Screenshot](https://via.placeholder.com/468x300?text=App+Screenshot+Here)

  
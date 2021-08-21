# MPEI Air

![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

![Laravel](https://img.shields.io/badge/made%20with-Laravel-brightgreen)
![VueJS](https://img.shields.io/badge/made%20with-VueJS-brightgreen)
![TailwindCSS](https://img.shields.io/badge/made%20with-TailwindCSS-brightgreen)

![Code Size](https://img.shields.io/github/languages/code-size/filipponik/mpei-air)
![Last Commit](https://img.shields.io/github/last-commit/filipponik/mpei-air)

Дипломный проект на тему **"Разработка информационной системы продажи авиабилетов"** для **НИУ "МЭИ"**

Специальность - **Прикладная информатика**

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

### Десктоп версия

Подбор рейса

![Подбор рейса](https://user-images.githubusercontent.com/44286080/130289797-e95454fd-c09f-4247-a8b1-96431daa7558.png)

Форма обратной связи

![Форма обратной связи](https://user-images.githubusercontent.com/44286080/130289865-f5231b52-b99a-42f4-834c-934a78870a80.png)

Форма регистрации

![Форма регистрации](https://user-images.githubusercontent.com/44286080/130289929-010d6f91-d064-41b3-bcd8-ac2c49b383bc.png)

### Мобильная версия (поддержка от ширины экрана 320px)

Подбор рейса

![Подбор рейса](https://user-images.githubusercontent.com/44286080/130334465-380993b6-d62f-4d29-a161-ea7d1a2c88dc.png)

Форма авторизации

![Форма обратной связи](https://user-images.githubusercontent.com/44286080/130334447-98d083f6-a8f7-4277-9bde-76abaa112fcc.png)

Форма регистрации

![Форма регистрации](https://user-images.githubusercontent.com/44286080/130334470-3293dd4f-4267-4348-b98a-f9c89f77da40.png)

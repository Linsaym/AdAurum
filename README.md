<h1 align="center"><img alt="vue" src="https://vuejs.org/logo.svg" height="32"/> AdAurum Companies <img alt="vue" src="https://vuejs.org/logo.svg" height="32"/></h1>
<h2 align="center">Vue + Laravel</h2>
<h3 align="center">В приложении вы можете оставлять комментарии к компаниям и их полям</h3>

<h4 align="center">По всем вопросам сюда <a href="https://vk.com/linsaym">https://vk.com/linsaym </a> </h4>

## Для запуска приложения

Убедитесь что у вас установленны "<a href="https://www.apachefriends.org/">Xampp</a>"
и "<a href="https://getcomposer.org/">Composer</a>"
(Xampp нужен для того, чтобы на windows, поднять SQL и Apache. Либо вы можете сами развернуть сервер, через докер
контейнер или на Linux)

Далее, клонируйте репозиторий себе:

```sh
git clone https://github.com/Linsaym/AdAurum
```

Переименуйте файл <strong>.env.example</strong> в <strong>.env</strong> и настройте файл под себя.

####

И последовательно выполните следующие команды:

```sh
composer install
```

```sh
php artisan key:generate
```

```sh
php artisan migrate --seed
```

```sh
php artisan serve
```

И в отдельной консоли:

```sh
npm install
```

```sh
npm run dev
```

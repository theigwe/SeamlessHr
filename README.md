## Seamless HR (Basic **CRUD** Implementation)

Basic employees management implementation buit with **Laravel** and **VueJs**

### Requirements

- Php 7.2.5+
- MySQL
- Composer
- NodeJs 10.14+
- Apache || Nginx Server
- Other [Laravel Requirements](https://laravel.com/docs/7.x/installation)


### Installation

> #### Clone repository
```
$ git clone https://github.com/sammyni/SeamlessHr.git
```
```
$ cd SeamlessHr
```
> #### Install dependencies

```
$ composer install

```

```
$ yarn install
```

> #### Update environment variables
```
$ cp .env.example .env
```

> Update the following value with your environment values in **.env** file

- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

> #### Generate **App Key**

```
$ php artisan key:generate
```

> #### Run migration and seed database

```
$ php artisan migrate:fresh --seed --force
```

> #### Build UI and serve appliciation

```
$ yarn run prod
$ php artisan serve
```

### Default Admin Credentials

***E-Mail:*** admin@company.com
***Password:*** password




### License

The Laravel framework is open>sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

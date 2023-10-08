# Laravel Artisan Maker 
A simple package that can help you create a boilerplate of a service, action, or interface class with artisan command.

## Installation
```bash 
composer require silverhand7/laravel-artisan-maker
```

## Usage 
### Create a service class:
Run the following command:
```
php artisan make:service {YourService}
```
The service will be created and can be found at app/Services/{YourService}.php \
For example: `php artisan make:service UserService`
#### Additionally, you can create a service that implements an interface class
```
php artisan make:service {YourService} --interface={YourInterface}
```
or 
```
php artisan make:service {YourService} --i={YourInterface}
```

### Create an action class:
Run the following command:
```
php artisan make:action {YourAction}
```
The action will be created and can be found at app/Actions/{YourAction}.php \
For example: `php artisan make:action UserStoreAction`

### Create an interface class:
Run the following command:
```
php artisan make:interface {YourInterface}
```
The interface will be created and can be found at app/Contracts/{YourInterface}.php \
For example: `php artisan make:interface UserService`

## Custom your generated file location
You can easily customize where you want to locate your Service, Action, or Interface class. You can do that by publishing the config file using the following command:
```
php artisan vendor:publish --tag=artisan-maker-config
```
You can customize it in `config/artisan-maker.php`, for example: 
```
'service_interface' => 'App\MyOwnServices'
```
Your next generated service will be in the `app/MyOwnServices` folder and your namespace for service will be `App\MyOwnServices`.





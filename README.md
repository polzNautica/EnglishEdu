
## Installation

#### 1. Clone the repository

```sh
git clone https://github.com/polzNautica/lisaedu.git
```

#### 2. Change Directory

```sh
cd lisaedu
```

#### 3. Copy .env

```sh
cp .env.example .env
```

#### 4. Configure .env

```sh
FILESYSTEM_DISK=public
```

#### 5. Install depedencies

```sh
composer install
```

#### 6. Generate Key

```sh
php artisan key:generate
```

#### 7. Run Symlink

```sh
php artisan storage:link
```

#### 8. Migrate database

```sh
php artisan migrate
```

#### 9. Database seeders

```sh
php artisan db:seed
```

#### 10. Run application

```sh
php artisan serve
```

##### <i><b>Note:<br>username: admin & password: @Admin123 <br> username: member & password: @Member123</b></i>

## License

The LisaEdu is open-sourced licensed under the [MIT license](https://github.com/polzNautica/lisaedu/blob/main/LICENSE).

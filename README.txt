

This Application use:
- Framework Laravel 10
- Bootstrap 5
- Jquery
- other


### Installation

1. Clone the repository
git clone https://github.com/bubblevy/bubblesmart.git

2. Change Directory
cd bubblesmart

3. Copy .env
cp .env.example .env

4. Configure .env
FAKER_LOCALE=id_ID
FILESYSTEM_DISK=public

5. Install depedencies
composer install

6. Generate Key
php artisan key:generate

7. Run Symlink
php artisan storage:link

8. Migrate database
php artisan migrate

9. Database seeders
php artisan db:seed

10. Run application
php artisan serve

### License
The BubbleSmart is open-sourced licensed under the MIT license (https://github.com/bubblevy/bubblesmart/blob/main/LICENSE).
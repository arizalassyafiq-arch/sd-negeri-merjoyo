```
cd testing-app

npm install -g pnpm@latest-10

composer install
pnpm i
# --next--
cp .env.example .env
# sesuaikan db configurasinya dengan benar
# --next--
php artisan key:generate
# --next--
php artisan migrate
php artisan storage:link # (opsional)

# run app
php artisan serve / php artisan ser
```
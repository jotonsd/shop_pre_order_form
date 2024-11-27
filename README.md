# 🛒 Shop Pre-order From API
## 🚴 Installation of Shop Pre-order From in the local environment

:hamster: In the pre-order form API, you will get users, categories, products, and orders API. APIs are maintained by role base users like Admin & manager. And this is a custom whole package. <br>

### 👉 Requirments
PHP: 8.3.13 <br>
Laravel: 11.31 <br>
Composer: 2.8.3 <br>

### :honeybee: Features
➖ In this application you can manage users, categories, products, and orders<br>
➖ Admin can create, update, and delete operations<br>
➖ The manager can only view the order items.<br>
➖ Guest user, admin, and manager both can create pre-orders <br>
➖ Order can be searched by name, email <br>
➖ Pagination used <br>

### :zap: Technical features
➖ Laravel custom package created <br>
➖ Used repository pattern for the development <br>
➖ Role-based user access managed <br>
➖ Used queue, event, listener <br>
➖ Mail sent to user and admin <br>
➖ Soft-delete functionalities <br>
➖ Pagination <br>
➖ Used Logger trait <br>
➖ Custom validations <br>
➖ Ordering by maximum matching ratio <br>

### :seedling: Step by step
Clone this Repository
```sh
git clone https://github.com/jotonsd/shop_pre_order_form.git
```

Install project dependencies
```sh
cd shop_pre_order_form
composer install
```

Setup the database environment variables in **.env**
```dosini
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=database_name
DB_USERNAME=user_name
DB_PASSWORD=password
```

Then run seed the user table for admin
```sh
php artisan db:seed
```

Setup the mail configuration in **.env**
```dosini
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yourmail@example.com
MAIL_PASSWORD=mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yourmail@example.com
MAIL_FROM_NAME="${APP_NAME}"
```
You can change the admin email from the class **PreOrderRepository**
```dosini
protected const ADMIN_MAIL = 'paste_here_your_admin_email@example.com';
```
🏃 Before run server run the queue work by the below command
```sh
php artisan queue:work
```

To start the server run
```sh
php artisan serve
```

Access the local project
[http://localhost:8000](http://localhost:8000)
<br>

**😃Happy Coding, Thank you**

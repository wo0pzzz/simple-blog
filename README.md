

## Simple Blog


* Laravel  v11.20.0
* PHP      v8.3.10
* Node.js  v20.16.0
* Npm      v10.8.1
* Composer v2.7.7

**Uncomment following extensions in your php.ini:**
- fileinfo
- openssl
- pdo_mysql

**Create your copy of the .env file**

cp .env.example .env

**Configure database**
1. Create database 's_blog' with 'utf8mb4_general_ci' collation.
2. Edit connection in .env file.
   
   _DB_CONNECTION=mysql_</br>
   _DB_HOST=127.0.0.1_</br>
   _DB_PORT=3306_</br>
   _DB_DATABASE=s_blog_</br>
   _DB_USERNAME=root_</br>
   _DB_PASSWORD=root_</br>
   

**Open project in terminal and run this commands:**
1. composer install
2. npm install
3. php artisan migrate
4. php artisan db:seed
5. php artisan serve

**Open in browser http://127.0.0.1:8000**

**Admin acccess:**</br>
Login: admin@admin.com</br>
Password: admin123456789

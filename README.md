# Introduction
Url Shortener Application is such a technique in which a Uniform Resource Locator (URL) may be made substantially shorter and still direct to the required page. This is achieved by using a redirect which links to the web page that has a long URL. For example, the URL "http://example.com/assets/category_B/subcategory_C/Foo/" can be shortened to "https://example.com/Foo", and the URL "http://example.com/about/index.html" can be shortened to "https://goo.gl/aO3Ssc". 



# Requirements
+ PHP 7 or greater
+ Laravel 5.5 or greater 
+ PostgreSQL 9.5 or newer / MySQL 5.5 or newer 



# Installation Process
+ Clone the project or download zip file.
+ Add composer dependencies: <code>composer install</code>
+ Add node dependencies: <code>npm install</code>
+ Make changes in <code>.env</code> file for database
+ Generate new application key: <code>php artisan key generate</code>
+ Set the JWTAuth secret key used to sign the tokens: <code>php artisan jwt:secret</code>
+ And make tables: <code>php artisan migrate</code>
+ Build project with npm: <code>npm run dev</code>
+ Create admin user with seeder: <code>composer dump-autoload</code> and <code>php artisan db:seed</code>
+ Clear cache and write new cache file: <code>php artisan cache:clear</code> and <code>php artisan config:cache</code>
+ And run the project: <code>php artisan serve</code>
+ Login credentials: <code>email: admin@admin.com password:test123</code>



# Features
+ Stylish Web based Interface
+ Easy Url Shortening 
+ Short urls redirects to original url with HTTP 302 redirect
+ Counter for shortened URLS for every hit
+ Blacklist for input URLs with regex support.
+ Admin interface

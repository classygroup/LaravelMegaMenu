# Classy Menu a Laravel Mega Menu

A Laravel MegaMenu Package to make your life easier supporting Laravel 5.4, 5.5 and 5.6!

## Installation Steps

### 1. Require the Package

After creating your new Laravel application you can include the ClassyMenu package with the following command: 

```bash
composer require classy/mega-menu
```

### 2. Add the DB Credentials

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### 3. Run The Migration


```bash
php artisan migrate:install
            OR  
php artisan migrate:refresh
```
Congratulations Can you use Classy Menu now 


## How To Use

to show your menu by name use 
```bash
$menuname = "main_menu" @ menu name from database

$type = "default" Or "bootstrap" Or "costem.menu.view"

$options = array('color' => true , 'background' => true , 'icon' => true)

Or in blade 

$option1 = "background" background color in database @css
$option2 = "color"      Font Color in database @css
$option3 = "icon"       icon class in database exa: fa fa-home
 
 

By Blade Directive @ClassyMenu(String $menuname, String $type, String $option1, String $option2 ,String option3) 
   
   example @ClassyMenu(main,bootstrap,color,icon) 

   example @ClassyMenu(main,mymenu,color) 

   example @ClassyMenu(main,default) 

By Helper Function ClassyMenu(String $menuname,String $type ,array options)
   
   example ClassyMenu("main","bootstrap",["color"=>true,"icon"=>true]) 

   example ClassyMenu("main","mymenu",["background"=>true]) 

   example ClassyMenu("main","fronend.menu.mymenu") 

By Fcade ClassyMenu::display(String $menuname,String $type ,array options)

   example ClassyMenu::display("main","bootstrap",["color"=>true,"icon"=>true]) 

   example ClassyMenu::display("main","mymenu",["background"=>true]) 

   example ClassyMenu::display("main","fronend.menu.mymenu") 

```


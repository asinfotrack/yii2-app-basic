Yii 2 Basic Project Template customized by AS infotrack AG
==========================================================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.2.0"
php composer.phar create-project --prefer-dist --stability=dev asinfotrack/yii2-app-basic your-folder-name dev-master
~~~

or if you have composer and php on the path-variable

~~~
composer global require "fxp/composer-asset-plugin:^1.2.0"
composer create-project --prefer-dist --stability=dev asinfotrack/yii2-app-basic your-folder-name dev-master
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install NPM, its modules and create first grunt-build

Assert npm is properly installed and on your path-variable and execute the following command:

~~~
npm install
~~~

After all modules are installed, you can create first grunt build:

~~~
grunt build
~~~

After that you can use the console with only `grunt` which will start listening for relevant file changes.

### Update cookie validation key 

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` and enter db-credentials of local- and production-server.

### Users

Add users to `config/params.php` to enable user control. Later replace this with db users.

### App name

Update the app name in `config/web.php` to the actual app name.

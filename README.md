Zend Framework 2: The Basics with Matthew Setter
================================================

**Course Application Overview**
* Module Manager
  * Based on Zend squeleton
  * Provides MVC
  * Basic configuration
* Service Manager
  * To configure resources like databases to be access from controllers
* Forms
  * Input filtering and validation

**The Module Manager**  
  * A module: a "namespaced" directory with a single `Module` class on it
  * Core concepts:
    * Autoloader: locates and loads every `Module` class
    * Manager: takes an array of module names and fires a sequence of events for each one
    * ModuleManager Listeners: allows attachments to the module manager's events
  * The framework supports the interconnection among several modules
  * Each module is able to provide: views, layouts, images, CSS and JavaScript files
    * And anything else, including use of other modules
  * Requirements for building a module
    * in a namespace directory must exist a class called `module.php`
    * there is a `module.config.php` to set up routing, ServiceManager configuration, transalations, controller installation, view manager configuration, etc.

**The Service Manager**
* Highly critical, must be understood to easy the rest of the framework: provides services to your application
* It helps the way you initialise and retrieve services within your application
* For example to register services such as table objects, database connection adapters, log objects, email services, access location services, etc.; everything must be referred to throughout your application
* It facilitates calling instances of factories and abstract factories, invokables, lazy-loaded objects, aliases

**The Basic Project**
* Download `composer.phar`

  ```bash
  curl -s https://getcomposer.org/installer | php --
##################################
# in my case it really was:
# on workstation:
  curl -s https://getcomposer.org/installer > curl.txt
# on server:
  php -F curl.txt # press [Enter] twice
  ```

* Create the project with `composer` with the skeleton package into the installation directory zf2basics

  ```bash
  # run on server:
  php composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" zendframework/skeleton-application zf2basics
  # using the PHP CLI
  php -S localhost:8080 -t zf2basics/public
  ```


**The Core Module Directory Structure**

  ```bash
  $ tree config
  config
  ├── application.config.php
  └── autoload
      ├── global.php
      ├── local.php.dist
      └── README.md

  1 directory, 4 files
  ```
* Those `autoload/{global,local}.php` files return arrays which will be available throughout the application's live. The `local.php` works on top of `global.php`, and it's for development purposes only, and it's important to have it ignored from source code sharing.
* The `application.config.php` allows you to add and update global settings regarding the location of modules and required resources.
* The `module` directory is the place where modules are added. The skeleton's default `Application` module is there. You can manage (add, update, remove) the modules by hand, but it's recommended to use the module management tool `zftool`. Those modules will be part of your application.

  ```bash
  $ tree vendor -L 3
  vendor
  ├── autoload.php
  ├── bin
  │   ├── classmap_generator.php
  │   ├── classmap_generator.php.bat
  │   ├── phpunit
  │   ├── phpunit.bat
  │   ├── pluginmap_generator.php
  │   ├── pluginmap_generator.php.bat
  │   ├── templatemap_generator.php
  │   └── templatemap_generator.php.bat
  ├── composer
  │   ├── autoload_classmap.php
  │   ├── autoload_namespaces.php
  │   ├── autoload_psr4.php
  │   ├── autoload_real.php
  │   ├── ClassLoader.php
  │   ├── include_paths.php
  │   ├── installed.json
  │   └── LICENSE
  ├── doctrine
  │   └── instantiator
  ...
  ├── phpdocumentor
  ...
  ├── phpspec
  │   └── prophecy
  │       ├── CHANGES.md
  │       ├── composer.json
  │       ├── CONTRIBUTING.md
  │       ├── LICENSE
  │       ├── README.md
  │       ├── spec
  │       └── src
  ├── phpunit
  │   ├── php-code-coverage
  │   │   ├── build
  │   │   ├── build.xml
  │   │   ├── composer.json
  │   │   ├── CONTRIBUTING.md
  │   │   ├── LICENSE
  │   │   ├── phpunit.xml.dist
  │   │   ├── README.md
  │   │   ├── scripts
  │   │   ├── src
  │   │   └── tests
  │   ├── php-file-iterator
  ...
  │   ├── php-text-template
  ...
  │   ├── php-timer
  ...
  │   ├── php-token-stream
  ...
  │   ├── phpunit
  ...
  │   └── phpunit-mock-objects
  ...
  ├── sebastian
  ...
  ├── symfony
  ...
  └── zendframework
      ├── zend-authentication
      │   ├── composer.json
      │   ├── CONTRIBUTING.md
      │   ├── LICENSE.md
      │   ├── README.md
      │   └── src
      ├── zend-barcode
      │   ├── composer.json
      │   ├── CONTRIBUTING.md
      │   ├── LICENSE.md
      │   ├── README.md
      │   └── src
      ├── zend-cache
      │   ├── composer.json
      │   ├── CONTRIBUTING.md
      │   ├── LICENSE.md
      │   ├── README.md
      │   └── src
      ├── zend-captcha
      │   ├── composer.json
      │   ├── CONTRIBUTING.md
      │   ├── LICENSE.md
      │   ├── README.md
      │   └── src
      ...
      └── zend-xmlrpc
          ├── composer.json
          ├── CONTRIBUTING.md
          ├── LICENSE.md
          ├── README.md
          └── src

  180 directories, 334 files

  ```
* The `vendor` directory has configuration to help resolving dependencies between libraries, driven by `composer` package manager, which stores configuration in `composer.json`. It detects if packages are required or not in development or deployment in production. The management tool uses free downloading package services like "Packagist" to obtain the required libraries. You need to use `composer` to manage the libraries, e.g. an update requires calling `composer update`. Further information at http://getcomposer.org.

  ```bash
  $ tree public
  public
  ├── css
  │   ├── bootstrap.css
  │   ├── bootstrap.min.css
  │   ├── bootstrap-theme.css
  │   ├── bootstrap-theme.min.css
  │   └── style.css
  ├── fonts
  │   ├── glyphicons-halflings-regular.eot
  │   ├── glyphicons-halflings-regular.svg
  │   ├── glyphicons-halflings-regular.ttf
  │   └── glyphicons-halflings-regular.woff
  ├── img
  │   ├── favicon.ico
  │   └── zf2-logo.png
  ├── index.php
  └── js
      ├── bootstrap.js
      ├── bootstrap.min.js
      ├── html5shiv.js
      ├── html5shiv.min.js
      ├── jquery.min.js
      ├── jquery-1.11.1.min.map
      └── respond.min.js

  4 directories, 19 files
  ```
* At directory `public` are located static files like .css, .js images and fonts, as well as the bootstrap file `index.php`, and basic web server configuration files like `.htaccess` and `web.confg`. Contains the "mod rewrite" configuration in order that all requests that are for non static resources are processed by that file.

**Understanding Zend Framework**

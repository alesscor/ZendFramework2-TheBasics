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
* At directory `public` are located static files like .css, .js images and fonts, as well as the bootstrap file `index.php`, and basic web server configuration files like `.htaccess` and `web.confg`. Contains the "mod rewrite" configuration in order that all requests that are for non static resources are processed by that PHP file.

**ZF2 Tool Overview**

* The ZFTool helps maintaining the modules of a PHP Zend Framework application. It's not so advance as others like Symfony or Yii which automatically provides information from databases' structure. You are able to:
  * Create ZF2 Projects
  * Create modules
  * Create controllers and actions for the modules (and automatically creates the view template files)
  * Create an Autoload Classmap
  * Review possible issues using Diagnostics classes

* To start using it you have to add it in the `composer.json` file as a development dependency in this way: `php composer.phar require --dev zendframework/zftool:dev-master`.
  ```bash
  ...\zf2basics>php ..\composer.phar require --dev zendfr amework/zftool:dev-master
  ./composer.json has been updated
  Loading composer repositories with package information
  Updating dependencies (including require-dev)
    - Installing zendframework/zenddiagnostics (v1.0.9)
      Loading from cache

    - Installing zendframework/zftool (dev-master 840c3ee)
      Cloning 840c3eecd58454396983d84d1da293813af484af

  zendframework/zenddiagnostics suggests installing sensiolabs/security-checker (Required by Check\SecurityAdvisory)
  zendframework/zenddiagnostics suggests installing guzzle/http (Required by Check\GuzzleHttpService)
  zendframework/zenddiagnostics suggests installing predis/predis (Required by Check\Redis)
  zendframework/zenddiagnostics suggests installing videlalvaro/php-amqplib (Required by Check\RabbitMQ)
  zendframework/zenddiagnostics suggests installing doctrine/migrations (Required by Check\DoctrineMigration)
  Writing lock file
  Generating autoload files  
  ```
  That makes the `composer.json` change to:
  ```json
  {
      "name": "zendframework/skeleton-application",
      "description": "Skeleton Application for ZF2",
      "license": "BSD-3-Clause",
      "keywords": [
          "framework",
          "zf2"
      ],
      "homepage": "http://framework.zend.com/",
      "require": {
          "php": ">=5.5",
          "zendframework/zendframework": "~2.5"
      },
      "require-dev": {
          "zendframework/zftool": "dev-master"
      }
  }

  ```
- This is the output generated by the command without any arguments:

  ```
    <...>\zf2basics>vendor\bin\zf.php.bat
    ZFTool - Zend Framework 2 command line Tool
    --------------------------------------------------------------------------------
    ZFTool
    --------------------------------------------------------------------------------
    Basic information:
      zf.php modules [list]         show loaded modules
      zf.php version | --version    display current Zend Framework version

    Diagnostics
      zf.php diag [options] [module name]    run diagnostics

      [module name]    (Optional) name of module to test
      -v --verbose     Display detailed information.
      -b --break       Stop testing on first failure
      -q --quiet       Do not display any output unless an error occurs.
      --debug          Display raw debug info from tests.

    Application configuration:
      zf.php config list                  list all configuration options
      zf.php config get <name>            display a single config value, i.e.
                                          "config get db.host"
      zf.php config set <name> <value>    set a single config value (use only to
                                          change scalar values)

    Project creation:
      zf.php create project <path>    create a skeleton application

      <path>    The path of the project to be created

    Module creation:
      zf.php create module <name> [<path>]    create a module

      <name>    The name of the module to be created
      <path>    The root path of a ZF2 application where to create the module

    Controller creation:
      zf.php create controller <name> <module> [<path>]    create a controller in
                                                           module

      <name>      The name of the controller to be created
      <module>    The module in which the controller should be created
      <path>      The root path of a ZF2 application where to create the
                  controller

    Action creation:
      zf.php create action <name> <controllerName> <module> [<path>]    create an
                                                                        action in
                                                                        a
                                                                        controlle
                                                                        r

      <name>              The name of the action to be created
      <controllerName>    The name of the controller in which the action should
                          be created
      <module>            The module containing the controller
      <path>              The root path of a ZF2 application where to create the
                          action

    Classmap generator:
    zf.php classmap generate <directory> <classmap file> [--append|-a] [--overwrite|
    -w]

      <directory>         The directory to scan for PHP classes (use "." to use
                          current directory)
      <classmap file>     File name for generated class map file  or - for
                          standard output. If not supplied, defaults to
                          autoload_classmap.php inside <directory>.
      --append | -a       Append to classmap file if it exists
      --overwrite | -w    Whether or not to overwrite existing classmap file

    Zend Framework 2 installation:
      zf.php install zf <path> [<version>]

      <path>       The directory where to install the ZF2 library
      <version>    The version to install, if not specified uses the last
                   available

    Reason for failure: Invalid arguments or no arguments provided

  ```
- Using the command to generate a module with four actions: index, delete, view, manage and search.

  ```
  <...>\zf2basics>vendor\bin\zf.php.bat create module VideoManager
  The module VideoManager has been created

  <...>\zf2basics>vendor\bin\zf.php.bat create controller Index VideoManager
  The controller Index has been created in module VideoManager.

  <...>\zf2basics>vendor\bin\zf.php.bat create action delete index VideoManager
  Creating action 'delete' in controller 'VideoManager\Controller\index'. Created view script at ./module/VideoManager/view/video-manager/index/delete.phtml
  The action delete has been created in controller VideoManager\Controller\index.

  <...>\zf2basics>vendor\bin\zf.php.bat create action view index VideoManager
  Creating action 'view' in controller 'VideoManager\Controller\index'. Created view script at ./module/VideoManager/view/video-manager/index/view.phtml

  The action view has been created in controller VideoManager\Controller\index.

  <...>\zf2basics>vendor\bin\zf.php.bat create action search index VideoManager
  Creating action 'search' in controller 'VideoManager\Controller\index'. Created view script at ./module/VideoManager/view/video-manager/index/search.phtml
  The action search has been created in controller VideoManager\Controller\index.

  <...>\zf2basics>vendor\bin\zf.php.bat create action manage index VideoManager
  Creating action 'manage' in controller 'VideoManager\Controller\index'. Created view script at ./module/VideoManager/view/video-manager/index/manage.phtml
  The action manage has been created in controller VideoManager\Controller\index.

  <...>\zf2basics>   
  ```
**Exploring the Application module that comes in the skeleton**
- Looking at the module's `src` we can find:
  ```bash
  $ tree src
  src
  └── Application
      └── Controller
          └── IndexController.php

  2 directories, 1 file
  ```
- This comes at the `view` directory:  
  ```bash
  $ tree view/
  view/
  ├── application
  │   └── index
  │       └── index.phtml
  ├── error
  │   ├── 404.phtml
  │   └── index.phtml
  └── layout
      └── layout.phtml

  4 directories, 4 files
  ```
- This comes at the `config` directory:
  ```bash
  $ tree config/
  config/
  └── module.config.php

  0 directories, 1 file
  ```
- Comparing the Application and the VideoManager modules' `module.config.php` file, the second comes empty while the other contents configuration of routes, controllers, views, services and actions.
**Understanding Zend Framework**

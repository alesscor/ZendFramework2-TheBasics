# Zend Framework 2: The Basics with Matthew Setter

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



**Understanding Zend Framework**

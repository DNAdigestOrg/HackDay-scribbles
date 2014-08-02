DNADigest API
========================

This API is built on top of [Symfony][1] document contains information on how to download, install, and start
using Symfony. 

1) Installing the API locally
----------------------------------

If you don't have [Composer][2] yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, run 

    composer install

Composer will install the dependant libraries for the project.


2) Dependencies
-------------------------------------

The following versions of LAMP stack are required for the API to work:

  * Apache - 2.4.x

  * PHP - 5.5.x

  * MySQL - 5.5.x


3) Migrations & Fixtures
------------------------

To run migrations, execute:

    app/console doctrine:migrations:migrate
    
Then run fixtures:

    app/console doctrine:fixtures:load

4) Setting up API sandbox
-------------------------------

Please set your apache config to point to api/web/ folder. You can access the sandbox from <ServerName>/app_dev.php/api/doc

You can find the hosted version of the API sandbox [here][3]


5) Licence
------------

All libraries and bundles are released under Apache license.

Enjoy!

[1]:  http://symfony.com/doc/2.4/book/installation.html
[2]:  http://getcomposer.org/
[3]:  http://ec2-54-186-176-144.us-west-2.compute.amazonaws.com/app_dev.php/api/doc/

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

6) Installation on OSX
----------------------

This seems to work mostly out of the box in Mac OS 10.9 (Mavericks), but some PHP stuff isn't well documented.  The following worked for @dasmoth:

Install MySQL
Activate PHP in Apache.  In /etc/apache/httpd.conf, uncomment the line:

    LoadModule php5_module libexec/apache2/libphp5.so

(Important), create an /etc/php.ini file containing a line like:

    date.timezone = "Europe/London

Restart (or start) Apache
 
    sudo apachectl restart
    
Install composer (as above) then

    php composer.phar update
    
Then proceed as above.

7) Importing data
------------------

There are commands that can be created to import data.  For example, an example EGA dataset was imported with the command
    
    app/console ega:import EGA.csv
    
Note: Please place the file under the command folder for the import to work.

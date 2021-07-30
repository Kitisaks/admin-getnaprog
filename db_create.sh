#!/bin/bash
set -x

#- direct and set executable php files
cd priv/migration/ 

#- create database
xdg-open localhost/database/school_dev.php
/usr/bin/open -a "/Applications/Google Chrome.app" 'localhost/database/school_dev.php'
#- create tables -- you can put new tables here
/usr/bin/php -f /table/users.php
#!/bin/bash
set +x

#- direct and set executable php files
# cd priv/migration/ && php -S localhost:8000 &
cd priv/migration/ && php -r "require_once 'index.php';"

# if which xdg-open > /dev/null
# then
#   xdg-open http://localhost:8000
# elif which gnome-open > /dev/null
# then
#   gnome-open http://localhost:8000
# fi
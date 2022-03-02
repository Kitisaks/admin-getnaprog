#!/bin/bash
set +x

cd priv/statics/ && sudo php -r "require_once 'index.php';"


# if which xdg-open > /dev/null
# then
#   xdg-open http://localhost:8001
# elif which gnome-open > /dev/null
# then
#   gnome-open http://localhost:8001
# fi
#- direct and set executable php files
#!/bin/bash
set +x

cd priv/statics/ && php -S localhost:8001 &

if which xdg-open > /dev/null
then
  xdg-open http://localhost:8001
elif which gnome-open > /dev/null
then
  gnome-open http://localhost:8001
fi
#- direct and set executable php files

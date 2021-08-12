#!/bin/bash
set +x

#- direct and set executable php files
cd priv/server/ && php -S localhost:8000

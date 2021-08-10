#!/bin/bash
set -x

#- direct and set executable php files
cd priv/migration/ && php -S localhost:8000

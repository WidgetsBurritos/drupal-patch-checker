#!/bin/sh -l

sh -c "echo 'Build the project'"
composer install
echo $SUPER_SECRET_KEY

#!/bin/sh -l

# set -eu
sh -c "echo $*"
sh -c "echo 'Removing composer.lock'"
rm composer.lock
sh -c "echo 'Installing composer dependencies'"
composer install
sh -c "echo 'Running code style analysis'"
composer run phpcs

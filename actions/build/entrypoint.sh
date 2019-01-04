#!/bin/sh -l

set -eu
sh -c "echo $*"
composer install

#!/bin/sh -l

sh -c "echo 'Running code style analysis'"
composer run phpcs

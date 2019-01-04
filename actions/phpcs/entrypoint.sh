#!/bin/sh -l

sh -c "echo 'Running code style analysis'"
vendor/bin/phpcs --standard=vendor/drupal/coder/coder_sniffer/Drupal/ruleset.xml src/ tests/

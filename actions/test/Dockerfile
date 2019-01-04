FROM composer:latest

LABEL "com.github.actions.name"="test"
LABEL "com.github.actions.description"="Performs phpunit tests"
LABEL "com.github.actions.icon"="edit"
LABEL "com.github.actions.color"="red"

LABEL "repository"="https://github.com/WidgetsBurritos/drupal-patch-checker"
LABEL "homepage"="https://www.widgetsandburritos.com/posts/2018-12-07/patching-production-drupal-sites-hook-update-n-risky"
LABEL "maintainer"="David Stinemetze <davidstinemetze@gmail.com>"

ADD entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

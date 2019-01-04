FROM php:7.2

LABEL "com.github.actions.name"="phpcs"
LABEL "com.github.actions.description"="Performs code-style analysis"
LABEL "com.github.actions.icon"="code"
LABEL "com.github.actions.color"="blue"

LABEL "repository"="https://github.com/WidgetsBurritos/drupal-patch-checker"
LABEL "homepage"="https://www.widgetsandburritos.com/posts/2018-12-07/patching-production-drupal-sites-hook-update-n-risky"
LABEL "maintainer"="David Stinemetze <davidstinemetze@gmail.com>"

ADD entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

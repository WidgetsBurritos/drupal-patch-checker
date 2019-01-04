FROM composer:latest

LABEL "com.github.actions.name"="build"
LABEL "com.github.actions.description"="Builds the code"
LABEL "com.github.actions.icon"="terminal"
LABEL "com.github.actions.color"="black"

LABEL "repository"="https://github.com/WidgetsBurritos/drupal-patch-checker"
LABEL "homepage"="https://www.widgetsandburritos.com/posts/2018-12-07/patching-production-drupal-sites-hook-update-n-risky"
LABEL "maintainer"="David Stinemetze <davidstinemetze@gmail.com>"

ADD entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

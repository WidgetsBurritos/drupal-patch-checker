# drupal-patch-checker

A simple helper script for checking composer dependencies to ensure it's not adding hook_update_N() functions via patches.

Install this package as a dev dependency: 

```bash
composer require --dev widgetsburritos/drupal-patch-checker
```

Add this to your composer.json file: 

```json
     "scripts": {
         "post-install-cmd": [
             "WidgetsBurritos\\DrupalPatchChecker\\DrupalPatchChecker::checkComposerFile"
         ],
    }
```


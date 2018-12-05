# Drupal Patch Checker

A simple helper script for checking composer dependencies to ensure it's not adding `hook_update_N()` functions via patches.

## First Time Setup
Install this package as a dev dependency:

```bash
composer require --dev widgetsburritos/drupal-patch-checker
```

Then add the following to your `composer.json` file:

```json
    "scripts": {
        "check:patch": [
              "WidgetsBurritos\\DrupalPatchChecker\\DrupalPatchChecker::checkComposerFile"
         ],
    }
```

## Checking Patches Manually

You can check your patches manually by running:
```composer run check:patch```

This will produce a result similar to this:
```bash
$ composer run check:patch
> WidgetsBurritos\DrupalPatchChecker\DrupalPatchChecker::checkComposerFile
Script WidgetsBurritos\DrupalPatchChecker\DrupalPatchChecker::checkComposerFile handling the check:patch event terminated with an exception

  [Exception]                                                                                                              
  patches/language_hierarchy/language_hierarchy-limit_views_results-2825851-14.patch contains hook_update_N() on Line 50.  
```

## Checking Patches Automatically on Package Install/Update

If you want to prevent patches from getting installed altogether update your `composer.json` file accordingly:
```json
    "scripts": {
        "check:patch": [
              "WidgetsBurritos\\DrupalPatchChecker\\DrupalPatchChecker::checkComposerFile"
         ],
         "post-install-cmd": [
              "composer run check:patch"
         ],
         "post-update-cmd": [
              "composer run check:patch"
         ],
    }
```

Then the next time you run `composer install` or `composer update` if your project contains a patch with `hook_update_N()` it will throw an exception.

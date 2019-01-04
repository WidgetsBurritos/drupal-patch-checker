<?php

namespace WidgetsBurritos\DrupalPatchChecker;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;

/**
 * Checks to see if patches contain hook_update_N().
 */
class DrupalPatchChecker implements PluginInterface
{

  protected $composer;

  /**
   * Activates our patch checker.
   */
  public function activate(Composer $composer, IOInterface $io) {
    $this->composer = $composer;
  }

  /**
   * The main method of the checker script.
   *
   * It looks for any drupal modules installed and their corresponding
   * patches to determine if the patches contain new hook_update_N() references.
   *
   * You need to invoke it from the scripts section of your
   * "composer.json" file as "post-install-cmd" or "post-update-cmd".
   *
   * @param \Composer\Script\Event $event
   *   Composer event.
   */
  public static function checkComposerFile(Event $event) {
    $checker = new static();
    $checker->activate($event->getComposer(), $event->getIO());
    return $checker->parsePatches();
  }

  /**
   * Parses the defined patch list.
   *
   * @throws \Exception
   *   Upon discovery of hook_update_N().
   */
  public function parsePatches() {
    $extra = $this->composer->getPackage()->getExtra();
    $patch_lines = [];
    if (!empty($extra['patches'])) {
      foreach ($extra['patches'] as $package => $patch_info) {
        if (preg_match('|^drupal/([^/]+)$|', $package, $matches)) {
          $patched_package = $matches[0];
          $package_name = preg_quote($matches[1]);
          foreach ($patch_info as $description => $file) {
            $patch_lines = array_merge($patch_lines, $this->checkPatchFileForHookUpdateN($file, $package_name));
          }
        }
      }
    }
    if (!empty($patch_lines)) {
      throw new \Exception(implode(PHP_EOL, $patch_lines));
    }
  }

  /**
   * Checks specified patch file for hook_update_N().
   *
   * @param string $file
   *   Relative path to patch from composer base.
   * @param string $package_name
   *   Package name.
   *
   * @return array
   *   List of lines where hook_update_N() is defined.
   */
  public function checkPatchFileForHookUpdateN($file, $package_name) {
    $cwd = getcwd();
    $contents = file("{$cwd}/{$file}");
    return $this->checkPatchFileArrayForHookUpdateN($contents, $file, $package_name);
  }

  /**
   * Checks specified patch file for hook_update_N().
   *
   * @param array $contents
   *   Patch file contents split by line in an array.
   * @param string $file
   *   Relative path to patch from composer base.
   * @param string $package_name
   *   Name of the module.
   *
   * @return array
   *   List of lines where hook_update_N() is defined.
   */
  public function checkPatchFileArrayForHookUpdateN(array $contents, $file, $package_name) {
    $regex = "|^\+\s*function\s+{$package_name}_update_\d+|";
    $patch_lines = [];
    foreach ($contents as $num => $line) {
      if (preg_match($regex, $line)) {
        $patch_lines[] = "{$file} contains hook_update_N() on Line {$num}.";
      }
    }
    return $patch_lines;
  }

}

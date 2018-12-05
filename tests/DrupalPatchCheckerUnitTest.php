<?php

use PHPUnit\Framework\TestCase;
use WidgetsBurritos\DrupalPatchChecker\DrupalPatchChecker;

/**
 * Tests for WebPageTest class.
 */
class DrupalPatchCheckerUnitTest extends TestCase {

  /**
   * Checks patches for new hook_update_N() functions.
   */
  public function testCheckPatchFileArrayForHookUpdateNreturnsCorrectLines() {
    $dpc = new DrupalPatchChecker();
    $contents = [
      '@@@ function specialmodule_update_8001() {',
      '-function specialmodule_update_8002() {',
      '+function specialmodule_update_8003() {',
      '+function       specialmodule_update_8004   ()    {',
      '+function specialmodule_update_8005',
      '+function specialmodule_update_NOTVALID() {',
      '+function someothermodule_update_8006() {',
    ];
    $actual = $dpc->checkPatchFileArrayForHookUpdateN($contents, 'myfile.patch', 'specialmodule');
    $expected = [
      'myfile.patch contains hook_update_N() on Line 2.',
      'myfile.patch contains hook_update_N() on Line 3.',
      'myfile.patch contains hook_update_N() on Line 4.',
    ];
    $this->assertEquals($expected, $actual);
  }

}

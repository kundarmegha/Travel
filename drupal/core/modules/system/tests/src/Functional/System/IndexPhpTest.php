<?php

namespace Drupal\Tests\system\Functional\System;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the handling of requests containing 'index.html'.
 *
 * @group system
 */
class IndexPhpTest extends BrowserTestBase {
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test index.html handling.
   */
  public function testIndexPhpHandling() {
    $index_php = $GLOBALS['base_url'] . '/index.html';

    $this->drupalGet($index_php, ['external' => TRUE]);
    $this->assertResponse(200, 'Make sure index.html returns a valid page.');

    $this->drupalGet($index_php . '/user', ['external' => TRUE]);
    $this->assertResponse(200, 'Make sure index.html/user returns a valid page.');
  }

}

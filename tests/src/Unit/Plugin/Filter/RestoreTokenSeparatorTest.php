<?php

declare(strict_types=1);

namespace Drupal\Tests\html_filter_token_workaround\Unit\Plugin\Filter;

use Drupal\html_filter_token_workaround\Plugin\Filter\RestoreTokenSeparator;
use Drupal\Tests\UnitTestCase;

class RestoreTokenSeparatorTest extends UnitTestCase {

  /**
   * @dataProvider provideRunCases
   */
  public function testRun(string $expectedResult, string $input): void {
    $this->assertSame($expectedResult, RestoreTokenSeparator::run($input));
  }

  public function provideRunCases(): array {
    return [
      // Invalid token.
      ['site;login-url', 'site;login-url'],
      // Invalid token.
      ['[site;]', '[site;]'],
      // Invalid token.
      ['[;login-url]', '[;login-url]'],
      // Invalid token.
      ['[login-url]', '[login-url]'],
      // Valid token.
      ['[site:login-url]', '[site;login-url]'],
      // Valid token with extra text.
      ['Test [site:login-url] hej', 'Test [site;login-url] hej'],
      // Multiple valid tokens with extra text.
      ['Test [site:login-url] hej [user:name] hej2', 'Test [site;login-url] hej [user;name] hej2'],
    ];
  }

}

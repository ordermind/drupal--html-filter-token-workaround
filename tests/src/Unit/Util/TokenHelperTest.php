<?php

declare(strict_types=1);

namespace Drupal\Tests\html_filter_token_workaround\Util;

use Drupal\html_filter_token_workaround\Util\TokenHelper;
use Drupal\Tests\UnitTestCase;

class TokenHelperTest extends UnitTestCase {

  /**
   * @dataProvider provideFindTokenCases
   */
  public function testFindToken(array $expectedResult, string $input): void {
    $this->assertSame($expectedResult, TokenHelper::findTokens($input, ':'));
  }

  public function provideFindTokenCases(): array {
    return [
      // Invalid token.
      [[], 'site:login-url'],
      // Invalid token.
      [[], '[site:]'],
      // Invalid token.
      [[], '[:login-url]'],
      // Invalid token.
      [[], '[login-url]'],
      // Valid token.
      [['site:login-url'], '[site:login-url]'],
      // Valid token with extra text.
      [['site:login-url'], 'Test [site:login-url] hej'],
      // Multiple valid tokens with extra text.
      [['site:login-url', 'user:name'], 'Test [site:login-url] hej [user:name] hej2'],
    ];
  }

}

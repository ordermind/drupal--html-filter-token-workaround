<?php

namespace Drupal\html_filter_token_workaround\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\html_filter_token_workaround\Enum\TokenSeparatorEnum;
use Drupal\html_filter_token_workaround\Util\TokenHelper;

/**
 * Provides a 'RestoreTokenSeparator' filter.
 *
 * @Filter(
 *   id = "html_filter_token_workaround_restoretokenseparator",
 *   title = @Translation("Restore token separator"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_IRREVERSIBLE,
 *   weight = -10
 * )
 */
class RestoreTokenSeparator extends FilterBase {

  public static function run(string $text): string {
    $tokens = TokenHelper::findTokens($text, TokenSeparatorEnum::MODIFIED_SEPARATOR);
    foreach ($tokens as $token) {
      $modifiedToken = str_replace(
        TokenSeparatorEnum::MODIFIED_SEPARATOR,
        TokenSeparatorEnum::ORIGINAL_SEPARATOR,
        $token
      );
      $text = str_replace($token, $modifiedToken, $text);
    }

    return $text;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    return new FilterProcessResult($this->run($text));
  }

}

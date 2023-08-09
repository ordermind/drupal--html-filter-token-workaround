<?php

namespace Drupal\html_filter_token_workaround\Util;

class TokenHelper {

  /**
   * Finds all token-like substrings in the text and returns a flat array with
   * all the tokens that were found.
   */
  public static function findTokens(string $text, string $separator): array {
    // Matches tokens with the following pattern: [$type:$name]
    // $type and $name may not contain [ ] characters.
    // $type may not contain : or whitespace characters, but $name may.
    preg_match_all("/
    \[             # [ - pattern start
    ([^\s\[\]{$separator}]+  # match token type not containing whitespace, separator, [ or ]
    {$separator}
    [^\[\]]+)     # match token name not containing [ or ]
    \]             # ] - pattern end
    /x", $text, $matches);

    return $matches[1] ?? [];
  }

}

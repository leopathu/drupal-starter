<?php

declare(strict_types=1);

namespace Drupal\server_general\ThemeTrait;

use Drupal\server_general\ThemeTrait\Enum\AlignmentEnum;
use Drupal\server_general\ThemeTrait\Enum\FontSizeEnum;
use Drupal\server_general\ThemeTrait\Enum\FontWeightEnum;
use Drupal\server_general\ThemeTrait\Enum\TextColorEnum;

/**
 * Helper methods for rendering People/Person Teaser elements.
 */
trait PersonCardsThemeTrait {

  use ElementLayoutThemeTrait;
  use ElementWrapThemeTrait;
  use InnerElementLayoutThemeTrait;
  use CardThemeTrait;

  /**
   * Build People cards element.
   *
   * @param string $title
   *   The title.
   * @param array $body
   *   The body render array.
   * @param array $items
   *   The render array built with
   *   `ElementLayoutThemeTrait::buildElementLayoutTitleBodyAndItems`.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCards(string $title, array $body, array $items): array {
    
    $content = [
      '#theme' => 'server_theme_person_cards',
      '#cards' => $items,
    ];

    return $this->buildElementLayoutTitleBodyAndItems(
      $title,
      $body,
      $content,
    );
  }

}

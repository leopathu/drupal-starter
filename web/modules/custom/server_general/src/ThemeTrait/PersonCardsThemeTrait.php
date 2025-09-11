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
   * Build a single Person card element.
   * @param array $person
   *  An associative array containing:
   * - name: The person's name (string, required).
   * - image_url: URL of the person's profile image (string, optional).
   * - role: The person's role or badge (string, optional).
   * - description: A brief description of the person (string, optional).
   * - email: The person's email address (string, optional).
   * - phone: The person's phone number (string, optional).
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCard(array $person): array {
    $elements = [];

    // Profile image.
    if (!empty($person['image_url'])) {
      $elements[] = [
        '#theme' => 'image',
        '#uri' => $person['image_url'],
        '#alt' => $person['name'],
        '#width' => 128,
        '#attributes' => [
          'class' => 'rounded-full object-cover mx-auto mb-4',
        ],
      ];
    }

    // Name.
    $name = $this->wrapTextFontWeight($person['name'], FontWeightEnum::Bold);
    $name = $this->wrapTextResponsiveFontSize($name, FontSizeEnum::Xl);
    $name = $this->wrapTextCenter($name);
    $elements[] = $name;

    // Description.
    if (!empty($person['description'])) {
      $description = $this->wrapTextResponsiveFontSize($person['description'], FontSizeEnum::Sm);
      $description = $this->wrapTextColor($description, TextColorEnum::Gray);
      $description = $this->wrapTextCenter($description);
      $elements[] = $description;
    }

    // Admin badge.
    if (!empty($person['role'])) {
      $elements[] = [
        '#type' => 'html_tag',
        '#tag' => 'span',
        '#value' => $person['role'],
        '#attributes' => [
          'class' => 'mt-2 px-4 py-2 text-xs font-medium text-green-800 bg-green-400 rounded-full inline-block',
        ],
      ];
    }

    // Contact buttons.
    $buttons = [
      '#type' => 'container',
      '#attributes' => ['class' => 'mt-4 grid grid-cols-2 gap-3 w-full'],
      'content' => [
        $person['mail'] ?? NULL,
        $person['phone'] ?? NULL,
      ],
    ];
    $elements[] = $buttons;

    // Card container.
    $card = [
      '#type' => 'container',
      '#attributes' => ['class' => 'border bg-white rounded-lg shadow-sm p-6 flex flex-col items-center text-center'],
      'content' => $elements,
    ];
    return $card;
  }

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
    return $this->buildElementLayoutTitleBodyAndItems(
      $title,
      $body,
      $this->buildCards($items),
    );
  }

}

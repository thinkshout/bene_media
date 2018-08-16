<?php

namespace Drupal\bene_media\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\entity_browser\Plugin\Field\FieldWidget\EntityReferenceBrowserWidget as BaseEntityReferenceBrowserWidget;

/**
 * Cosmetic enhancements for the Entity Browser entity reference widget.
 */
class EntityReferenceBrowserWidget extends BaseEntityReferenceBrowserWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);

    if (isset($element['current']['#prefix'])) {
      // Move the remaining number of selections to the details summary.
      $element['#description'] .= $element['current']['#prefix'];
      unset($element['current']['#prefix']);
    }

    // Wrap the current selections in a nice <details> element.
    $cardinality = $this->fieldDefinition
      ->getFieldStorageDefinition()
      ->getCardinality();

    $element['current']['#theme_wrappers'] = [
      'details' => [
        '#attributes' => [
          'open' => TRUE,
        ],
        '#summary_attributes' => [],
        '#title' => $this->formatPlural($cardinality, 'Current selection', 'Current selections'),
      ],
    ];

    return $element;
  }

}

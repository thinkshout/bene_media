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

    $theme_wrappers = [];
    $theme_wrapper_extra_data = [
      'details' => [
        '#attributes' => [
          'open' => TRUE,
        ],
        '#summary_attributes' => [],
        '#title' => $this->formatPlural($cardinality, 'Current selection', 'Current selections'),
      ],
    ];

    // Add the extra theme wrapper data in all the render elements.
    foreach ($element['current']['#theme_wrappers'] as $key => $render_element) {
      // If the render element is already an array then there is no need to make
      // it an array.
      if (is_array($render_element)) {
        $theme_wrappers[$key] = $render_element + $theme_wrapper_extra_data;
      }
      // Make this an array if it is not.
      else {
        $theme_wrappers[$render_element] = $theme_wrapper_extra_data;
      }
    }
    // Set the modified theme wrapper data.
    $element['current']['#theme_wrappers'] = $theme_wrappers;

    return $element;
  }

}

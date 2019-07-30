<?php

/**
 * @file
 * Contains shared install logic for bene_media.
 */

use Drupal\field\Entity\FieldConfig;
use Drupal\media\Entity\MediaType;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Adds the media_tags field to a given bundle.
 *
 * @param string $bundle
 *   The media bundle ID.
 */
function _bene_media_update_add_tags($bundle) {
  if (!FieldStorageConfig::loadByName('media', 'media_tags')) {
    return;
  }
  if (!MediaType::load($bundle)) {
    return;
  }
  if (!FieldConfig::loadByName('media', $bundle, 'media_tags')) {
    FieldConfig::create([
      'id' => 'media.' . $bundle . '.media_tags',
      'field_name' => 'media_tags',
      'entity_type' => 'media',
      'bundle' => $bundle,
      'label' => 'Tags',
      'description' => '',
      'required' => FALSE,
      'translatable' => TRUE,
      'default_value' => [],
      'default_value_callback' => '',
      'settings' => [
        'handler' => 'default:taxonomy_term',
        'handler_settings' => [
          'target_bundles' => [
            'media_tags' => 'media_tags',
          ],
          'sort' => [
            'field' => '_none',
          ],
          'auto_create' => TRUE,
          'auto_create_bundle' => '',
        ],
      ],
      'field_type' => 'entity_reference',
    ])->save();
  }
  foreach (\Drupal::configFactory()->listAll('core.entity_form_display.media.' . $bundle) as $config_id) {
    $display = \Drupal::configFactory()->getEditable($config_id);
    $display->set('content.media_tags', [
      'type' => 'entity_reference_autocomplete_tags',
      'weight' => 2,
      'region' => 'content',
      'settings' => [
        'match_operator' => 'CONTAINS',
        'size' => 60,
        'placeholder' => '',
      ],
      'third_party_settings' => [],
    ]);
    $display->clear('hidden.media_tags');
    $dependencies = $display->get('dependencies.config');
    if (!in_array('field.field.media.' . $bundle . '.media_tags', $dependencies, TRUE)) {
      $dependencies[] = 'field.field.media.' . $bundle . '.media_tags';
    }
    $display->set('dependencies.config', $dependencies);
    $display->save(TRUE);
  }
}

<?php

/**
 * Uninstall obsolete modules.
 */
function bene_media_post_update_disable_obsolete_modules_85() {
  $to_remove = ['bene_media_document', 'media_entity_document', 'media_entity_image'];
  foreach ($to_remove as $modulename) {
    if (\Drupal::moduleHandler()->moduleExists($modulename)) {
      \Drupal::service('module_installer')->uninstall([$modulename]);
    }
  }
}

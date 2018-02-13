<?php

namespace Drupal\bene_media;

use Drupal\file\FileInterface;
use Drupal\media\MediaTypeInterface;

/**
 * Implements InputMatchInterface for media types that use a file field.
 */
trait FileInputExtensionMatchTrait {

  /**
   * Returns the entity type manager.
   *
   * @return \Drupal\Core\Entity\EntityTypeManagerInterface
   *   The entity type manager.
   */
  private function entityTypeManager() {
    return @($this->entityTypeManager ?: \Drupal::entityTypeManager());
  }

  /**
   * Implements InputMatchInterface::appliesTo().
   */
  public function appliesTo($value, MediaTypeInterface $type) {
    if (is_numeric($value)) {
      $value = $this->entityTypeManager()->getStorage('file')->load($value);
    }

    if ($value instanceof FileInterface && $this instanceof SourceFieldInterface && ($field = $this->getSourceFieldDefinition($type))) {
      $extension = pathinfo($value->getFilename(), PATHINFO_EXTENSION);
      $extension = strtolower($extension);

      return in_array(
        $extension,
        preg_split('/,?\s+/', $field->getSetting('file_extensions'))
      );
    }
    return FALSE;
  }

}

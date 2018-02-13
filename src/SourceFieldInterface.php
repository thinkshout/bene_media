<?php

namespace Drupal\bene_media;

use Drupal\media\MediaTypeInterface;

/**
 * An interface for media type plugins that depend on a configured source field.
 */
interface SourceFieldInterface {

  /**
   * Returns the definition of the configured source field.
   *
   * @param \Drupal\media\MediaTypeInterface $type
   *   The media type that is using this source field.
   *
   * @return \Drupal\Core\Field\FieldDefinitionInterface|null
   *   The source field definition, or NULL if it does not exist or is not
   *   configured.
   */
  public function getSourceFieldDefinition(MediaTypeInterface $type);

}

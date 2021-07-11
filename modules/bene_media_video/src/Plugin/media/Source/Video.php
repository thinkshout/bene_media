<?php

namespace Drupal\bene_media_video\Plugin\media\Source;

use Drupal\bene_media\InputMatchInterface;
use Drupal\media\MediaTypeInterface;
use Drupal\video_embed_media\Plugin\media\Source\VideoEmbedField;

/**
 * Input-matching version of the VideoEmbedField media type.
 */
class Video extends VideoEmbedField implements InputMatchInterface {

  /**
   * {@inheritdoc}
   */
  public function appliesTo($value, MediaTypeInterface $type) {
    return (boolean) $this->providerManager->loadProviderFromInput($value);
  }

}

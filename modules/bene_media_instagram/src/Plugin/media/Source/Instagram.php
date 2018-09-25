<?php

namespace Drupal\bene_media_instagram\Plugin\media\Source;

use Drupal\bene_media\InputMatchInterface;
use Drupal\bene_media\ValidationConstraintMatchTrait;
use Drupal\media_entity_instagram\Plugin\media\Source\Instagram as BaseInstagram;

/**
 * Input-matching version of the Instagram media type.
 */
class Instagram extends BaseInstagram implements InputMatchInterface {

  use ValidationConstraintMatchTrait;

}

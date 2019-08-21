<?php

namespace Drupal\bene_media_twitter\Plugin\media\Source;

use Drupal\bene_media\InputMatchInterface;
use Drupal\bene_media\ValidationConstraintMatchTrait;
use Drupal\media_entity_twitter\Plugin\media\Source\Twitter as BaseTwitter;

/**
 * Input-matching version of the Twitter media type.
 */
class Twitter extends BaseTwitter implements InputMatchInterface {

  use ValidationConstraintMatchTrait;

}

<?php

namespace Drupal\bene_media\Plugin\media\Source;

use Drupal\bene_media\FileInputExtensionMatchTrait;
use Drupal\bene_media\InputMatchInterface;
use Drupal\media\Plugin\media\Source\VideoFile as CoreVideoFile;

/**
 * Input-matching version of the VideoFile media source.
 */
class VideoFile extends CoreVideoFile implements InputMatchInterface {

  use FileInputExtensionMatchTrait;

}

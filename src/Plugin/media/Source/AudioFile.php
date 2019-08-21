<?php

namespace Drupal\bene_media\Plugin\media\Source;

use Drupal\bene_media\FileInputExtensionMatchTrait;
use Drupal\bene_media\InputMatchInterface;
use Drupal\media\Plugin\media\Source\AudioFile as CoreAudioFile;

/**
 * Input-matching version of the AudioFile media source.
 */
class AudioFile extends CoreAudioFile implements InputMatchInterface {

  use FileInputExtensionMatchTrait;

}

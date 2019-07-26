<?php

namespace Drupal\bene_media\Plugin\media\Source;

use Drupal\bene_media\FileInputExtensionMatchTrait;
use Drupal\bene_media\InputMatchInterface;
use Drupal\media\Plugin\media\Source\File as CoreFile;

/**
 * Input-matching version of the File media source.
 */
class File extends CoreFile implements InputMatchInterface {

  use FileInputExtensionMatchTrait;

}

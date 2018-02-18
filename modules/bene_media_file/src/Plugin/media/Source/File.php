<?php

namespace Drupal\bene_media_file\Plugin\media\Source;

use Drupal\bene_media\FileInputExtensionMatchTrait;
use Drupal\bene_media\InputMatchInterface;
use Drupal\media\Plugin\media\Source\File as BaseFile;

/**
 * Input-matching version of the File media type.
 */
class File extends BaseFile implements InputMatchInterface {

  use FileInputExtensionMatchTrait;

}

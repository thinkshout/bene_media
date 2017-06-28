<?php

namespace Drupal\Tests\bene_media\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\bene_core\ConfigHelper as Config;

/**
 * Tests of API-level Bene functionality related to media bundles.
 *
 * @group bene
 * @group bene_media
 */
class MediaBundleTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'field',
    'file',
    'image',
    'bene_core',
    'bene_media',
    'media_entity',
    'user',
    'views',
  ];

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    Config::forModule('bene_media')
      ->getEntity('field_storage_config', 'media.field_media_in_library')
      ->save();

    $this->container
      ->get('entity_type.manager')
      ->getStorage('media_bundle')
      ->create([
        'id' => 'foo',
        'label' => $this->randomString(),
      ])
      ->save();
  }

  /**
   * Tests that field_media_in_library is auto-cloned for new media bundles.
   */
  public function testCloneMediaInLibraryField() {
    /** @var \Drupal\media_entity\MediaInterface $media */
    $media = $this->container
      ->get('entity_type.manager')
      ->getStorage('media')
      ->create([
        'bundle' => 'foo',
      ]);

    $this->assertTrue(
      $media->hasField('field_media_in_library')
    );

    // The field should be present in the form as a checkbox.
    $component = entity_get_form_display('media', 'foo', 'default')
      ->getComponent('field_media_in_library');

    $this->assertInternalType('array', $component);
  }

}

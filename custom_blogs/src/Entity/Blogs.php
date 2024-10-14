<?php

declare(strict_types=1);

namespace Drupal\custom_blogs\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\custom_blogs\BlogsInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the blogs entity class.
 *
 * @ContentEntityType(
 *   id = "custom_blogs_blogs",
 *   label = "Blogs",
 *   label_collection = @Translation("Blogs"),
 *   label_singular = @Translation("blogs"),
 *   label_plural = @Translation("blogs"),
 *   label_count = @PluralTranslation(
 *     singular = "@count blogs",
 *     plural = "@count blogs",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\custom_blogs\BlogsListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\custom_blogs\Form\BlogsForm",
 *       "edit" = "Drupal\custom_blogs\Form\BlogsForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "custom_blogs_blogs",
 *   admin_permission = "administer custom_blogs_blogs",
 *   entity_keys = {
 *     "id" = "id",
 *     "title" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/blogs",
 *     "add-form" = "/blogs/add",
 *     "canonical" = "/blogs/{custom_blogs_blogs}",
 *     "edit-form" = "/blogs/{custom_blogs_blogs}/edit",
 *     "delete-form" = "/blogs/{custom_blogs_blogs}/delete",
 *     "delete-multiple-form" = "/admin/content/blogs/delete-multiple",
 *   },
 *   field_ui_base_route = "entity.custom_blogs_blogs.settings",
 * )
 */
final class Blogs extends ContentEntityBase implements BlogsInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);
    
      $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'hidden',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created Date'))
      ->setDescription(t('The time that the blogs was created.'))
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'timestamp',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('view', TRUE);

      $fields['status'] = BaseFieldDefinition::create('boolean')
  ->setLabel(t('Active'))
  ->setDefaultValue(TRUE)  // Default value is TRUE
  ->setSetting('on_label', 'True')
  ->setSetting('off_label', 'False')
  ->setDisplayOptions('form', [
    'type' => 'boolean_checkbox',
    'settings' => [
      'display_label' => FALSE,
    ],
    'weight' => -2,
  ])
  ->setDisplayConfigurable('form', TRUE)
  ->setDisplayOptions('view', [
    'type' => 'boolean',
    'label' => 'hidden',
    'weight' => -2,
    'settings' => [
      'format' => 'custom',
      'on_label' => t('True'),  // Ensure this is translatable
      'off_label' => t('False'),  // Ensure this is translatable
    ],
  ])
  ->setDisplayConfigurable('view', TRUE);


    

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the blogs was last edited.'));

    return $fields;
  }

}

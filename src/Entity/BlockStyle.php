<?php

namespace Drupal\adv_block_class\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\adv_block_class\BlockStyleInterface;

/**
 * Defines the Block Style entity.
 *
 * @ConfigEntityType(
 *   id = "block_style",
 *   label = @Translation("Block Style"),
 *   handlers = {
 *     "list_builder" = "Drupal\adv_block_class\Controller\BlockStyleListBuilder",
 *     "form" = {
 *       "add" = "Drupal\adv_block_class\Form\BlockStyleForm",
 *       "edit" = "Drupal\adv_block_class\Form\BlockStyleForm",
 *       "delete" = "Drupal\adv_block_class\Form\BlockStyleDeleteForm",
 *     }
 *   },
 *   config_prefix = "block_style",
 *   admin_permission = "administer block style congiguration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "block_types",
 *     "classes",
 *     "multiple"
 *   },
 *   links = {
 *     "edit-form" = "/admin/structure/block/style/{block_style}",
 *     "delete-form" = "/admin/structure/block/style/{block_style}/delete",
 *   }
 * )
 */
class BlockStyle extends ConfigEntityBase implements BlockStyleInterface {

  /**
   * The Block Style ID.
   *
   * @var string
   */
  public $id;

  /**
   * The Block Style label.
   *
   * @var string
   */
  public $label;
  
  /**
   * The Block Style block types.
   *
   * @var array
   */
  public $blockTypes;
  
  /**
   * The Block Style classes.
   *
   * @var string
   */
  public $classes;
  
  /**
   * The Block Style to allow multiple classes selected.
   *
   * @var boolean
   */
  public $multiple;
  
  /**
   * The Block Style description.
   *
   * @var string
   */
  public $description;

  // Your specific configuration property get/set methods go here,
  // implementing the interface.
  
  public function getLabel() {
    return $this->label;
  }
  
  public function getBlockTypes() {
    return $this->block_types;
  }
  
  public function getClasses() {
    return $this->classes;
  }
  
  public function getMultiple() {
    return $this->multiple;
  }
  
  public function getDescription() {
    return $this->description;
  }
  
  public function setLabel($label) {
    $this->label = $label;
  }
  
  public function setBlockTypes($blockTypes) {
    $this->blockTypes = $blockTypes;
  }
  
  public function setClasses($classes) {
    $this->classes = $classes;
  }
  
  public function setMultiple($multiple) {
    $this->multiple = $multiple;
  }
  
  public function setDescription($description) {
    $this->classes = $description;
  }
}


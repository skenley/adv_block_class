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
 *     "label"
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

  // Your specific configuration property get/set methods go here,
  // implementing the interface.
}


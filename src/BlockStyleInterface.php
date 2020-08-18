<?php

namespace Drupal\adv_block_class;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining an Example entity.
 */
interface BlockStyleInterface extends ConfigEntityInterface {
  
  /**
   * Sets the name of the block style entity.
   */
  public function setLabel($label);
  
  /**
   * Sets the block types referenced by the block style entity.
   */
  public function setBlockTypes($blockTypes);
  
  /**
   * Sets the class names for the block style entity.
   */
  public function setClasses($blockClasses);
  
  /**
   * Sets the value of the multiple field to allow or disallow multiple class selections.
   */
  public function setMultiple($multiple);
  
  /**
   * Gets the name of the block style entity.
   */
  public function getLabel();
  
  /**
   * Gets the block types referenced by the block style entity.
   */
  public function getBlockTypes();
  
  /**
   * Gets the class names for the block style entity.
   */
  public function getClasses();
  
  /**
   * Gets the value of the multiple field to allow or disallow multiple class selections.
   */
  public function getMultiple();
  
}


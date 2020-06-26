<?php

namespace Drupal\adv_block_class\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Block Styles.
 */
class BlockStyleListBuilder extends ConfigEntityListBuilder {
  
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Block Style');
    $header['id'] = $this->t('Machine name');
    return $header + parent::buildHeader();
  }
  
  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    
    return $row + parent::buildRow($entity);
  }
}

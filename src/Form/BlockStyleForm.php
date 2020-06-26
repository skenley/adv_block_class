<?php

namespace Drupal\adv_block_class\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form handler for the Block Style add and edit forms.
 */
class BlockStyleForm extends EntityForm {
  
  /**
   * Constructs a BlockStyleForm object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *  The entityTypeManager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }
  
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parrent::form($form, $form_state);
    
    $blockStyle = $this->entity;
    
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $blockStyle->label(),
      '#description' => $this->t('Label for the Block Style.'),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $blockStyle->id(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
      '#disabled' => !$blockStyle->isNew(),
    ];
    
    
    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $blockStyle = $this->entity;
    $status = $blockStyle->save();

    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage($this->t('The %label Block Style created.', [
        '%label' => $blockStyle->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %label Block Style updated.', [
        '%label' => $blockStyle->label(),
      ]));
    }
    $form_state->setRedirect('entity.block_style.collection');
  }
  
  /**
   * Helper function to check whether a Block Style configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityTypeManager->getStorage('block_style')->getQuery()
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }
}
<?php

namespace Drupal\adv_block_class\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\adv_block_class\Entity\BlockStyle;

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
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    
    $blockStyle = $this->entity;
    $blockTypes = \Drupal::service('entity_type.bundle.info')->getBundleInfo('block_content');
    $blockTypeLabels = [];
    foreach ($blockTypes as $key => $blockType) {
      $blockTypeLabels[$key] = $blockType['label'];
    }
    //kint($blockTypeLabels);
    // kint(BlockStyle::load('test_style'));
    
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
    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#maxlength' => 255,
      '#default_value' => $blockStyle->getDescription(),
      '#description' => $this->t('Description for adminstrative view.'),
    ];
    $form['classes'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Classes'),
      '#default_value' => $blockStyle->getClasses(),
      '#description' => $this->t('The possible values this field can contain. Enter one value per line, in the format key|label.<br>The key is the stored value. The label will be used in the edit form.<br>The label is optional: if a line contains a single string, it will be used as the key and label.'),
    ];
    $form['multiple'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow multiple selections'),
      '#default_value' => $blockStyle->getMultiple(),
      '#description' => $this->t('Check this box to allow the user to select multiple classes from this list. If unchecked only one selection will be allowed.'),
    ];
    
    // TODO Add functionality to select which block types to associate block styles with.
    // 
    $form['blockTypes'] = [
      '#type' => 'select',
      '#title' => $this->t('Block Type(s)'),
      '#options' => $blockTypeLabels,
      '#multiple' => TRUE,
      '#default_value' => $blockStyle->getBlockTypes(),
      '#description' => $this->t('Select block types you want to make this set of classes available for. Leave blank for all block types.'),
    ];
 
    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $blockStyle = $this->entity;
    $blockTypesJson = json_encode($form_state->getValues()['blockTypes']);
    $blockStyle->setBlockTypes($blockTypesJson);
    $status = $blockStyle->save(TRUE);
    
    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage($this->t('The %label Block Style has been created.', [
        '%label' => $blockStyle->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %label Block Style has been updated.', [
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
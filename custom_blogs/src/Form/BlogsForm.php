<?php

declare(strict_types=1);

namespace Drupal\custom_blogs\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the blogs entity edit forms.
 */
final class BlogsForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $result = parent::save($form, $form_state);

    $message_args = ['%title' => $this->entity->toLink()->toString()];
    $logger_args = [
      '%title' => $this->entity->label(),
      'link' => $this->entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New blogs %title has been created.', $message_args));
        $this->logger('custom_blogs')->notice('New blogs %title has been created.', $logger_args);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The blogs %title has been updated.', $message_args));
        $this->logger('custom_blogs')->notice('The blogs %title has been updated.', $logger_args);
        break;

      default:
        throw new \LogicException('Could not save the entity.');
    }

    $form_state->setRedirectUrl($this->entity->toUrl());

    return $result;
  }

}

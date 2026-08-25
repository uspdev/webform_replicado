<?php

declare(strict_types=1);

namespace Drupal\webform_replicado\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure webform_replicado settings for this site.
 */
final class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'webform_replicado_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['webform_replicado.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('webform_replicado.settings');

    $form['database_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database Name'),
      '#maxlength' => 64,
      '#size' => 20,
      '#default_value' => $config->get('database_name'),
    ];
    $form['database_port'] = [
      '#type' => 'number',
      '#title' => $this->t('Database Port'),
      '#default_value' => $config->get('database_port'),
    ];
    $form['database_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database Host'),
      '#default_value' => $config->get('database_host'),
    ];
    $form['database_user'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database User'),
      '#default_value' => $config->get('database_user'),
    ];
    $form['database_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database password'),
      '#maxlength' => 64,
      '#size' => 20,
      '#default_value' => $config->get('database_password'),
    ];
    $form['replicado_fake'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Replicado Fake'),
      '#maxlength' => 64,
      '#size' => 20,
      '#default_value' => $config->get('replicado_fake'),
    ];

    $form['cod_unidade'] = [
      '#type' => 'checkbox',
      '#title' => $this ->t('Use código da unidade'),
      '#maxlength' => 64,
      '#size' => 20,
      '#default_value' => $config->get ('cod_unidade')
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if ($form_state->getValue('example') === 'wrong') {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('The value is not correct.'),
    //     );
    //   }
    // @endcode
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('webform_replicado.settings')
      ->set('database_name', $form_state->getValue('database_name'))
      ->set('database_port', $form_state->getValue('database_port'))
      ->set('database_host', $form_state->getValue('database_host'))
      ->set('database_user', $form_state->getValue('database_user'))
      ->set('database_password', $form_state->getValue('database_password'))
      ->set('replicado_fake', $form_state->getValue('replicado_fake'))
      ->save();

  parent::submitForm($form, $form_state);
  }
}
  
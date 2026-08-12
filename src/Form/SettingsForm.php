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

    $form['replicado'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Configurações do Replicado'),
    ];

    $form['replicado']['config_departamentos'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Departamentos'),
      '#description' => $this->t('Área de configuração da validação de Departamentos.'),
      '#default_value' => $config->get('config_departamentos'),
    ];

    $form['replicado']['config_pos_graduacao'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Pós-Graduação'),
      '#description' => $this->t('Área de configuração da validação de Pós-Graduação.'),
      '#default_value' => $config->get('config_pos_grad'),
    ];

    $form['replicado']['config_numero_usp'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Número USP'),
      '#description' => $this->t('Área de configuração da validação de Número USP.'),
      '#default_value' => $config->get('config_numero_usp'),
    ];

    $form['replicado']['config_habilitacoes'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Habilitações'),
      '#description' => $this->t('Área de configuração da validação de Habilitações.'),
      '#default_value' => $config->get('config_habilitacoes'),
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
    ->set('config_departamentos', $form_state->getValue('config_departamentos'))
    ->set('config_pos_graduacao', $form_state->getValue('config_pos_grad'))
    ->set('config_numero_usp', $form_state->getValue('config_numero_usp'))
    ->set('config_habilitacoes', $form_state->getValue('config_habilitacoes'))
    ->save();

  parent::submitForm($form, $form_state);
  }
}
  
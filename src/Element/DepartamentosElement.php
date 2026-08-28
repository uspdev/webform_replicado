<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;
use Uspdev\Replicado\Graduacao;

/**
 * Provides a custom Graduacao Departamentos select element.
 *
 * @FormElement("departamentos")
 */
class DepartamentosElement extends Select {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    $class = get_class($this);

    $config = \Drupal::service('config.factory')->getEditable('webform_replicado.settings');
    $database_name = $config->get('database_name');
    $database_port = $config->get('database_port');
    $database_host = $config->get('database_host');
    $database_user = $config->get('database_user');
    $database_password = $config->get('database_password');
    $database_fake = $config->get('replicado_fake');
   
    // Se não for informado na configuração, define o padrão 8
    $database_codunidade = $config->get('cod_unidade') ?: 8;

    /* Conexão com o Replicado */
    putenv("REPLICADO_HOST={$database_host}");
    putenv("REPLICADO_PORT={$database_port}");
    putenv("REPLICADO_DATABASE={$database_name}");
    putenv("REPLICADO_USERNAME={$database_user}");
    putenv("REPLICADO_PASSWORD={$database_password}");
    putenv("REPLICADO_CODUNDCLG={$database_codunidade}");

    // Define se deve utilizar o modo FAKE
    if ($database_fake) {
      putenv("REPLICADO_FAKE=true");
    } else {
      putenv("REPLICADO_FAKE=false");
    }

    $options = [];

    try {
      // Chama o método público da classe
      $departamentos = Graduacao::listarDepartamentosDeEnsino();

      if (!empty($departamentos) && is_array($departamentos)) {
        // Mapeia codset => nomset
        $options = array_column($departamentos, 'nomset', 'codset');
        asort($options);
      }
    } 
    catch (\Throwable $e) {
      \Drupal::logger('webform_replicado')->error('Erro ao listar departamentos do Replicado: @msg', [
        '@msg' => $e->getMessage(),
      ]);
    }

    return [
      '#input' => TRUE,
      '#empty_option' => $this->t('- Selecione um departamento -'),
      '#options' => $options,
      '#element_validate' => [
        [$class, 'validateDepartamentos'],
      ],
    ] + parent::getInfo();
  }

  /**
   * Validação do elemento (se necessário).
   */
  public static function validateDepartamentos(&$element, FormStateInterface $form_state, &$complete_form): void {
    // Adicione validações customizadas aqui, se preciso.
  }

}
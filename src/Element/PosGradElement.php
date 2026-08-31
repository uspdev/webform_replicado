<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;
use Uspdev\Replicado\Posgraduacao;

/**
 * Provides a custom PosGrad select element.
 *
 * @FormElement("pos_grad")
 */
class PosGradElement extends Select {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    $class = get_class($this);
    
    /*** 1. Conexão com o banco de dados ***/
    $config = \Drupal::service('config.factory')->getEditable('webform_replicado.settings');
    $database_name = $config->get('database_name');
    $database_port = $config->get('database_port');
    $database_host = $config->get('database_host');
    $database_user = $config->get('database_user');
    $database_password = $config->get('database_password');
    $database_fake = $config->get('replicado_fake');
    
    // Se não for informado na configuração, define o padrão 8
    $database_codunidade = $config->get('cod_unidade') ?: 8;

    /* TODO: Verificar se conexação ok */
    putenv("REPLICADO_HOST={$database_host}");
    putenv("REPLICADO_PORT={$database_port}");
    putenv("REPLICADO_DATABASE={$database_name}");
    putenv("REPLICADO_USERNAME={$database_user}");
    putenv("REPLICADO_PASSWORD={$database_password}");

    // Define se deve utilizar o modo FAKE
    if ($database_fake) {
      putenv("REPLICADO_FAKE=1");
    } else {
      putenv("REPLICADO_FAKE=0");
    }

    $areas = Posgraduacao::programas(8);

    $options = array_column($areas, 'nomare', 'codare');
    asort($options);

    return [
      '#input' => TRUE,
      '#empty_option' => $this->t('- Selecione um Programa -'),
      '#options' => $options,
      '#element_validate' => [
        [$class, 'validatePosGrad'],
      ],
    ] + parent::getInfo();
  }

  /**
   * Validação do elemento (se necessário).
   */
  public static function validatePosGrad(&$element, FormStateInterface $form_state, &$complete_form): void {
    // Adicione validações customizadas aqui, se preciso.
  }

}
<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Textfield;
use Uspdev\Replicado\Pessoa;
/**
 * Provides a USP number element.
 *
 * @FormElement("numero_docente")
 */
class NumDocenteElement extends Textfield {

  public function getInfo(): array {
    $class = get_class($this);

    return parent::getInfo() + [
      '#input' => TRUE,
      '#element_validate' => [
        [$class, 'validateNumDocente'],
      ],
    ];
  }

  /**
   * Validates the USP number.
   */
  public static function validateNumDocente(&$element, FormStateInterface $form_state,&$complete_form): void {

    $value = trim($element['#value']);

        /*** 1. Conexão com o banco de dados ***/
    $config = \Drupal::service('config.factory')->getEditable('webform_replicado.settings');
    $database_name = $config->get('database_name');
    $database_port = $config->get('database_port');
    $database_host = $config->get('database_host');
    $database_user = $config->get('database_user');
    $database_password = $config->get('database_password');

    /* TODO: Verificar se conexação ok */
    putenv("REPLICADO_HOST={$database_host}");
    putenv("REPLICADO_PORT={$database_port}");
    putenv("REPLICADO_DATABASE={$database_name}");
    putenv("REPLICADO_USERNAME={$database_user}");
    putenv("REPLICADO_PASSWORD={$database_password}");

    /*Opção fake */
    if($config->get('replicado_fake') == 1) {
      putenv('REPLICADO_FAKE=1');
    } else {
      putenv('REPLICADO_FAKE=0');
    }
  
    /*Opção código de unidade */
    if($config->get('cod_unidade') == 1) {
      putenv('REPLICADO_CODUNDCLG=8');
    } else {
      putenv('REPLICADO_CODUNDCLGS=8,84');
    }

    // Replicado e verificar se é um número USP válido
    if (!Pessoa::dump($value)) {
      $form_state->setError(
        $element,
        t('Esse número USP não é de um(a) docente ativo(a).')
      );
    }
  }



} 
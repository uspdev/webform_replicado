<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Textfield;
use Uspdev\Replicado\Graduacao;
/**
 * Provides a USP number element.
 *
 * @FormElement("numero_graduacao")
 */
class NumGraduacaoElement extends Textfield {

  public function getInfo(): array {
    $class = get_class($this);

    return parent::getInfo() + [
      '#input' => TRUE,
      '#element_validate' => [
        [$class, 'validateNumGraduacao'],
      ],
    ];
  }

  /**
   * Validates the USP number.
   */
  public static function validateNumGraduacao(&$element, FormStateInterface $form_state,&$complete_form): void {

    $value = trim($element['#value']);

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
    putenv("REPLICADO_CODUNDCLG={$database_codunidade}");

    //Opção fake
    if($config->get('replicado_fake') == 1) {
      putenv('REPLICADO_FAKE=1');
    } else {
      putenv('REPLICADO_FAKE=0');
    }



    // Retorna os dados do curso ativo se o aluno for de Graduação da unidade
    $aluno = Graduacao::obterCursoAtivo($value, $codundclgi);

    if (empty($aluno)) {
      $form_state->setError(
        $element,
        t('Esse número USP não pertence a um(a) aluno(a) de graduação ativo(a) nesta unidade.')
      );
    }
  }
} 
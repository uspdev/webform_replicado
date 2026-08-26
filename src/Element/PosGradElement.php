<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;
use Uspdev\Replicado\Posgraduacao;


/**
 * Provides a post element.
 *
 * @FormElement("pos_grad")
 */

class PosGradElement extends Select {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    return parent::getInfo() + [
      '#input' => TRUE,
      '#empty_option' => t('- Selecione um departamento -'),
      '#options' => [
      'antros' => 'Antropologia Social',
      'cipo' => 'Ciência Política',
      'ec' => 'Estudos Comparados de Literaturas de Língua Portuguesa',
      'ing' => 'Estudos Linguísticos e Literários em Inglês',
      'fill' => 'Filologia e Língua Portuguesa',
      'filo' => 'Filosofia',
      'geofisica' => 'Geografia Física',
      'geohuma' => 'Geografia Humana',
      'histecono' => 'História Econômica',
      'histsoci' => 'História Social',
      'humanidades' => 'Humanidades, Direitos e Outras Legitimidades',
      'lc' => 'Letras Clássicas',
      'tradu' => 'Letras Estrangeiras e Tradução',
      'letras' => 'Letras',
      'alemao' => 'Língua e Literatura Alemã',
      'espanhol' => 'Língua Espanhola e Literaturas Espanhola e Hispano-Americana',
      'italiano' => 'Língua, Literatura e Cultura Italianas',
      'japones' => 'Língua, Literatura e Cultura Japonesas',
      'linguistica' => 'Linguística',
      'litbra' => 'Literatura Brasileira',
      'litport' => 'Literatura Portuguesa',
      'profletrasmes' => 'Mestrado Profissional em Letras em Rede Nacional (PROFLETRAS)',
      'profletras' => 'PROFLETRAS',
      'socio' => 'Sociologia',
      'teolit' => 'Teoria Literária e Literatura Comparada',
      ],
    ];
    $config = \Drupal::config('webform_replicado.settings');
  }
  
  /**
   * Validates the USP number.
   */
  public static function validatePosGrad(&$element, FormStateInterface $form_state,&$complete_form): void {

    $value = trim($element['#value']);

        /*** 1. Conexão com o banco de dados ***/
    $config = \Drupal::service('config.factory')->getEditable('webform_replicado.settings');
    $database_name = $config->get('database_name');
    $database_port = $config->get('database_port');
    $database_host = $config->get('database_host');
    $database_user = $config->get('database_user');
    $database_password = $config->get('database_password');
    $database_fake = $config->get('replicado_fake');
    $database_codunidade = $config->get('cod_unidade');

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
    $value = $element['#value'];
    if (empty($value) || !Posgraduacao::programas($value)) {
      $form_state->setError(
        $element,
        t('A opção selecionada não é válida.')
      );
    }
  }
}

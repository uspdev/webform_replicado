<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Textfield;
use Uspdev\Replicado\Replicado;
/**
 * Provides a USP number element.
 *
 * @FormElement("numero_usp")
 */
class NumeroUspElement extends Textfield {

  public function getInfo(): array {
    $class = get_class($this);

    return parent::getInfo() + [
      '#input' => TRUE,
      '#element_validate' => [
        [$class, 'validateNumeroUsp'],
      ],
    ];
  }

  /**
   * Validates the USP number.
   */
  public static function validateNumeroUsp(&$element, FormStateInterface $form_state,&$complete_form): void {

    $value = str_replace(['.', '-'], '', $element['#value']);

    $tipo = $form_state->getValue('tipo_de_vinculo');

    switch ($tipo) {

      case 'intercambista':
      case 'funcionario':
        if (strlen($value) != 7) {
          $form_state->setError(
            $element,
            t('O Número USP deve possuir 7 dígitos.')
          );
        }
        break; 

      case 'docente':
      case 'graduacao':
      case 'pos':
      default:
        if (strlen($value) != 8) {
          $form_state->setError(
            $element,
            t('O Número USP deve possuir 8 dígitos.')
          );
        }
        break;
    }
  $config = \Drupal::config('webform_replicado.settings');

$config_replicado = [
  'host' => 'cloud.fflch.usp.br',
  'port' => '5005',
  'database' => 'fflch',
  'username' => 'fflchdev',
  'codundclg' => '8',
  'codundclgs' => '8,84',
  'pathlog' => '/tmp/replicado.log',
  'sybase' => true,
  'usarCache' => false,
  'debug' => false,
  'debugLevel' => 1,
];

Replicado::setConfig($config_replicado); 
  }
} 
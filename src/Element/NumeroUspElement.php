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
  'host' => $config->get('host'),
  'port' => $config->get('port'),
  'database' => $config->get('database'),
  'username' => $config->get('username'),
  'codundclg' => $config->get('codundclg'),
  'codundclgs' => $config->get('codundclgs'),
  'pathlog' => 'path/to/your.log',
  'sybase' => TRUE,
  'usarCache' => FALSE,
  'debug' => FALSE,
  'debugLevel' => 1,
];

Replicado::setConfig($config_replicado); 
  }
} 
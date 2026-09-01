<?php

namespace Drupal\webform_replicado\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\Select;

/**
 * Provides a 'habilitacao_letras' Webform element.
 *
 * @WebformElement(
 *   id = "habilitacao_letras",
 *   label = @Translation("Habilitação da Letras"),
 *   category = @Translation("USP")
 * )
 */
class HabilitacaoElement extends Select {

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties() {
    $properties = parent::getDefaultProperties();
    // Remove a propriedade de editar opções pela interface do Webform, já que elas são fixas no PHP
    unset($properties['options']);
    return $properties;
  }

}

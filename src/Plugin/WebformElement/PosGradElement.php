<?php

namespace Drupal\webform_replicado\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\Select;

/**
 * Provides a 'pos_grad' webform element.
 *
 * @WebformElement(
 *   id = "pos_grad",
 *   label = @Translation("Pós-Graduação"),
 *   description = @Translation("Exibe um select com os departamentos de pós-graduação."),
 *   category = @Translation("USP"),
 * )
 */
class PosGradElement extends Select {

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
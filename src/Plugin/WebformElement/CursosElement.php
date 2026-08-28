<?php

namespace Drupal\webform_replicado\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\Select;

/**
 * Provides a 'cursos' webform element.
 *
 * @WebformElement(
 *   id = "cursos",
 *   label = @Translation("Cursos"),
 *   description = @Translation("Exibe um select com os cursos da FFLCH."),
 *   category = @Translation("USP"),
 * )
 */
class CursosElement extends Select {

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

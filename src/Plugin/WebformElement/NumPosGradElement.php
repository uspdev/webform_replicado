<?php

namespace Drupal\webform_replicado\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * Provides a 'numero_posgrad' Webform element.
 *
 * @WebformElement(
 *   id = "numero_posgrad",
 *   label = @Translation("Número de Pós-Graduação"),
 *   category = @Translation("USP")
 * )
 */
class NumPosGradElement extends TextField {
}
<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;
use Drupal\Core\Form\FormState;
use Uspdev\Replicado\Replicado;

/**
 * Provides a language element.
 *
 * @FormElement("habilitacao_letras")
 */
class HabilitacaoElement extends Select {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    $info = parent::getInfo();

    $info['#element_validate'][] = [static::class, 'validateHabilitacao'];

    return $info;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineDefaultProperties() {
    $properties = parent::defineDefaultProperties();

    $properties['options'] = [
      'portugues' => 'Português',
      'grego' => 'Grego',
      'latim' => 'Latim',
      'alemao' => 'Alemão',
      'espanhol' => 'Espanhol',
      'frances' => 'Francês',
      'ingles' => 'Inglês',
      'italiano' => 'Italiano',
      'arabe' => 'Árabe',
      'armenio' => 'Armênio',
      'chines' => 'Chinês',
      'coreano' => 'Coreano',
      'hebraico' => 'Hebraico',
      'japones' => 'Japonês',
      'russo' => 'Russo',
      'linguistica' => 'Linguística',
    ];

    return $properties;
  }
}
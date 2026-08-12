<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;
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
    return parent::getInfo() + [
      '#input' => TRUE,
      '#empty_option' => t('- Selecione uma Habilitação -'),
      '#options' => [
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
      ],
    ];
  }
}
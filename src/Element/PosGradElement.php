<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;


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
  }
}
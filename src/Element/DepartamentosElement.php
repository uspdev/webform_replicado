<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Render\Element\Select;

/**
 * Provides a department element.
 *
 * @FormElement("departamentos_fflch")
 */
class DepartamentosElement extends Select {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    return parent::getInfo() + [
      '#input' => TRUE,
      '#empty_option' => t('- Selecione um departamento -'),
      '#options' => [
        'fla' => 'Departamento de Antropologia (FLA)',
        'flp' => 'Departamento de Ciência Política (FLP)',
        'flf' => 'Departamento de Filosofia (FLF)',
        'flg' => 'Departamento de Geografia (FLG)',
        'flh' => 'Departamento de História (FLH)',
        'flc' => 'Departamento de Letras Clássicas e Vernáculas (FLC)',
        'flm' => 'Departamento de Letras Modernas (FLM)',
        'flo' => 'Departamento de Letras Orientais (FLO)',
        'fll' => 'Departamento de Linguística (FLL)',
        'fsl' => 'Departamento de Sociologia (FSL)',
        'flt' => 'Departamento de Teoria Literária e Literatura Comparada (FLT)',
      ],
    ];
  }

}
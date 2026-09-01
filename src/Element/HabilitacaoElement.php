<?php

namespace Drupal\webform_replicado\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Select;
use Uspdev\Replicado\DB;

/**
 * Provides a custom Graduacao Habilitacoes select element.
 *
 * @FormElement("habilitacao_letras")
 */
class HabilitacaoElement extends Select {

  public function getInfo(): array {
    $class = get_class($this);

    $options = [];

    try {
      /*** 1. Conexão com o banco de dados ***/
      $config = \Drupal::service('config.factory')->getEditable('webform_replicado.settings');
      $database_name = $config->get('database_name');
      $database_port = $config->get('database_port');
      $database_host = $config->get('database_host');
      $database_user = $config->get('database_user');
      $database_password = $config->get('database_password');
      $database_codunidade = $config->get('cod_unidade') ?: 8;

      /* Conexão com Replicado */
      putenv("REPLICADO_HOST={$database_host}");
      putenv("REPLICADO_PORT={$database_port}");
      putenv("REPLICADO_DATABASE={$database_name}");
      putenv("REPLICADO_USERNAME={$database_user}");
      putenv("REPLICADO_PASSWORD={$database_password}");
      putenv("REPLICADO_CODUNDCLG={$database_codunidade}");

      if ($config->get('replicado_fake') == 1) {
        putenv('REPLICADO_FAKE=1');
      } else {
        putenv('REPLICADO_FAKE=0');
      }

      /*** 2. Listagem de Habilitações ***/
      $query = "SELECT DISTINCT H.codhab, H.nomhab
                FROM CURSOGR C
                INNER JOIN HABILITACAOGR H ON (C.codcur = H.codcur)
                WHERE C.codclg = CONVERT(int, :codundclg)
                  AND (C.dtadtvcur IS NULL)
                  AND (H.dtadtvhab IS NULL)
                ORDER BY H.nomhab ASC";

      $params = ['codundclg' => $database_codunidade];
      $result = DB::fetchAll($query, $params);

      if (!empty($result) && is_array($result)) {
        foreach ($result as $row) {
          if (!empty($row['codhab']) && !empty($row['nomhab'])) {
            $options[$row['codhab']] = trim($row['nomhab']);
          }
        }
        asort($options);
      }
    }
    catch (\Throwable $e) {
      \Drupal::logger('webform_replicado')->error('Erro ao buscar habilitações no Replicado: @error', [
        '@error' => $e->getMessage(),
      ]);
    }

    // Retorna a estrutura nativa mantendo #options obrigatoriamente como array
    return [
      '#input' => TRUE,
      '#empty_option' => $this->t('- Selecione uma habilitação -'),
      '#options' => (array) $options,
      '#element_validate' => [
        [$class, 'validateHabilitacao'],
      ],
    ] + parent::getInfo();
  }

  /**
   * Validates the Habilitacao.
   */
  public static function validateHabilitacao(&$element, FormStateInterface $form_state, &$complete_form): void {
    // Validação gerenciada pelas #options do Drupal.
  }

}
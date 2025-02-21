<?php

use Drupal\webform\Entity\Webform;
use Drupal\webform\Entity\WebformSubmission;
use Drupal\user\Entity\User;
use Drupal\Core\Entity\Query\QueryFactory;

/* Criado por Anna Valim - 2024
*
* Passo-a-passo:
* 1. Criar um webform com o nome de máquina: indicadores_abcd_2018
* 2. Na aba build do webform criado, copiar o conteúdo do arquivo: 
*    drupal/indicadores-abcd/import-to-webform/import-codigo-fonte.yaml
* 
* 3. Para rodar e importar os resultados de 2018, insira o código abaixo, atentando para o seu pwd atual:
*    ./vendor/bin/drush php-script ~/projetos/scripts/drupal/indicadores-abcd/import-to-webform/import-2018.php
* 
*/

$csvArchive = fopen('../../scripts/drupal/indicadores-abcd/data/2018.csv', "r");

if ($csvArchive !== FALSE) {

    $anoDeSubmissao = fgetcsv($csvArchive, 1000, ",");
    fgetcsv($csvArchive, 1000, ",");
    fgetcsv($csvArchive, 1000, ",");

    while (($data = fgetcsv($csvArchive, 1000, ",")) !== FALSE) {

        list(
            $usuario,
            $unidade,
            $numero_de_assentos,
            $total_ano_anterior,
            $ampliacao_no_periodo,
            $reducao_no_periodo,
            $funcionarios_superior,
            $funcionarios_superior_especializacao,
            $funcionarios_superior_mestrado,
            $funcionarios_superior_doutorado,
            $funcionarios_tecnico,
            $funcionarios_basico,
            $funcionarios_superior_vagas_nao_preenchidas,
            $funcionarios_tecnico_vagas_nao_preenchidas,
            $funcionarios_basico_vagas_nao_preenchidas,
            $superior_eventos,
            $tecnico_eventos,
            $basico_eventos,
            $superior_especializacao,
            $tecnico_especializacao,
            $basico_especializacao,
            $superior_mestrado,
            $tecnico_mestrado,
            $basico_mestrado,
            $superior_doutorado,
            $tecnico_doutorado,
            $basico_doutorado,
            $superior_gerencial,
            $tecnico_gerencial,
            $basico_gerencial,
            $superior_capacitacao_servicos,
            $tecnico_capacitacao_servicos,
            $basico_capacitacao_servicos,
            $superior_tic,
            $tecnico_tic,
            $basico_tic,              
            $livros_nacional_compra,
            $livros_internacional_compra,
            $livros_nacional_permuta,
            $livros_internacional_permuta,
            $livros_nacional_doacao,
            $livros_internacional_doacao,
            $teses_nacional_compra,
            $teses_internacional_compra,
            $teses_nacional_permuta,
            $teses_internacional_permuta,
            $teses_nacional_doacao,
            $teses_internacional_doacao,
            $periodicos_nacional_compra,
            $periodicos_internacional_compra,
            $periodicos_nacional_permuta,
            $periodicos_internacional_permuta,
            $periodicos_nacional_doacao,
            $periodicos_internacional_doacao,
            $multimeios_nacional_compra,
            $multimeios_internacional_compra,
            $multimeios_nacional_permuta,
            $multimeios_internacional_permuta,
            $multimeios_nacional_doacao,
            $multimeios_internacional_doacao,
            $outros_nacional_compra,
            $outros_internacional_compra,
            $outros_nacional_permuta,
            $outros_internacional_permuta,
            $outros_nacional_doacao,
            $outros_internacional_doacao,
            $baixas_efetuadas_livros,
            $materiais_nao_cadastrados_livros,
            $baixas_efetuadas_teses,
            $materiais_nao_cadastrados_teses,
            $cadastrados_atualmente_periodicos,
            $cadastrados_no_ano,
            $baixas_efetuadas_periodicos,
            $materiais_nao_cadastrados_periodicos,
            $baixas_efetuadas_multimeios,
            $materiais_nao_cadastrados_multimeios,
            $baixas_efetuadas_outros,
            $materiais_nao_cadastrados_outros,
            $usp,
            $externos_usp,
            $consultas_acervo,
            $emprestimos_seg_versao,
            $pedidos_atendidos_nacional_sibiusp,
            $pedidos_nao_atendidos_nacional_sibiusp,
            $copias_nacional_sibiusp,
            $pedidos_atendidos_nacional_comut,
            $pedidos_nao_atendidos_nacional_comut,
            $copias_nacional_comut,
            $pedidos_atendidos_nacional_bireme,
            $pedidos_nao_atendidos_nacional_bireme,
            $copias_nacional_bireme,
            $pedidos_atendidos_nacional_outros,
            $pedidos_nao_atendidos_nacional_outros,
            $copias_nacional_outros,
            $pedidos_atendidos_internacional,
            $pedidos_nao_atendidos_internacional,
            $copias_internacional,
            $solicitante_atendidos_nacional_sibiusp,
            $solicitante_nao_atendidos_nacional_sibiusp,
            $solicitante_atendidos_nacional_comut,
            $solicitante_nao_atendidos_nacional_comut,
            $solicitante_atendidos_nacional_bireme,
            $solicitante_nao_atendidos_nacional_bireme,
            $solicitante_atendidos_nacional_outros,
            $solicitante_nao_atendidos_nacional_outros,
            $solicitante_atendidos_internacional,
            $solicitante_nao_atendidos_internacional,
            $assistencias_efetuadas,
            $documento_inteiro,
            $referencias_bibliograficas,
            $equipamentos_usuarios_microcomputador,
            $equipamentos_funcionarios_microcomputador,
            $equipamentos_usuarios_impressora,
            $equipamentos_funcionarios_impressora,
            $equipamentos_usuarios_scanner,
            $equipamentos_funcionarios_scanner,
            $equipamentos_usuarios_outros,
            $equipamentos_funcionarios_outros,
            $bases_de_dados_locais,
            $publicacoes_biblioteca,
            $publicacoes_oficiais_participacao,
            $eventos,
            $projetos,
            $atividades_graduacao,
            $atividades_cultura_extensao,
            $servicos_pela_internet,
            $rede_sem_fio,
            $possui_redes_sociais,
            $rede_facebook,
            $rede_twitter,
            $rede_blog,
            $rede_flickr,
            $rede_pinterest,
            $rede_youtube,
            $rede_outro,
            $condicoes_de_acessibilidade,
            $funcionario_treinado_em_libras,
            $banheiros_adaptados,
            $bebedouros_lavabos_adaptados,
            $dimensionamento_entradas,
            $equipamentos_eletronicos_adaptados,
            $espaco_atendimento_adaptado,
            $mobiliario_adaptado,
            $rampa_acesso_adaptada,
            $sinalizacao_tatil,
            $sinalizacao_visual,
            $sinalizacao_sonora,
            $desobstrucao_ambientes,
            $plano_aquisicao_bibliografica_adaptada,
            $acervo_adaptado,
            $websites_apps_adaptados,
            $impressoras_braille,
            $software_leitura_acessivel,
            $teclado_virtual,
        ) = array_slice($data, 8);

        $total_ano_anterior   = (float) $total_ano_anterior;
        $ampliacao_no_periodo = (float) $ampliacao_no_periodo;
        $reducao_no_periodo   = (float) $reducao_no_periodo;
        $area_fisica_agrupada = $total_ano_anterior + $ampliacao_no_periodo - $reducao_no_periodo;

        $webform_id = 'indicadores_abcd_2018';
        $webform = Webform::load($webform_id);

        if ($webform) {
            $values = [
                'webform_id' => $webform->id(),
                'data' => [
                    'ano_de_submissao' => $anoDeSubmissao[0],
                    'usuario' => $usuario,
                    'unidade' => $unidade,
                    'numero_de_assentos' => $numero_de_assentos,
                    'total_ano_anterior' => $total_ano_anterior,
                    'ampliacao_no_periodo' => $ampliacao_no_periodo,
                    'reducao_no_periodo' => $reducao_no_periodo,
                    'area_fisica_agrupada' => $area_fisica_agrupada,
                    'funcionarios_superior' => $funcionarios_superior,
                    'funcionarios_superior_especializacao' => $funcionarios_superior_especializacao,
                    'funcionarios_superior_mestrado' => $funcionarios_superior_mestrado,
                    'funcionarios_superior_doutorado' => $funcionarios_superior_doutorado,
                    'funcionarios_tecnico' => $funcionarios_tecnico,
                    'funcionarios_basico' => $funcionarios_basico,
                    'funcionarios_superior_vagas_nao_preenchidas' => $funcionarios_superior_vagas_nao_preenchidas,
                    'funcionarios_tecnico_vagas_nao_preenchidas' => $funcionarios_tecnico_vagas_nao_preenchidas,
                    'funcionarios_basico_vagas_nao_preenchidas' => $funcionarios_basico_vagas_nao_preenchidas,
                    'superior_eventos' => $superior_eventos,
                    'tecnico_eventos' => $tecnico_eventos,
                    'basico_eventos' => $basico_eventos,
                    'superior_especializacao' => $superior_especializacao,
                    'tecnico_especializacao' => $tecnico_especializacao,
                    'basico_especializacao' => $basico_especializacao,
                    'superior_mestrado' => $superior_mestrado,
                    'tecnico_mestrado' => $tecnico_mestrado,
                    'basico_mestrado' => $basico_mestrado,
                    'superior_doutorado' => $superior_doutorado,
                    'tecnico_doutorado' => $tecnico_doutorado,
                    'basico_doutorado' => $basico_doutorado,
                    'superior_gerencial' => $superior_gerencial,
                    'tecnico_gerencial' => $tecnico_gerencial,
                    'basico_gerencial' => $basico_gerencial,
                    'superior_capacitacao_servicos' => $superior_capacitacao_servicos,
                    'tecnico_capacitacao_servicos' => $tecnico_capacitacao_servicos,
                    'basico_capacitacao_servicos' => $basico_capacitacao_servicos,
                    'superior_tic' => $superior_tic,
                    'tecnico_tic' => $tecnico_tic,
                    'basico_tic' => $basico_tic,
                    'livros_nacional_compra' => $livros_nacional_compra,
                    'livros_internacional_compra' => $livros_internacional_compra,
                    'livros_nacional_permuta' => $livros_nacional_permuta,
                    'livros_internacional_permuta' => $livros_internacional_permuta,
                    'livros_nacional_doacao' => $livros_nacional_doacao,
                    'livros_internacional_doacao' => $livros_internacional_doacao,
                    'teses_nacional_compra' => $teses_nacional_compra,
                    'teses_internacional_compra' => $teses_internacional_compra,
                    'teses_nacional_permuta' => $teses_nacional_permuta,
                    'teses_internacional_permuta' => $teses_internacional_permuta,
                    'teses_nacional_doacao' => $teses_nacional_doacao,
                    'teses_internacional_doacao' => $teses_internacional_doacao,
                    'periodicos_nacional_compra' => $periodicos_nacional_compra,
                    'periodicos_internacional_compra' => $periodicos_internacional_compra,
                    'periodicos_nacional_permuta' => $periodicos_nacional_permuta,
                    'periodicos_internacional_permuta' => $periodicos_internacional_permuta,
                    'periodicos_nacional_doacao' => $periodicos_nacional_doacao,
                    'periodicos_internacional_doacao' => $periodicos_internacional_doacao,
                    'multimeios_nacional_compra' => $multimeios_nacional_compra,
                    'multimeios_internacional_compra' => $multimeios_internacional_compra,
                    'multimeios_nacional_permuta' => $multimeios_nacional_permuta,
                    'multimeios_internacional_permuta' => $multimeios_internacional_permuta,
                    'multimeios_nacional_doacao' => $multimeios_nacional_doacao,
                    'multimeios_internacional_doacao' => $multimeios_internacional_doacao,
                    'outros_nacional_compra' => $outros_nacional_compra,
                    'outros_internacional_compra' => $outros_internacional_compra,
                    'outros_nacional_permuta' => $outros_nacional_permuta,
                    'outros_internacional_permuta' => $outros_internacional_permuta,
                    'outros_nacional_doacao' => $outros_nacional_doacao,
                    'outros_internacional_doacao' => $outros_internacional_doacao,
                    'baixas_efetuadas_livros' => $baixas_efetuadas_livros,
                    'materiais_nao_cadastrados_livros' => $materiais_nao_cadastrados_livros,
                    'baixas_efetuadas_teses' => $baixas_efetuadas_teses,
                    'materiais_nao_cadastrados_teses' => $materiais_nao_cadastrados_teses,
                    'cadastrados_atualmente_periodicos' => $cadastrados_atualmente_periodicos,
                    'cadastrados_no_ano' => $cadastrados_no_ano,
                    'baixas_efetuadas_periodicos' => $baixas_efetuadas_periodicos,
                    'materiais_nao_cadastrados_periodicos' => $materiais_nao_cadastrados_periodicos,
                    'baixas_efetuadas_multimeios' => $baixas_efetuadas_multimeios,
                    'materiais_nao_cadastrados_multimeios' => $materiais_nao_cadastrados_multimeios,
                    'baixas_efetuadas_outros' => $baixas_efetuadas_outros,
                    'materiais_nao_cadastrados_outros' => $materiais_nao_cadastrados_outros,
                    'usp' => $usp,
                    'externos_usp' => $externos_usp,
                    'consultas_acervo' => $consultas_acervo,
                    'emprestimos_seg_versao' => $emprestimos_seg_versao,
                    'pedidos_atendidos_nacional_sibiusp' => $pedidos_atendidos_nacional_sibiusp,
                    'pedidos_nao_atendidos_nacional_sibiusp' => $pedidos_nao_atendidos_nacional_sibiusp,
                    'copias_nacional_sibiusp' => $copias_nacional_sibiusp,
                    'pedidos_atendidos_nacional_comut' => $pedidos_atendidos_nacional_comut,
                    'pedidos_nao_atendidos_nacional_comut' => $pedidos_nao_atendidos_nacional_comut,
                    'copias_nacional_comut' => $copias_nacional_comut,
                    'pedidos_atendidos_nacional_bireme' => $pedidos_atendidos_nacional_bireme,
                    'pedidos_nao_atendidos_nacional_bireme' => $pedidos_nao_atendidos_nacional_bireme,
                    'copias_nacional_bireme' => $copias_nacional_bireme,
                    'pedidos_atendidos_nacional_outros' => $pedidos_atendidos_nacional_outros,
                    'pedidos_nao_atendidos_nacional_outros' => $pedidos_nao_atendidos_nacional_outros,
                    'copias_nacional_outros' => $copias_nacional_outros,
                    'pedidos_atendidos_internacional' => $pedidos_atendidos_internacional,
                    'pedidos_nao_atendidos_internacional' => $pedidos_nao_atendidos_internacional,
                    'copias_internacional' => $copias_internacional,
                    'solicitante_atendidos_nacional_sibiusp' => $solicitante_atendidos_nacional_sibiusp,
                    'solicitante_nao_atendidos_nacional_sibiusp' => $solicitante_nao_atendidos_nacional_sibiusp,
                    'solicitante_atendidos_nacional_comut' => $solicitante_atendidos_nacional_comut,
                    'solicitante_nao_atendidos_nacional_comut' => $solicitante_nao_atendidos_nacional_comut,
                    'solicitante_atendidos_nacional_bireme' => $solicitante_atendidos_nacional_bireme,
                    'solicitante_nao_atendidos_nacional_bireme' => $solicitante_nao_atendidos_nacional_bireme,
                    'solicitante_atendidos_nacional_outros' => $solicitante_atendidos_nacional_outros,
                    'solicitante_nao_atendidos_nacional_outros' => $solicitante_nao_atendidos_nacional_outros,
                    'solicitante_atendidos_internacional' => $solicitante_atendidos_internacional,
                    'solicitante_nao_atendidos_internacional' => $solicitante_nao_atendidos_internacional,
                    'assistencias_efetuadas' => $assistencias_efetuadas,
                    'documento_inteiro' => $documento_inteiro,
                    'referencias_bibliograficas' => $referencias_bibliograficas,
                    'equipamentos_usuarios_microcomputador' => $equipamentos_usuarios_microcomputador,
                    'equipamentos_funcionarios_microcomputador' => $equipamentos_funcionarios_microcomputador,
                    'equipamentos_usuarios_impressora' => $equipamentos_usuarios_impressora,
                    'equipamentos_funcionarios_impressora' => $equipamentos_funcionarios_impressora,
                    'equipamentos_usuarios_scanner' => $equipamentos_usuarios_scanner,
                    'equipamentos_funcionarios_scanner' => $equipamentos_funcionarios_scanner,
                    'equipamentos_usuarios_outros' => $equipamentos_usuarios_outros,
                    'equipamentos_funcionarios_outros' => $equipamentos_funcionarios_outros,
                    'bases_de_dados_locais' => $bases_de_dados_locais,
                    'publicacoes_biblioteca' => $publicacoes_biblioteca,
                    'publicacoes_oficiais_participacao' => $publicacoes_oficiais_participacao,
                    'projetos' => $projetos,
                    'eventos' => $eventos,
                    'atividades_graduacao' => $atividades_graduacao,
                    'atividades_cultura_extensao' => $atividades_cultura_extensao,
                    'servicos_pela_internet' => $servicos_pela_internet,
                    'rede_sem_fio' => $rede_sem_fio,
                    'possui_redes_sociais' => $possui_redes_sociais,
                    'rede_facebook' => $rede_facebook,
                    'rede_twitter' => $rede_twitter,
                    'rede_blog' => $rede_blog,
                    'rede_flickr' => $rede_flickr,
                    'rede_pinterest' => $rede_pinterest,
                    'rede_youtube' => $rede_youtube,
                    'rede_outro' => $rede_outro,
                    'condicoes_de_acessibilidade' => $condicoes_de_acessibilidade,
                    'funcionario_treinado_em_libras' => $funcionario_treinado_em_libras,
                    'banheiros_adaptados' => $banheiros_adaptados,
                    'bebedouros_lavabos_adaptados' => $bebedouros_lavabos_adaptados,
                    'dimensionamento_entradas' => $dimensionamento_entradas,
                    'equipamentos_eletronicos_adaptados' => $equipamentos_eletronicos_adaptados,
                    'espaco_atendimento_adaptado' => $espaco_atendimento_adaptado,
                    'mobiliario_adaptado' => $mobiliario_adaptado,
                    'rampa_acesso_adaptada' => $rampa_acesso_adaptada,
                    'sinalizacao_tatil' => $sinalizacao_tatil,
                    'sinalizacao_visual' => $sinalizacao_visual,
                    'sinalizacao_sonora' => $sinalizacao_sonora,
                    'desobstrucao_ambientes' => $desobstrucao_ambientes,
                    'plano_aquisicao_bibliografica_adaptada' => $plano_aquisicao_bibliografica_adaptada,
                    'acervo_adaptado' => $acervo_adaptado,
                    'websites_apps_adaptados' => $websites_apps_adaptados,
                    'impressoras_braille' => $impressoras_braille,
                    'software_leitura_acessivel' => $software_leitura_acessivel,
                    'teclado_virtual' => $teclado_virtual,
                ],
            ];
            
            $webform_submission = WebformSubmission::create($values);

            // rotina para identificar o usuário que fez a submissão
            $uids = \Drupal::entityQuery('user')
                  ->condition('name', $usuario)
                  ->range(0, 1) // Limit to one result
                  ->accessCheck(FALSE) // Disable access checking
                  ->execute();
  
            $uid = reset($uids); // Get the first matching user ID
            $user = User::load($uid); // Load the user entity
  
            $webform_submission->setOwnerId($user->id());
  
            $webform_submission->save();
            
        } else {
            echo 'O webform não está disponível ou está com algum erro';
        }
    }
    fclose($csvArchive);
} else {
    echo "Arquivo não disponível ou com falha de carregamento";
}

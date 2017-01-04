<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;

/**
 * Gerenciamento dos Critérios usados para avaliação de uma Inscrição
 */
class Criterio extends \MapasCulturais\Controller {

    /**
     * Lista os critérios
     */
    function GET_listar() {
        $criteriosAtivos = App::i()->repo('\CulturaViva\Entities\Criterio')->findBy(['ativo' => true]);
        $this->json($criteriosAtivos);
    }

    /**
     * Salva os critérios de avaliação
     */
    function POST_salvar() {
        $this->requireAuthentication();
        $app = App::i();


        // Obtém os critérios salvos na base
        $salvos = $this->GET_lista();
        if ($salvos == null) {
            $salvos = [];
        }

        // Criterios da requisicao
        $novos = json_decode($app->request()->getBody());
        usort($novos, function ($a, $b) {
            return $a->ordem - $b->ordem;
        });
        for ($i = 0; $i < count($novos); $i++) {
            $novos[$i]->ordem = $i + 1;
        }

        // Os critérios que serão persistidos
        $aPersistir = [];

        // Os criterios que receberam alteração, devem ser inativados
        $aInativar = array_udiff($salvos, $novos, function ($salvo, $novo) {
            if (!isset($novo->id)) {
                return -1;
            }
            return ($salvo->id == $novo->id && $salvo->ordem == $novo->ordem && $salvo->descricao == $novo->descricao) ? 0 : -1;
        });

        // Os critérios que não receberam alteração, serao ignorados
        $aIgnorar = array_uintersect($novos, $salvos, function($novo, $salvo) {
            if (!isset($novo->id)) {
                return -1;
            }
            return ($novo->id == $salvo->id && $novo->ordem == $salvo->ordem && $novo->descricao == $salvo->descricao) ? 0 : -1;
        });

        // Registros que serão persistidos
        $aPersistir = array_udiff($novos, $aIgnorar, function ($novo, $ignorar) {
            if (!isset($novo->id)) {
                return -1;
            }
            return ($novo->id == $ignorar->id && $novo->ordem == $ignorar->ordem && $novo->descricao == $ignorar->descricao) ? 0 : -1;
        });

        $app->getEm()->transactional(function ($em) use ($aPersistir, $aInativar) {
            // Inativa todos os critérios atuais
            foreach ($aInativar as $criterio) {
                $criterio->setAtivo(false);
                $em->persist($criterio);
            }

            // Salva a nova lista de critérios
            foreach ($aPersistir as $cData) {
                $criterio = new \CulturaViva\Entities\Criterio();
                $criterio->ativo = true;
                $criterio->ordem = $cData->ordem;
                $criterio->descricao = $cData->descricao;
                $criterio->tsCriacao = new \DateTime(date('Y-m-d H:i:s'));
                $em->persist($criterio);
            }
        });

        $this->json($this->GET_lista());
    }

}

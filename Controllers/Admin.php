<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;

/**
 * Controle principal das funcionalidades administrativas do Cultura Viva
 */
class Admin extends \MapasCulturais\Controller {

    protected $buscaAnterior = null;

    /**
     * Tela inicial do App Administracao.
     */
    function GET_index() {
        $this->requireAuthentication();
        $this->render('index');
    }

    /**
     * Obtém as informações do usuário logado
     */
    function GET_user() {
        $app = App::i();
        $user = $app->user;
        //$project = $app->repo('Project')->find($app->config['redeCulturaViva.projectId']);

        $roles = [];
        if (!$user->is('guest')) {
            foreach ($user->roles as $role) {
                $roles[] = $role->name;
            }
        }

        $this->json([
            'id' => $user->id,
            'name' => $user->profile ? $user->profile->name : null,
            'roles' => $roles
        ]);
    }

    function GET_cadastro() {
        $this->requireAuthentication();
        $this->render('cadastro');
    }

}

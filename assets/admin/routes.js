'use strict';

angular
        .module('AppAdmin')
        .config(AppConfig);


AppConfig.$inject = ['$stateProvider', '$urlRouterProvider'];

/**
 * Configurações das rotas da aplicação
 *
 * @param {type} $stateProvider
 * @param {type} $urlRouterProvider
 * @returns {undefined}
 */
function AppConfig($stateProvider, $urlRouterProvider) {

    /*========================================================================================
     * Rotas
     * ACCESS_LEVEL: Ver assets\admin\modules\base\RBAC.js
     *----------------------------------------------------------------------------------------*/

    // Tela de relatórios é a inicial
    $urlRouterProvider.otherwise('/');

    $stateProvider
            /*----------------------------------------------------------------------------------------*/
            // Template base das páginas
            /*----------------------------------------------------------------------------------------*/
            .state('pagina', {
                abstract: true,
                templateUrl: urlTemplate('Pagina', 'base'),
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.AGENTES
                }
            })
            /*----------------------------------------------------------------------------------------*/
            // Relatórios, tela inicial
            /*----------------------------------------------------------------------------------------*/
            .state('pagina.relatorios', {
                url: '/',
                templateUrl: urlTemplate('RelatoriosInicio', 'relatorios')
            })
            /*----------------------------------------------------------------------------------------*/
            // Configurações
            /*----------------------------------------------------------------------------------------*/
            .state('pagina.configuracao', {
                url: '/configuracao',
                template: '<ui-view/>',
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.AGENTE_AREA
                }
            })
            // Configurações::Parametros
            .state('pagina.configuracao.parametros', {
                url: '/parametros',
                templateUrl: urlTemplate('Parametros', 'configuracao')
            })
            // Configurações::Certificadores
            .state('pagina.configuracao.certificador', {
                url: '/certificadores',
                template: '<ui-view/>'
            })
            .state('pagina.configuracao.certificador.lista', {
                url: '/',
                templateUrl: urlTemplate('CertificadorLista', 'configuracao')
            })
            .state('pagina.configuracao.certificador.formulario', {
                url: '/formulario/:id',
                templateUrl: urlTemplate('CertificadorFormulario', 'configuracao')
            })

            /*----------------------------------------------------------------------------------------*/
            // Logout -Redireciona o usuário para a inicial da aplicação
            /*----------------------------------------------------------------------------------------*/
            .state('logout', {
                url: '/logout',
                template: '<div>logout</div>',
                controller: function () {
                    window.location = '/auth/logout';
                },
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.PUBLIC
                }
            })
            ;
}

/**
 * Facilitador de criação de endereços para templates
 *
 * @param {type} page
 * @param {type} module
 * @returns {String}
 */
function urlTemplate(page, module) {
    return '/assets/modules/' + module + '/templates/' + page + '.html';
}


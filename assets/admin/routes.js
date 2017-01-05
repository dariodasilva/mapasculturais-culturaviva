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
            // Certificação
            /*----------------------------------------------------------------------------------------*/
            .state('pagina.certificacao', {
                url: '/certificacao',
                template: '<ui-view/>',
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.AGENTES
                }
            })
            .state('pagina.certificacao.lista', {
                url: '/',
                templateUrl: urlTemplate('AvaliacaoLista', 'certificacao')
            })
            .state('pagina.configuracao.formulario', {
                url: '/formulario/:id',
                templateUrl: urlTemplate('CertificadorFormulario', 'certificacao')
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
            // Configurações::Criterios
            .state('pagina.configuracao.criterios', {
                url: '/criterios',
                templateUrl: urlTemplate('Criterios', 'configuracao')
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


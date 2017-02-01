'use strict';

angular
        .module("AppAdmin")
        .config(AppConfigRoutas);


AppConfigRoutas.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider'];

function AppConfigRoutas($stateProvider, $urlRouterProvider, $locationProvider) {

    $locationProvider.html5Mode(false).hashPrefix('');

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
                templateUrl: urlTemplate('Pagina', 'AppAdmin'),
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.AGENTES
                }
            })
            /*----------------------------------------------------------------------------------------*/
            // Relatórios, tela inicial
            /*----------------------------------------------------------------------------------------*/
            .state('pagina.relatorios', {
                url: '/',
                templateUrl: urlTemplate('Inicio', 'Relatorios'),
                resolve: {
                    mdl: resolveModule('Relatorios')
                }
            })
            /*----------------------------------------------------------------------------------------*/
            // Certificação
            /*----------------------------------------------------------------------------------------*/
            .state('pagina.certificacao', {
                url: '/certificacao',
                template: '<ui-view/>',
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.AGENTES
                },
                resolve: {
                    mdl: resolveModule('Certificacao')
                }
            })
            .state('pagina.certificacao.lista', {
                url: '/',
                templateUrl: urlTemplate('AvaliacaoLista', 'Certificacao')
            })
            .state('pagina.certificacao.formulario', {
                url: '/formulario/:id',
                templateUrl: urlTemplate('AvaliacaoFormulario', 'Certificacao')
            })
            /*----------------------------------------------------------------------------------------*/
            // Configurações
            /*----------------------------------------------------------------------------------------*/
            .state('pagina.configuracao', {
                url: '/configuracao',
                template: '<ui-view/>',
                data: {
                    ACCESS_LEVEL: window.RBAC.ACCESS_LEVEL.AGENTE_AREA
                },
                resolve: {
                    mdl: resolveModule('Configuracao')
                }
            })
            // Configurações::Criterios
            .state('pagina.configuracao.criterios', {
                url: '/criterios',
                templateUrl: urlTemplate('Criterios', 'Configuracao')
            })
            // Configurações::Certificadores
            .state('pagina.configuracao.certificador', {
                url: '/certificadores',
                template: '<ui-view/>'
            })
            .state('pagina.configuracao.certificador.lista', {
                url: '/',
                templateUrl: urlTemplate('CertificadorLista', 'Configuracao')
            })
            .state('pagina.configuracao.certificador.formulario', {
                url: '/formulario/:id',
                templateUrl: urlTemplate('CertificadorFormulario', 'Configuracao')
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



/**
 * Faz a resolução para o módulo solicitado
 * 
 * @param {type} module
 * @returns {Array}
 */
function resolveModule(module) {
    return [
        '$q', '$ocLazyLoad',
        function ($q, $ocLazyLoad) {
            if (window.__BUNDLED__MODULES__) {
                return $ocLazyLoad.load({
                    name: module,
                    files: ['modules/' + module + '/' + module + '.bundle.min.js']
                });
            } else {
                var deferred = $q.defer();
                setTimeout(function () {
                    $ocLazyLoad.load({
                        name: module
                    });
                    deferred.resolve(true);
                });
                return deferred.promise;
            }
        }
    ];
}



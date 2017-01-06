/* global google */

angular
        .module('AppAdmin.controllers')
        .controller('AvaliacaoListaCtrl', AvaliacaoListaCtrl);

AvaliacaoListaCtrl.$inject = ['$scope', '$state', '$http'];

/**
 * Listagem de Inscrições disponíveis para Avaliação
 *
 * @param {type} $scope
 * @param {type} $state
 * @param {type} $http
 * @returns {undefined}
 */
function AvaliacaoListaCtrl($scope, $state, $http) {

    // Configuração da página
    $scope.page.title = 'Avaliações';
    $scope.page.subTitle = 'Listagem de Avaliações para Certificação de Inscrições';
    $scope.page.titleClass = '';
    $scope.page.breadcrumb = [
        {
            title: 'Início',
            sref: 'pagina.relatorios'
        }
    ];

    $scope.certificadores = null;
    $scope.form = {};
    $scope.certificadores = {};

    // Obtém totais de avaliações
    $http.get('/avaliacao/total').success(function (data) {
        $scope.total = data;
    });
}


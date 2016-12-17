/* global google */

angular
        .module('AppAdmin.controllers')
        .controller('ParametrosCtrl', ParametrosCtrl);

ParametrosCtrl.$inject = ['$scope', '$state', '$http'];

/**
 * Listagem de estabelecimentos
 *
 * @param {type} $scope
 * @param {type} $state
 * @param {type} $http
 * @returns {undefined}
 */
function ParametrosCtrl($scope, $state, $http) {

    // Configuração da página
    $scope.page.title = 'Parâmetros';
    $scope.page.subTitle = 'Parâmetros de configuração para certificação';
    $scope.page.breadcrumb = [
        {
            title: 'Início',
            sref: 'pagina.relatorios'
        },
        {
            title: 'Configurações'
        }
    ];

    $scope.dto = {};
    $scope.formFirst = {};

    $http.get('/configuracao/get')
            .success(function (data) {
                $scope.dto = data;
                $scope.formFirst = angular.copy(data);
            });

    $scope.salvar = function () {
        $http.post('/configuracao/save', $scope.dto).success(function (data) {
            $scope.$emit('msg', 'Configurações salvas com sucesso', null, 'success', 'form');
            $scope.dto = data;
            $scope.formFirst = angular.copy($scope.dto);
        }).error(function (error) {
            $scope.$emit('msg', 'Erro inesperado ao salvar as Configurações', null, 'error', 'formulario');
            if (window.console && console.warn) {
                console.warn(error);
            }
        });
    };

    $scope.limpar = function () {
        $scope.dto = angular.copy($scope.formFirst);
    };
}


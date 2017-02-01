/* global google, angular */

angular
        .module('Configuracao')
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
    $scope.page.title = 'Critérios';
    $scope.page.subTitle = 'Critérios usados para avaliação de uma Inscrição';
    $scope.page.titleClass = '';
    $scope.page.breadcrumb = [
        {
            title: 'Início',
            sref: 'pagina.relatorios'
        },
        {
            title: 'Configurações'
        }
    ];


    $scope.criterios = [];
    $scope.listaVazia = null;
    $scope.botoes = [
        // Botões adicionais para o formulário
        {
            title: 'Adicionar Critério',
            click: function () {
                $scope.criterios.push({
                    ordem: $scope.criterios.length + 100,
                    descricao: ''
                });
            }
        }
    ];


    // Obtém a lista de critérios existente
    $http.get('/criterio/listar').success(function (data) {
        $scope.criterios = data;
        if ($scope.criterios === null || $scope.criterios.length < 1) {
            // Não possui criterio cadastrados ainda
            $scope.criterios = [
                {
                    ordem: 1,
                    descricao: ''
                }
            ];
        }
        $scope.listaVazia = angular.copy($scope.criterios);
    });

    /**
     * Persiste os critérios de avaliação
     *
     * @return {undefined}
     */
    $scope.salvar = function () {
        $http.post('/criterio/salvar', $scope.criterios).success(function (data) {
            $scope.$emit('msg', 'Critérios de Avaliação salvos com sucesso', null, 'success', 'formCriterios');
            //$scope.criterios = data;
            //$scope.listaVazia = angular.copy($scope.criterios);
        }).error(function (error) {
            $scope.$emit('msg', 'Erro inesperado ao salvar as Configurações', null, 'error', 'formCriterios');
            if (window.console && console.warn) {
                console.warn(error);
            }
        });
    };

    $scope.limpar = function () {
        $scope.criterios = angular.copy($scope.listaVazia);
    };

    /**
     * Remove o critério informado
     *
     * @param {type} criterio
     * @return {undefined}
     */
    $scope.removerCriterio = function (criterio) {
        if ($scope.criterios.length < 2) {
            // Deve existir ao menos um critério
            return;
        }
        var idx = $scope.criterios.indexOf(criterio);
        if (idx >= 0) {
            $scope.criterios.splice(idx, 1);
        }
    };


}


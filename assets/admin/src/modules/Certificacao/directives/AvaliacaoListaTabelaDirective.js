'use strict';

angular
        .module('Certificacao')
        .directive('avaliacaoListaTabela', AvaliacaoListaTabelaDirective);


function AvaliacaoListaTabelaDirective() {
    /**
     * @directive AppAdmin.directives.certificadorListaTabela
     *
     * @description Componente reutilizável para exibir a tabela com os certificadores cadastrados
     */
    return {
        restrict: 'E',
        templateUrl: '/assets/modules/certificacao/templates/AvaliacaoListaTabela.html',
        scope: {
            /**
             * @description Estado da avaliação, usado no filtro de pesquisa
             */
            estado: '@',
            /**
             * @description Descrição para o tipo de avaliação
             */
            descricao: '@'
        },
        controller: Controller
    };

    Controller.$inject = ['$scope', '$http'];
    function Controller($scope, $http) {
        $scope.ref = {
            filtrarTexto: null,
            texto: null,
            pagina: 1,
            data: null
        };

        $scope.filtrar = function () {
            $scope.pagina = 1;
        };

        $scope.filtrarAvaliacoes = function () {
            $http.get('/avaliacao/listar', {
                params: {
                    pagina: $scope.ref.pagina,
                    nome: $scope.ref.texto,
                    estado: $scope.estado
                }
            }).success(function (result) {
                $scope.ref.data = result;
            });
        };

        $scope.$watch('ref.pagina', $scope.filtrarAvaliacoes);
    }
}
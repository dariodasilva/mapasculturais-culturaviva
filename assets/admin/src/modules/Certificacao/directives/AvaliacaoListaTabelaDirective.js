'use strict';

angular
        .module('Certificacao')
        .directive('avaliacaoListaTabela', AvaliacaoListaTabelaDirective);


AvaliacaoListaTabelaDirective.$inject = ['estadosBrasil'];

function AvaliacaoListaTabelaDirective(estadosBrasil) {

    Controller.$inject = ['$scope', '$http'];
    function Controller($scope, $http) {
        $scope.ref = {
            filtrarTexto: null,
            filtrarUf: null,
            filtrarMunicipio: null,
            texto: null,
            pagina: 1,
            data: null
        };

        $scope.estadosBrasil = (function () {
            var out = [];
            for (var uf in estadosBrasil) {
                if (estadosBrasil.hasOwnProperty(uf)) {
                    out.push({valor: uf, label: uf + ' - ' + estadosBrasil[uf]});
                }
            }
            return out;
        })();

        $scope.filtrar = function () {
            $scope.pagina = 1;
            $scope.filtrarAvaliacoes();
        };

        $scope.filtrarAvaliacoes = function () {
            $http.get('/avaliacao/listar', {
                params: {
                    pagina: $scope.ref.pagina,
                    nome: $scope.ref.filtrarTexto,
                    uf: $scope.ref.filtrarUf ? $scope.ref.filtrarUf.valor : undefined,
                    municipio: $scope.ref.filtrarMunicipio,
                    estado: $scope.estado
                }
            }).then(function (response) {
                $scope.ref.data = response.data;
            });
        };

        $scope.$watch('ref.pagina', $scope.filtrarAvaliacoes);
    }

    /**
     * @directive AppAdmin.directives.certificadorListaTabela
     *
     * @description Componente reutilizável para exibir a tabela com os certificadores cadastrados
     */
    return {
        restrict: 'E',
        templateUrl: 'modules/Certificacao/templates/AvaliacaoListaTabela.html',
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
}
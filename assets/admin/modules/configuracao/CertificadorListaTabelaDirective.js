'use strict';

angular
        .module('AppAdmin.directives')
        .directive('certificadorListaTabela', CertificadorListaTabelaDirective);


function CertificadorListaTabelaDirective() {
    /**
     * @directive AppAdmin.directives.certificadorListaTabela
     *
     * @description Componente reutilizável para exibir a tabela com os certificadores cadastrados
     */
    return {
        restrict: 'E',
        templateUrl: '/assets/modules/configuracao/templates/CertificadorListaTabela.html',
        scope: {
            /**
             * @description Lista de certificadores desta tabela
             */
            certificadores: '=',
            /**
             * @description Descrição do tipo de certificadores sendo listado
             */
            descricao: '@',
            /**
             * @description Identificador do tipo de certificadores sendo listado
             */
            tipo: '@',
            /**
             * @description Informa o grupo do certificador sendo listado (Titular ou Suplente)
             */
            grupo: '@'
        }
    };
}
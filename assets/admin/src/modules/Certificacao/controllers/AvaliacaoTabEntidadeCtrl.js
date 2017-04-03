/* global google */

angular
        .module('Certificacao')
        .controller('AvaliacaoTabEntidadeCtrl', AvaliacaoTabEntidadeCtrl);

AvaliacaoTabEntidadeCtrl.$inject = ['$scope', 'Entity', 'estadosBrasil'];

function AvaliacaoTabEntidadeCtrl($scope, Entity, estadosBrasil) {

    var params = {
        // Ver AvaliacaoFormularioCtrl.js
        'id': $scope.avaliacao.entidadeId,
        '@select': [
           'id',
           'rcv_tipo',
           'name',
           'nomeCompleto',
           'cnpj',
           'representanteLegal',
           'tipoPontoCulturaDesejado',
           'tipoOrganizacao',
           'responsavel_operadora',
           'responsavel_operadora2',
           'emailPrivado',
           'telefone1',
           'telefone1_operadora',
           'telefone2',
           'telefone2_operadora',
           'responsavel_nome',
           'responsavel_email',
           'responsavel_cargo',
           'responsavel_telefone',
           'responsavel_telefone2',
           'geoEstado',
           'geoMunicipio',
           'pais',
           'En_Bairro',
           'En_Num',
           'En_Nome_Logradouro',
           'cep',
           'En_Complemento'
        ].join(','),
        '@permissions': 'view'
    };

    Entity.get(params).then(function (response) {
        $scope.agent = response.data;

        $scope.agent._tipoOrganizacao = {
            'coletivo': 'Coletivo Cultural (CPF)',
            'entidade': 'Entidade (CNPJ)',
        }[$scope.agent.tipoOrganizacao];

        $scope.agent._tipoPontoCulturaDesejado = {
            'ponto': 'Ponto de Cultura',
            'pontao': 'Pontão de Cultura',
        }[$scope.agent.tipoPontoCulturaDesejado];

        if ($scope.agent.pais === 'Brasil' && $scope.agent.geoEstado) {
            $scope.agent._geoEstadoTexto = estadosBrasil[$scope.agent.geoEstado];
        }
    });
}


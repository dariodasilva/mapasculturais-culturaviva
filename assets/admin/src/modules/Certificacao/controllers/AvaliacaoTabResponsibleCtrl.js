/* global google */

angular
        .module('Certificacao')
        .controller('AvaliacaoTabResponsibleCtrl', AvaliacaoTabResponsibleCtrl);

AvaliacaoTabResponsibleCtrl.$inject = ['$scope', 'Entity', 'estadosBrasil'];

function AvaliacaoTabResponsibleCtrl($scope, Entity, estadosBrasil) {

    var params = {
        // Ver AvaliacaoFormularioCtrl.js
        'id': $scope.agentId,
        '@select': [
            'id',
            'rcv_tipo',
            'singleUrl',
            'name',
            'rg',
            'rg_orgao',
            'relacaoPonto',
            'pais',
            'cpf',
            'geoEstado',
            'terms',
            'emailPrivado',
            'telefone1',
            'telefone1_operadora',
            'telefone2',
            'telefone2_operadora',
            'nomeCompleto',
            'geoMunicipio',
            'facebook',
            'twitter',
            'googleplus',
            'telegram',
            'whatsapp',
            'culturadigital',
            'diaspora',
            'instagram',
            'flickr',
            'youtube',
            'mesmoEndereco',
            'shortDescription'
        ].join(','),
        '@files': '(avatar.avatarBig,portifolio,gallery.avatarBig):url',
        '@permissions': 'view'
    };

    Entity.get(params).then(function (response) {
        $scope.agent = response.data;

        $scope.agent._relacaoPontoTexto = {
            'responsavel': 'Responsável pelo Ponto/Pontão de Cultura',
            'funcionario': 'Trabalha no Ponto/Pontão de Cultura',
            'parceiro': 'Parceiro do Ponto/Pontão e está ajudando a cadastrar'
        }[$scope.agent.relacaoPonto];

        if ($scope.agent.pais === 'Brasil' && $scope.agent.geoEstado) {
            $scope.agent._geoEstadoTexto = estadosBrasil[$scope.agent.geoEstado];
        }
    });
}


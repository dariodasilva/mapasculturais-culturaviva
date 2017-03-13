/* global google */

angular
        .module('Certificacao')
        .controller('AvaliacaoFormularioCtrl', AvaliacaoFormularioCtrl);

AvaliacaoFormularioCtrl.$inject = ['$scope', '$state', '$http'];

/**
 * Listagem de Inscrições disponíveis para Avaliação
 *
 * @param {type} $scope
 * @param {type} $state
 * @param {type} $http
 * @returns {undefined}
 */
function AvaliacaoFormularioCtrl($scope, $state, $http) {

    // Configuração da página
    $scope.pagina.titulo = 'Avaliação do Ponto/Pontão de Cultura';
    $scope.pagina.subTitulo = '';
    $scope.pagina.classTitulo = '';
    $scope.pagina.ajudaTemplateUrl = '';
    $scope.pagina.breadcrumb = [
        {
            title: 'Início',
            sref: 'pagina.relatorios'
        },
        {
            title: 'Avaliações',
            sref: 'pagina.certificacao.lista'
        }
    ];

    $scope.certificadores = null;
    $scope.form = {};
    $scope.certificadores = {};

    var codigo = $state.params.id;

    $scope.simNao = [
        {valor: true, label: 'Sim'},
        {valor: false, label: 'Não'}
    ];


    $http.get('/avaliacao/obter/' + codigo).then(function (response) {
        var data = response.data;
        $scope.avaliacao = data;

        // Usado pelos controllers filhos
        $scope.agentId = data.agenteId;

        $scope.situacaoAvaliacao = {
            'P': 'Pendente',
            'A': 'Em Análise',
            'D': 'Deferido',
            'I': 'Indeferido'
        }[data.estado];

        $scope.situacaoInscricao = {
            'P': 'Pendente',
            'C': 'Certificado',
            'N': 'Não Certificado',
            'R': 'Re-Submissão',
        }[data.inscricaoEstado];

        angular.forEach($scope.avaliacao.criterios, function (criterio) {
            if(criterio.aprovado){
                criterio.aprovado = $scope.simNao[0];
            }else{
                criterio.aprovado = $scope.simNao[1];
            }
        })
    }, function (cause) {
        var data = cause.data;
        var msg = 'Erro ao recuperar dados da Avaliação';
        if (data && data.message) {
            msg = data.message;
        }
        $scope.$emit('msg', msg, null, 'error');
    });


    var botao = {
        title: '...',
        disabled: true,
        click: function () {
            $scope.criterios.push({
                ordem: $scope.criterios.length + 100,
                descricao: ''
            });
        }
    };

//    setTimeout(function () {
//        botao.title = "lba";
//        $scope.$digest();
//    }, 2000);
    $scope.botoes = [
        // Botões adicionais para o formulário
        botao
    ];


    $scope.permiteDeferir = false;
    $scope.permiteIndeferir = false;

    $scope.$watch('avaliacao.criterios', function (old, nue) {
        if (old === nue) {
            return;
        }

        $scope.permiteDeferir = true;
        $scope.permiteIndeferir = false;
        var botaoBloqueado = false;

        for (var a = 0, l = $scope.avaliacao.criterios.length; a < l; a++) {
            var criterio = $scope.avaliacao.criterios[a];
            if (criterio.aprovado === undefined || criterio.aprovado === null) {
                botaoBloqueado = true;
                break;
            }

            if (criterio.aprovado.valor === true && $scope.permiteIndeferir) {
                $scope.permiteDeferir = false;
            } else if (criterio.aprovado.valor === false) {
                $scope.permiteIndeferir = true;
                $scope.permiteDeferir = false;
            }
            console.log(criterio.aprovado);
        }

        botao.disabled = botaoBloqueado;
        if (botaoBloqueado) {
            botao.title = "...";
            botao.class = "btn-default";
        } else if ($scope.permiteDeferir) {
            botao.title = "Deferir";
            botao.disabled = botaoBloqueado;
            botao.class = "btn-success";
        } else if ($scope.permiteIndeferir) {
            botao.title = "Indeferir";
            botao.class = "btn-danger";
        }

        botao.disabled = true;
        // criterio.aprovado
        // criterio.aprovado
    }, true);

    $scope.salvar = function () {
        var criterios = [];
        for (var a = 0, l = $scope.avaliacao.criterios.length; a < l; a++) {
            var criterio = $scope.avaliacao.criterios[a];
            if (criterio.aprovado === undefined || criterio.aprovado === null) {
                continue;
            }

            criterios.push({
                id: criterio.id,
                aprovado: criterio.aprovado.valor
            });
        }

        $http.post('/avaliacao/salvar', {
            id: $scope.avaliacao.id,
            observacoes: $scope.avaliacao.observacoes,
            criterios: criterios
        }).then(function (response) {
            $scope.$emit('msgNextState', 'Dados da avaliação salvo com sucesso', null, 'success');
        }, function (response) {
            var msg = 'Erro inesperado salvar dados';
            if (response.data && response.data.message) {
                msg = response.data.message;
            }
            $scope.$emit('msg', msg, null, 'error', 'formulario');
        });
    };
}


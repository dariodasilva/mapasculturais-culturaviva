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

    $http.get('/avaliacao/obter/' + codigo).then(function (response) {
        console.log(response.data);
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
    }, function (cause) {
        var data = cause.data;
        var msg = 'Erro ao recuperar dados da Avaliação';
        if (data && data.message) {
            msg = data.message;
        }
        $scope.$emit('msg', msg, null, 'error');
    });


    $scope.criterio = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus commodo justo, ut ullamcorper nulla auctor eget. Quisque euismod feugiat placerat. Nunc cursus enim sed ipsum pharetra malesuada. Morbi egestas erat non magna pharetra tincidunt. Curabitur facilisis magna urna, ut suscipit velit vulputate vitae. Aenean sed massa molestie, condimentum ante vel, tincidunt tellus. Sed sagittis, justo quis condimentum tincidunt, mi enim feugiat mi, eu malesuada nunc nisl ut nisl.';
    $scope.nomePonto = 'Lorem ipsum dolor sit amet,s';
    $scope.nomeAgente = 'Alex Rodin de Sousa';
    $scope.situacaoAvaliacao = 'Em Análise';
    $scope.situacaoInscricao = 'Pendente';
    $scope.simNao = [
        {valor: true, label: 'Sim'},
        {valor: false, label: 'Não'}
    ];

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

        // criterio.aprovado
        // criterio.aprovado
    }, true);
    
    $scope.salvar = function(){
        
    }
}


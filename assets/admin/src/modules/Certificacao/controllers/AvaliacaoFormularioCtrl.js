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
        console.log(response);
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

    $scope.botoes = [
        // Botões adicionais para o formulário
        {
            title: 'Finalizar Avaliação',
            disabled: true,
            click: function () {
                $scope.criterios.push({
                    ordem: $scope.criterios.length + 100,
                    descricao: ''
                });
            }
        }
    ];
}


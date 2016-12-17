/* global google */

angular
        .module('AppAdmin.controllers')
        .controller('CertificadorFormularioCtrl', CertificadorFormularioCtrl);

CertificadorFormularioCtrl.$inject = ['$scope', '$state', '$http'];

/**
 * O tipo de certificador sendo cadastrado
 *
 * @type Array
 */
CertificadorFormularioCtrl.TIPO_CERTIFICADOR = [
    {codigo: 'P', label: 'Poder Público'},
    {codigo: 'C', label: 'Sociedade Civil'},
    {codigo: 'M', label: 'Voto de Minerva'}
];



/**
 * Faz o mapeamento do serviço de busca para o scope
 *
 * @param {type} dto
 * @returns {Object}
 */
CertificadorFormularioCtrl.converterParaEscopo = function (dto) {
    return {
        id: dto.id,
        agentId: dto.agentId,
        type: dto.type,
        isActive: dto.isActive
    };
};

/**
 * Faz o mapeamento do DTO do scope para o serviço de persistencia
 *
 * @param {type} dto
 * @returns {Object}
 */
CertificadorFormularioCtrl.converterParaSalvar = function (dto) {
    return {
        id: dto.id,
        agentId: dto.agentId,
        type: dto.type.codigo,
        isActive: dto.isActive
    };
};


/**
 * Formulário de cadastro e edição de agentes de certificação
 *
 * @param {type} $scope
 * @param {type} $state
 * @param {type} $http
 * @returns {undefined}
 */
function CertificadorFormularioCtrl($scope, $state, $http) {

    var codigo = $state.params.id;
    var novoRegistro = (!codigo || codigo === '');

    // Configuração da página
    $scope.page.title = novoRegistro ? 'Cadastrar Agente de Certificação' : 'Editar Agente de Certificação';
    $scope.page.subTitle = '';
    $scope.page.breadcrumb = [
        {
            title: 'Início',
            sref: 'pagina.relatorios'
        },
        {
            title: 'Configurações'
        },
        {
            title: 'Certificadores',
            sref: 'pagina.configuracao.certificador.lista'
        }
    ];

    $scope.tipos = CertificadorFormularioCtrl.TIPO_CERTIFICADOR;

    // Variaveis utilitárias
    $scope.ref = {
        buscarAgente: false,
        novoRegistro: novoRegistro,
        filtrarAgenteTexto: ''
    };

    if (novoRegistro) {
        var paramTipoCertificador = $state.params.tipo;
        $scope.dto = {
            type: CertificadorFormularioCtrl.TIPO_CERTIFICADOR.find(function (item) {
                return item.codigo === paramTipoCertificador;
            }),
            isActive: true
        };
    } else {
        $http.get('/certificador/obter/' + codigo)
                .success(function (certificador) {
                    $scope.dto = CertificadorFormularioCtrl.converterParaEscopo(certificador);
                })
                .error(function (error) {
                    $scope.$emit('msg', 'Erro ao recuperar dados do Agente de Certificação', null, 'error');
                });
    }


    $scope.salvar = function () {
        $http.post('/certificador/salvar', CertificadorFormularioCtrl.converterParaSalvar($scope.dto))
                .success(function (certificador) {
                    $scope.$emit('msgNextState', 'Agente de Certificação salvo com sucesso', null, 'success');
                    if (novoRegistro) {
                        $state.go('page.private.notificacao.lista', null, {
                            reload: true,
                            inherit: true,
                            notify: true
                        });
                    } else {
                        $state.reload();
                    }
                })
                .error(function (error) {
                    $scope.$emit('msg', 'Erro inesperado salvar dados', null, 'error', 'formulario');
                });
    };


    $scope.filtrarAgente = function (texto) {
        if (!texto || texto === '') {
            $scope.agentes = null;
            return;
        }

        $scope.agentes = [];

        $scope.$emit('msgClear', 'filtro-promocoes');

        $http.get('/certificador/buscarAgente', {
            params: {
                nome: texto
            }
        }).success(function (agentes) {
            $scope.agentes = agentes;
            if (!agentes || agentes.length < 1) {
                $scope.$emit('msg', 'Nenhum Agente encontrado com o nome informado', null, 'info', 'bag-filtro-agentes');
            }
        }).error(function (error) {
            $scope.$emit('msg', 'Erro inesperado ao carregar a lista de Agentes', null, 'error', 'bag-filtro-agentes');
        });
    };

    $scope.selecionarAgente = function (agente) {
        $scope.dto.agentId = agente.id;
        $scope.dto.agentName = agente.name;
        $scope.ref.buscarAgente = false;
    };
}

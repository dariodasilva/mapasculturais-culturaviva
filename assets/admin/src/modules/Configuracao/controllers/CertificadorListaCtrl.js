/* global google */

angular
        .module('Configuracao')
        .controller('CertificadorListaCtrl', CertificadorListaCtrl);

CertificadorListaCtrl.$inject = ['$scope', '$state', '$http'];

/**
 * Listagem de certificadores
 *
 * @param {type} $scope
 * @param {type} $state
 * @param {type} $http
 * @returns {undefined}
 */
function CertificadorListaCtrl($scope, $state, $http) {

    // Configuração da página
    $scope.page.title = 'Certificadores';
    $scope.page.subTitle = 'Listagem de Agentes de certificação';
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

    $scope.certificadores = null;
    $scope.form = {};
    $scope.certificadores = {};

    $http.get('/certificador/listar').then(function (response) {
        $scope.certificadores.civil = {
            titular: response.data.filter(function (cert) {
                return cert.tipo === 'C' && cert.titular;
            }),
            suplente: response.data.filter(function (cert) {
                return cert.tipo === 'C' && !cert.titular;
            })
        };
        $scope.certificadores.publico = {
            titular: response.data.filter(function (cert) {
                return cert.tipo === 'P' && cert.titular;
            }),
            suplente: response.data.filter(function (cert) {
                return cert.tipo === 'P' && !cert.titular;
            })
        };
        $scope.certificadores.minerva = {
            titular: response.data.filter(function (cert) {
                return cert.tipo === 'M' && cert.titular;
            }),
            suplente: response.data.filter(function (cert) {
                return cert.tipo === 'M' && !cert.titular;
            })
        };
    });
}


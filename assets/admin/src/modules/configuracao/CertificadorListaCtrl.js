/* global google */

angular
        .module('AppAdmin.controllers')
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

    $http.get('/certificador/listar').success(function (data) {
        $scope.certificadores.civil = {
            titular: data.filter(function (cert) {
                return cert.tipo === 'C' && cert.titular;
            }),
            suplente: data.filter(function (cert) {
                return cert.tipo === 'C' && !cert.titular;
            })
        };
        $scope.certificadores.publico = {
            titular: data.filter(function (cert) {
                return cert.tipo === 'P' && cert.titular;
            }),
            suplente: data.filter(function (cert) {
                return cert.tipo === 'P' && !cert.titular;
            })
        };
        $scope.certificadores.minerva = {
            titular: data.filter(function (cert) {
                return cert.tipo === 'M' && cert.titular;
            }),
            suplente: data.filter(function (cert) {
                return cert.tipo === 'M' && !cert.titular;
            })
        };
    });
}


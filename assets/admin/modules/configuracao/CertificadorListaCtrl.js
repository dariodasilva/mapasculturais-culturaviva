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
        $scope.certificadores.civil = data.filter(function (item) {
            return item.type === 'C';
        });
        $scope.certificadores.publico = data.filter(function (item) {
            return item.type === 'P';
        });
        $scope.certificadores.minerva = data.filter(function (item) {
            return item.type === 'M';
        });
    });

    $scope.submitForm = function () {
        $http({
            method: 'POST',
            url: '/certificador/index/',
            data: $.param($scope.form),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .success(function (data) {
                    if (data.errors) {
                        console.log(data.errors);
                    } else {
                        console.log('sucesso certifier post');
                        $scope.message = data.message;
                        $scope.certificadores = data;
                    }
                });
    };

    $scope.find = function () {
        $http({
            method: 'POST',
            url: '/certificador/find/',
            data: $.param($scope.form),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .success(function (data) {
                    if (data.errors) {
                        console.log(data.errors);
                    } else {
                        console.log('find certifiers');
                        $scope.certificadores = data;
                        $scope.message = data.message;
                    }
                });
    };

    $scope.status = function (status) {
        return (status == true) ? 'Ativo' : 'Inativo';
    };
    $scope.tipo = function (tipo) {
        return (tipo == 'S') ? 'Sociedade Civil' : 'Governo';
    };
}


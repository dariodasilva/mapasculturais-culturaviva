(function (angular) {
    'use strict';

    var app = angular
            .module('AppAdmin', [
                'ngRoute',
                'ui.router',
                'blockUI',
                // Módulos da aplicação
                'AppAdmin.services',
                'AppAdmin.directives',
                'AppAdmin.controllers'
            ]);





    // Certifier Controller
    app.controller('ngCertifierController', ['$scope', '$location', '$http', function ($scope, $location, $http) {

            $scope.form = {};
            $scope.certifiers = {};
            $http.get('/certificador/listAll')
                    .success(function (data) {
                        $scope.certifiers = data;
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
                                $scope.certifiers = data;
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
                                $scope.certifiers = data;
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
        }]);

    // Panel Digilences
    app.controller('ngPanelController', function ($scope, $http, $window) {

        $scope.diligences = {};
        $http.get('/certificacao/diligences/')
                .success(function (data) {
                    $scope.diligences = data;
                });

        $scope.getClass = function (status) {
            if (status == 'C') {
                return 'glyphicon-ok';
            } else if (status == 'N') {
                return 'glyphicon-remove';
            } else {
                return 'glyphicon-minus';
            }
        }

        $scope.evaluationDiligence = function (id) {
            $window.location.href = '/certificacao/ponto/' + id;
        }
    });

    // Ponto Detail
    // app.controller('ngPontoController', function ($scope, $http) {
    // });

    // Ponto Detail
    app.controller('ngEvaluationController', ['$scope', '$route', '$routeParams', '$http', '$location',
        function ($scope, $route, $routeParams, $http, $location) {

            $scope.form = {};
            $scope.isHiddenButton = false;
            $scope.isSaved = false;

            var id = $location.path().split('/').pop();
            $http.get('/certificacao/diligence/' + id)
                    .success(function (data) {
                        $scope.form = data;
                        console.log(data);
                    });

            $scope.submitForm = function (finish) {

                var submit = true;
                if (finish != null) {
                    submit = false;
                    var result = 'CERTIFICADO';
                    if (finish == 'certified') {
                        $scope.form.status = 'C';
                    }
                    if (finish == 'no-certified') {
                        result = 'NÃO CERTIFICADO';
                        $scope.form.status = 'N';
                    }
                    var text = "Deseja realmente atribuir o status de '" + result + "' para esta inscrição?";
                    if (confirm(text)) {
                        submit = true;
                    } else {
                        $scope.form.status = 'R';
                    }
                }

                if (submit) {
                    $scope.isSaved = false;
                    $http({
                        method: 'POST',
                        url: '/certificacao/index/',
                        data: $.param($scope.form),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    })
                            .success(function (data) {
                                if (data.errors) {
                                    console.log(data.errors);
                                } else {
                                    $scope.certificacao.$setPristine();
                                    $scope.isSaved = true;
                                }
                            });
                }
            };

            $scope.isReadOnly = function (status) {
                if (status == 'C' || status == 'N') {
                    return true;
                }
                return false;
            };
        }]);

    // Configuration //
    app.config(['$httpProvider', '$locationProvider', '$routeProvider', '$stateProvider',
        function ($httpProvider, $locationProvider, $routeProvider, $stateProvider) {
//            $locationProvider.html5Mode({
//                enabled: true,
//                requireBase: false
//            });


        }]);


})(angular);

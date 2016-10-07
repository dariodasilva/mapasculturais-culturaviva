(function(angular){
    'use strict';
    var app = angular.module('culturaviva.controllers', []);

    var agentsPontoDados = ["name",
                        "nomeCompleto",
                        "cnpj",
                        "representanteLegal",
                        "tipoPontoCulturaDesejado",
                        "tipoOrganizacao",
                        "emailPrivado",
                        "telefone1",
                        "telefone1_operadora",
                        "telefone2",
                        "telefone2_operadora",
                        "responsavel_nome",
                        "responsavel_email",
                        "responsavel_cargo",
                        "responsavel_telefone",
                        "geoEstado",
                        "geoMunicipio",
                        "pais",
                        "En_Bairro",
                        "En_Num",
                        "En_Nome_Logradouro",
                        "En_Complemento"
                      ];


    var agentPontoMapa = [
                        "name",
                        "shortDescription",
                        "cep",
                        "tem_sede",
                        "geoEstado",
                        "geoMunicipio",
                        "En_Bairro",
                        "pais",
                        "En_Nome_Logradouro",
                        "En_Num",
                        "location",
                      ];

    var termos = {
            area: [
            'Antropologia',
            'Arqueologia',
            'Arquitetura-Urbanismo',
            'Arquivo',
            'Arte de Rua',
            'Arte Digital',
            'Artes Visuais',
            'Artesanato',
            'Audiovisual',
            'Cinema',
            'Circo',
            'Comunicação',
            'Cultura Cigana',
            'Cultura Digital',
            'Cultura Estrangeira (imigrantes)',
            'Cultura Indígena',
            'Cultura LGBT',
            'Cultura Negra',
            'Cultura Popular',
            'Dança',
            'Design',
            'Direito Autoral',
            'Economia Criativa',
            'Educação',
            'Esporte',
            'Filosofia',
            'Fotografia',
            'Gastronomia',
            'Gestão Cultural',
            'História',
            'Jogos Eletrônicos',
            'Jornalismo',
            'Leitura',
            'Literatura',
            'Livro',
            'Meio Ambiente',
            'Mídias Sociais',
            'Moda',
            'Museu',
            'Música',
            'Novas Mídias',
            'Patrimônio Imaterial',
            'Patrimônio Material',
            'Pesquisa',
            'Produção Cultural',
            'Rádio',
            'Saúde',
            'Sociologia',
            'Teatro',
            'Televisão',
            'Turismo'
            ],

            local_realizacao: [
                'Escolas',
                'Universidades',
                'Praças',
                'Salas',
                'CEUs',
                'Feiras',
                'Eventos'
            ],

            contemplado_edital: [
                'Ponto de Cultura',
                'Pontão de Cultura',
                'Ponto de Mídia Livre',
                'Ponto de Memória',
                'Ponto de Leitura',
                'Ponto de Cultura Indígena',
                'Pontinho de Cultura',
                'Pontão de Bens Registrados',
                'Ainda não fui contemplado'
            ],

            acao_estruturante: [
                'Conhecimentos tradicionais',
                'Cultura, comunicação e mídia livre',
                'Cultura e educação',
                'Economia criativa e solidária',
                'Cultura digital',
                'Cultura e juventude',
                'Intercâmbio e residências artístico-culturais',
                'Cultura e saúde',
                'Cultura e direitos humanos',
                'Livro, Leitura e literatura',
                'Memória e patrimônio cultural',
                'Cultura e meio ambiente',
                'Cultura, infância e adolescência',
                'Agente cultura viva',
                'Cultura circense'
            ],

            publico_participante: [
                'Afro-Brasileiros',
                'Ciganos',
                'Estudantes',
                'Grupos artísticos e culturais independentes',
                'Idosos ',
                'Imigrantes',
                'Indígenas',
                'Crianças e Adolescentes',
                'Juventude',
                'LGBT',
                'Mulheres',
                'Pescadores',
                'Pessoas com deficiência',
                'Pessoas em situação de sofrimento psíquico',
                'População de Rua',
                'População em regime prisional',
                'Povos e Comunidades Tradicionais de Matriz Africana',
                'Público em Geral',
                'Quilombolas',
                'Ribeirinhos',
                'População Rural',
                'População de Baixa Renda',
                'Grupos assentados de reforma agrária',
                'Mestres, praticantes, brincantes e grupos culturais populares, urbanos e rurais',
                'Pessoas ou grupos vítimas de violência',
                'População sem teto',
                'Populações atingida por barragens',
                'Populações de regiões fronteiriças',
                'Populações em áreas de vulnerabilidade social'
            ],

            area_atuacao: [
                'Produção',
                'Cultural',
                'Artes Cênicas',
                'Artes Visuais',
                'Artesanato',
                'Audiovisual',
                'Capacitação',
                'Capoeira',
                'Contador de Histórias',
                'Cultura Afro',
                'Cultura Alimentar',
                'Cultura Digital',
                'Culturas Indígenas',
                'Culturas Populares',
                'Comunicação Direitos Humanos',
                'Esporte',
                'Fotografia',
                'Gastronomia',
                'Gênero',
                'Hip Hop',
                'Juventude',
                'Literatura',
                'Meio Ambiente',
                'Moda',
                'Música',
                'Software Livre',
                'Tradição Oral',
                'Turismo',
                'Internacional'
            ],

            instancia_representacao_minc: [
                'Colegiados',
                'Fóruns',
                'Comissões',
                'Conferência Nacional de Cultura',
                'Grupo de Trabalho',
                'Conselhos'
            ],

            // Economia Viva
            'ponto_infra_estrutura': [
                'Acesso à internet',
                'Sala de aula Auditório',
                'Teatro',
                'Estúdio',
                'Palco',
                'Galpão',
                'Hackerspace',
                'Casa',
                'Apartamento',
                'Cozinha',
                'Garagem',
                'Jardim',
                'Bar',
                'Laboratório',
                'Gráfica',
                'Loja'
            ],
            'ponto_equipamentos':[
                'Câmera fotográfica',
                'Câmera filmadora',
                'Microfone',
                'Fone de Ouvido',
                'Boom',
                'Spot de luz',
                'Refletor',
                'Mesa de Som',
                'Caixa de Som',
                'Instrumento Musical',
                'Computador',
                'Mesa de Edição',
                'Impressora',
                'Scanner'
            ],
            'ponto_recursos_humanos':[
                'Ator / Atriz',
                'Dançarino / Dançarina',
                'Músico / Musicista',
                'Pesquisador',
                'Oficineiro',
                'Produtor',
                'Elaborador de Projeto',
                'Cultural',
                'Captador de Recursos',
                'Realizador audiovisual (Videomaker)',
                'Designer',
                'Fotógrafo',
                'Hacker',
                'Iluminador',
                'Sonorizador',
                'Maquiador',
                'Cenógrafo',
                'Eletricista',
                'Bombeiro',
                'Hidráulico',
                'Consultor',
                'Palestrante',
                'Rede',
                'Médica',
                'Solidária'
            ],
            'ponto_hospedagem':[
                'Convênio com Rede Hoteleira',
                'Hospedagem',
                'Solidária',
                'Camping'
            ],
            'ponto_deslocamento':[
                'Passagem Aérea',
                'Carona, Veículo',
                'Passagem Terrestre'
            ],
            'ponto_comunicacao':[
                'Assessoria de Imprensa',
                'Produção de Conteúdo e Mobilização nas Redes Sociais',
                'Produção de Conteúdo e Informação',
                'Jornalismo',
                'Audiovisual',
                'Fotografia',
                'Desenvolvimento Web',
                'Mídia',
                'Comunitária',
                'Design'
            ],
            'ponto_sustentabilidade':[
                'Prestação de serviços',
                'Venda de produtos',
                'Patrocínio',
                'Apoio/doação/colaboração',
                'Troca direta e indireta',
                'Empréstimo',
                'Emprego/salário',
                'Convênio com Órgão público',
                'Moeda complementar (social)'
            ],

            'metodologias_areas': [
               'Não formal',
               'Conhecimento popular',
               'Conhecimento empírico',
               'Acadêmica',
               'Ensino básico',
               'Ensino médio',
               'Ensino superior',
               'Graduação',
               'Pós-graduação'
            ]
        };

    function extendController($scope, $timeout, Entity, agent_id, $http){

        $scope.messages = {
            status: null,
            text: '',
            show: function(status, text){
                this.status = status;
                this.text = text;
            },
            hide: function(){
                this.status = null;
                this.text = '';
            }
        };

        $scope.$watch('messages.status', function(new_status, old_status){
            if(new_status === null){
                $scope.messages.text = '';
                return;
            }

            var timeout = 2500;

            if(new_status === 'erro'){
                timeout = 5000;
            }

            $timeout(function(){
                $scope.messages.hide();
            }, timeout);
        });

        if(Entity && agent_id){
            $scope.originalAgent = {};
            $scope.agent.$promise.then(function(agent){
                if(typeof agent.location === 'object'){
                    agent.location = [agent.location.longitude, agent.location.latitude];
                }
                $scope.originalAgent = JSON.parse(angular.toJson(agent));
            });

            $scope.save_field = function save_field(field) {
              var validaLink = "http://";
              var flag = false;
              if((field === "atividadesEmRealizacaoLink") && ($scope.agent[field] !== "")){
                if($scope.agent[field].indexOf("http://") !== -1){
                  flag = true;
                }else if(($scope.agent[field].indexOf("https://") !== -1) && (!flag)){
                  flag = true;
                }
                if(!flag){
                  $scope.agent[field] = validaLink +  $scope.agent[field];
                }
              }
                if(angular.equals($scope.agent[field], $scope.originalAgent[field])){
                    return;
                }

                $scope.originalAgent[field] = angular.copy($scope.agent[field]);

                var agent_update = {};
                agent_update[field] = $scope.agent[field];
                $scope.messages.show('enviando', 'salvando alterações');

                Entity.patch({'id': agent_id}, agent_update, function(agent){
                    $scope.messages.show('sucesso', 'alterações salvas');
                }, function(error){
                    try{
                        $scope.messages.show('erro', error.data.data[field].toString());
                    }catch(e){
                        $scope.messages.hide();
                    }
                });
            };

        }

        $scope.showInvalid = function(agentTipo, nomeForm){
          $scope.data = MapasCulturais.redeCulturaViva;
          $http.post(MapasCulturais.createUrl('cadastro','enviar')).
          error(function errorCallback(response) {
              if(response.error){
                  $scope.data.validationErrors = response.data;
              }
              switch (agentTipo) {
                case 'responsavel':
                  var form = $scope[nomeForm];
                  var erros_responsavel = $scope.data.validationErrors.responsavel;
                  erros_responsavel.forEach(function(elemento,index,array){
                    if(form[elemento]){
                      angular.element("[name='"+elemento+"']").addClass('input_erro');
                    }
                  });
                  break;
                case 'entidade':
                  var form = $scope[nomeForm];
                  var erros_entidade = $scope.data.validationErrors.entidade;
                  erros_entidade.forEach(function(elemento,index,array){
                    if(form[elemento]){
                      angular.element("[name='"+elemento+"']").addClass('input_erro');
                    }
                  });
                case 'ponto':
                  var form = $scope[nomeForm];
                  var erros_ponto = $scope.data.validationErrors.ponto;
                  erros_ponto.forEach(function(elemento,index,array){
                    if(form[elemento]){
                      angular.element("[name='"+elemento+"']").addClass('input_erro');
                    }
                  });
                break;
              }
          });
        }
    }

    app.controller('DashboardCtrl', ['$scope', 'Entity', 'MapasCulturais', '$http', '$timeout', 'ngDialog',
        function($scope, Entity, MapasCulturais, $http, $timeout, ngDialog){

            var agent_id = MapasCulturais.redeCulturaViva.agenteIndividual;
            var agent_id_entidade = MapasCulturais.redeCulturaViva.agenteEntidade;
            var agent_id_ponto = MapasCulturais.redeCulturaViva.agentePonto;

            var params = {
                'id': agent_id,
                '@select': 'id,singleUrl,name,rg,rg_orgao,relacaoPonto,cpf,geoEstado,terms,'+
                           'emailPrivado,telefone1,telefone1_operadora,nomeCompleto,'+
                           'geoMunicipio,facebook,twitter,googleplus,mesmoEndereco,shortDescription,' +
                           'termos_de_uso,info_verdadeira,obs',
                '@permissions': 'view'
            };

            var params_entidade = {
                'id': agent_id_entidade,
                '@select': 'id,tipoPontoCulturaDesejado',
                '@permissions': 'view'
            };

            var params_ponto = {
                'id': agent_id_ponto,
                '@select': 'id,homologado_rcv',
                '@permissions': 'view'
            };

            $scope.agent = Entity.get(params);
            $scope.agent_entidade = Entity.get(params_entidade);
            $scope.agent_ponto = Entity.get(params_ponto);

            extendController($scope, $timeout, Entity, agent_id);

            $scope.data = MapasCulturais.redeCulturaViva;
            $scope.enviar = function(){
                $http.post(MapasCulturais.createUrl('cadastro', 'enviar')).
                        success(function successCallback(response) {
                            $scope.data.validationErrors = null;
                            if($scope.data.statusInscricao==0){
                              ngDialog.open({
                                template: 'modal1',
                                scope: $scope
                              });
                            }
                            else {
                              ngDialog.open({
                                template: 'modal2',
                                scope: $scope
                              });
                            }
                        }).
                        error(function errorCallback(response) {
                            if(response.error){
                              $scope.data.validationErrors = response.data;
                            }
                            var erroResponsavel = $scope.data.validationErrors.responsavel;
                            var erroPonto = $scope.data.validationErrors.ponto;
                            var erroEntidade= $scope.data.validationErrors.entidade;
                            if(erroResponsavel.length > 0){
                              $scope.data.mostrarErroResponsavel = "responsavel";
                            }
                            if(erroPonto.length > 0){
                              if(erroPonto.indexOf("atividadesEmRealizacaoLink") !== -1){
                                $scope.data.mostrarErroPonto = "ponto_portifolio";
                              }
                              var i;
                              var j;
                              for(i = 0; i < erroPonto.length; i++){
                                for(j = 0; j < agentPontoMapa.length; j++){
                                    if(erroPonto[i] === agentPontoMapa[j]){
                                      $scope.data.mostrarErroPontoMapa = "ponto_mapa";
                                    }
                                }
                              }
                            }
                            if(erroEntidade.length > 0){
                              var i;
                              var j;
                              for(i = 0; i < erroEntidade.length; i++){
                                for(j = 0; j < agentsPontoDados.length; j++){
                                    if(erroEntidade[i] === agentsPontoDados[j]){
                                      $scope.data.mostrarErroEntidadeDado = "entidade_showdado";
                                    }
                                }
                              }
                            }

                        });
            };
        }]);


    // TODO: Tranforma em diretiva
     app.controller('ImageUploadCtrl', ['$scope', 'Entity', 'MapasCulturais', 'Upload', '$timeout', '$http',
        function ImageUploadCtrl($scope, Entity, MapasCulturais, Upload, $timeout, $http) {


            var agent_id;
            $scope.init = function(rcv_tipo){
                
                if(rcv_tipo === 'responsavel'){
                    agent_id = MapasCulturais.redeCulturaViva.agenteIndividual;
                }else if(rcv_tipo === 'entidade'){
                    agent_id = MapasCulturais.redeCulturaViva.agenteEntidade;
                } else{
                    agent_id = MapasCulturais.redeCulturaViva.agentePonto;
                }
                
                var params = {
                    'id': agent_id,
                    '@select': 'id,files',
                    '@permissions': 'view'
                };


                $scope.agent = Entity.get(params);
                $scope.agent.$promise.then(function(){
                    $scope.agent.files.gallery = $scope.agent.files.gallery || [];
                });
                
            };

            $scope.config = {
                images: {
                    maxUploadSize: '2MB',
                    validation: 'image/(p?jpeg|png)'
                },
                pdf: {
                    maxUploadSize: '20MB',
                    validation: 'application/pdf'
                }
            };

            $scope.deleteFile = function(file){

                $http.delete(MapasCulturais.createUrl('file','single',[file.id])).then(function(){
                    if(file.group === 'gallery'){
                        $scope.agent.files.gallery.forEach(function(f, index){
                            if(file.id === f.id){
                                $scope.agent.files.gallery.splice(index,1);
                            }
                        });
                    }else{
                        $scope.agent.files[file.group] = null;
                    }
                }, function(a,b,c){
                    console.log('não foi possível apagar a imagem', a,b,c);
                });
            };
            var showErro = function(errozao){
              $scope.errozao = false;
            };

            $scope.uploadFile = function(file, group) {
                if(file.$error==="maxSize"){
                  showErro($scope.errozao)
                }
                $scope.f = file;
                if (file && !file.$error) {
                    var data = {};
                    data[group] = file;
                    file.upload = Upload.upload({
                        url: MapasCulturais.createUrl('agent', 'upload', [agent_id]),
                        data: data
                    });

                    file.upload.then(function (response) {
                        if (response.data.error) {
                            alert(response.data.data.portifolio);
                            return;
                        }
                        if (group === 'gallery') {
                            $scope.agent.files.gallery.push(response.data.gallery[0]);
                        } else {
                            $scope.agent.files[group] = response.data[group];
                        }

                        $timeout(function () {
                            file.result = response.data;
                        });

                        $timeout(function(){
                            $scope.f = 0;
                        }, 1500);
                    }, function (response) {
                        if (response.status > 0)
                            $scope.errorMsg = response.status + ': ' + response.data;
                    });

                    file.upload.progress(function (evt) {
                        file.progress = Math.min(100, parseInt(100.0 *
                                                               evt.loaded / evt.total));
                    });
                }
            };

       }
    ]);


    // Controller do 'Informações do responsável'
    app.controller('ResponsibleCtrl', ['$scope', 'Entity', 'MapasCulturais', 'Upload', '$timeout', '$location', '$http',
        function ResponsibleCtrl($scope, Entity, MapasCulturais, Upload, $timeout, $location, $http)
        {
            var agent_id = MapasCulturais.redeCulturaViva.agenteIndividual;
//            BaseAgentCtrl.call(this, $scope, Agent, MapasCulturais, agent_id, Upload, $timeout);

            var params = {
                'id': agent_id,
                '@select': 'id,rcv_tipo,singleUrl,name,rg,rg_orgao,relacaoPonto,pais,cpf,geoEstado,terms,'+
                           'emailPrivado,telefone1,telefone1_operadora,telefone2,telefone2_operadora,nomeCompleto,'+
                           'geoMunicipio,facebook,twitter,googleplus,telegram,whatsapp,culturadigital,diaspora,instagram,'+
                           'flickr,youtube,mesmoEndereco,shortDescription',

                '@files':'(avatar.avatarBig,portifolio,gallery.avatarBig):url',
                '@permissions': 'view'
            };

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_responsavel');
              }
            });

       }
    ]);

    app.controller('PortifolioCtrl', ['$scope', 'Entity', 'MapasCulturais', 'Upload', '$timeout', 'geocoder', 'cepcoder', '$location', '$http',
        function PortifolioCtrl($scope, Entity, MapasCulturais, Upload, $timeout, geocoder, cepcoder, $location, $http)
        {
            var agent_id = MapasCulturais.redeCulturaViva.agentePonto;
            var agent_id_entidade = MapasCulturais.redeCulturaViva.agenteEntidade;
            var agent_id_ponto = MapasCulturais.redeCulturaViva.agentePonto;

            var params = {
                'id': agent_id,
                '@select': 'id,rcv_tipo,longDescription,atividadesEmRealizacao,site,facebook,twitter,googleplus,telegram,whatsapp,'+
                'culturadigital,diaspora,instagram,flickr,youtube,atividadesEmRealizacaoLink',
                '@files':'(avatar.avatarBig,portifolio,gallery.avatarBig,cartasRecomendacao):url',
                '@permissions': 'view'
            };
            var params_entidade = {
                'id': agent_id_entidade,
                '@select': 'id,tipoOrganizacao',
                '@permissions': 'view'
            };

            var params_ponto = {
                'id': agent_id_ponto,
                '@select': 'id,homologado_rcv',
                '@permissions': 'view'
            };

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_portifolio');
              }
            });
            

            $scope.agent_entidade = Entity.get(params_entidade);
            $scope.agent_ponto = Entity.get(params_ponto);
        }
    ]);


    // Controller do 'Seu ponto no Mapa'
    app.controller('PointCtrl', ['$scope', 'Entity', 'MapasCulturais', 'Upload', '$timeout', 'geocoder', 'cepcoder', '$location', '$http', 'cidadecoder',
        function PointCtrl($scope, Entity, MapasCulturais, Upload, $timeout, geocoder, cepcoder, $location, $http, cidadecoder)
        {
            var agent_id = MapasCulturais.redeCulturaViva.agentePonto;

            var params = {
                'id': agent_id,
                '@select': 'id,rcv_tipo,terms,name,shortDescription,cep,tem_sede,sede_realizaAtividades,mesmoEndereco,pais,geoEstado,geoMunicipio,'+
                    'En_Bairro,En_Num,En_Nome_Logradouro,En_Complemento,localRealizacao_estado,localRealizacao_cidade,'+
                    'localRealizacao_cidade,localRealizacao_espaco,location',
                '@files':'(avatar.avatarBig,portifolio,gallery.avatarBig):url',
                '@permissions': 'view'
            };

            $scope.markers = {};
            $scope.agent = Entity.get(params, function(agent){
                $scope.markers.main = {
                    lat: agent.location.latitude,
                    lng: agent.location.longitude,
                    message: agent.endereco
                };
                extendController($scope, $timeout, Entity, agent_id, $http);

                if($location.search().invalid === '1'){
                  $scope.showInvalid($scope.agent.rcv_tipo, 'form_ponto');
                }
            });

            $scope.termos = termos;

            $scope.$watch('markers.main', function(point){
                if(point && point.lat && point.lng) {
                    $scope.agent['location'] = [point.lng, point.lat];
                    $scope.save_field('location');
                }
            }, true);

            $scope.cidadecoder = {
                busy: false,
                code: function(cidade, pais){
                    $scope.agent.geoMunicipio = cidade;
                    $scope.save_field('geoMunicipio');
                    $scope.cidadecoder.busy = true;
                    cidadecoder.code(cidade, pais).then(function(res){
                        var addr = res.data[0];
                        if(addr){
                            var string = (addr.display_name ? addr.display_name+', ':'');
                        }

                        return geocoder.code(string);

                    }).then(function(point){
                        point.zoom = 14;
                        $scope.markers.main = point;
                    })['catch'](function(){
                        $scope.markers.main = undefined;
                    }).finally(function(){
                        $scope.cepcoder.busy = false;
                    });
                }
            };

            $scope.cepcoder = {
                busy: false,
                code: function(cep){
                    $scope.agent.cep = cep;
                    $scope.save_field('cep');
                    $scope.cepcoder.busy = true;
                    cepcoder.code(cep).then(function(res){
                        var addr = res.data;
                        if(addr){
                            $scope.agent.geoEstado = addr.estado;
                            $scope.save_field('geoEstado');

                            $scope.agent.geoMunicipio = addr.cidade;
                            $scope.save_field('geoMunicipio');

                            $scope.agent.En_Bairro = addr.bairro;
                            $scope.save_field('En_Bairro');

                            $scope.agent.En_Nome_Logradouro = addr.logradouro;
                            $scope.save_field('En_Nome_Logradouro');

                            $scope.agent.pais = "Brasil";
                            $scope.save_field('pais');

                            var string = (addr.logradouro ? addr.logradouro+', ':'') +
                                         (addr.bairro ? addr.bairro+', ':'') +
                                         (addr.localidade ? addr.localidade+', ':'') +
                                         (addr.uf ? addr.uf+' - ':'');

                        }

                        return geocoder.code(string);

                    }).then(function(point){
                        point.zoom = 14;
                        $scope.markers.main = point;
                    })['catch'](function(){
                        $scope.markers.main = undefined;
                    }).finally(function(){
                        $scope.cepcoder.busy = false;
                    });
                }
            };
        }
    ]);

    app.controller('PontoArticulacaoCtrl', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http',
        function PontoArticulacaoCtrl($scope, Entity, MapasCulturais, $timeout, $location, $http)
        {
            var agent_id = MapasCulturais.redeCulturaViva.agentePonto;
            var agent_id_entidade = MapasCulturais.redeCulturaViva.agenteEntidade;

            var params = {
                'id': agent_id,
                '@select': 'id,rcv_tipo,terms,participacaoMovPolitico,participacaoForumCultura,parceriaPoderPublico, simMovimentoPoliticoCultural, simForumCultural, simPoderPublico',
                '@permissions': 'view'
            };

            var params_entidade = {
                'id': agent_id_entidade,
                '@select': 'id,tipoPontoCulturaDesejado',
                '@permissions': 'view'
            };

            $scope.agent_entidade = Entity.get(params_entidade);

            $scope.termos = termos;

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_pontoArticulacao');
              }
            });

        }
    ]);

    app.controller('PontoEconomiaVivaCtrl', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http',
        function PontoEconomiaVivaCtrl($scope, Entity, MapasCulturais, $timeout, $location, $http)
        {
            var agent_id = MapasCulturais.redeCulturaViva.agentePonto;

            var params = {
                'id': agent_id,
                '@select': 'id,rcv_tipo,terms,pontoOutrosRecursosRede,pontoNumPessoasNucleo,pontoNumPessoasColaboradores,' +
                           'pontoNumPessoasIndiretas,pontoNumPessoasParceiros,pontoNumPessoasApoiadores,pontoNumRedes,' +
                           'pontoRedesDescricao,pontoMovimentos,pontoEconomiaSolidaria,pontoEconomiaSolidariaDescricao,' +
                           'pontoEconomiaCultura,pontoEconomiaCulturaDescricao,pontoMoedaSocial,pontoMoedaSocialDescricao,' +
                           'pontoTrocasServicos,pontoTrocasServicosOutros,pontoContrataServicos,pontoContrataServicosOutros,' +
                           'pontoInvestimentosColetivos,pontoInvestColetivosOutros,pontoCustoAnual',
                '@permissions': 'view'
            };

            $scope.termos = termos;

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_pontoEconomia');
              }
            });

        }
    ]);

    app.controller('PontoFormacaoCtrl', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http',
        function PontoFormacaoCtrl($scope, Entity, MapasCulturais, $timeout, $location, $http)
        {
            var agent_id = MapasCulturais.redeCulturaViva.agentePonto;

            var params = {
                'id': agent_id,
                '@select': 'id,rcv_tipo,terms,formador1_nome,formador1_email,formador1_telefone,formador1_operadora,formador1_areaAtuacao,' +
                    'formador1_bio,formador1_facebook,formador1_twitter,formador1_google,espacoAprendizagem1_atuacao,espacoAprendizagem1_tipo,' +
                    'espacoAprendizagem1_desc,metodologia1_nome,metodologia1_desc,metodologia1_necessidades,metodologia1_capacidade,' +
                    'metodologia1_cargaHoraria,metodologia1_certificacao,',
                '@permissions': 'view'
            };

            $scope.termos = termos;

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_pontoFormacao');
              }
            });

        }
    ]);

    app.controller('EntityCtrl', ['$scope', '$timeout', 'Entity', 'MapasCulturais', '$location', '$http', 'ngDialog',
        function($scope, $timeout, Entity, MapasCulturais, $location, $http, ngDialog){
            var agent_id = MapasCulturais.redeCulturaViva.agenteEntidade;


            var params = {
                'id': agent_id,

                '@select': 'id,rcv_tipo,name,nomeCompleto,cnpj,representanteLegal,' +
                    'tipoPontoCulturaDesejado,tipoOrganizacao,responsavel_operadora,responsavel_operadora2,' +
                    'emailPrivado,telefone1,telefone1_operadora,telefone2,telefone2_operadora,' +
                    'responsavel_nome,responsavel_email,responsavel_cargo,responsavel_telefone,responsavel_telefone2,' +
                    'geoEstado,geoMunicipio,pais,En_Bairro,En_Num,En_Nome_Logradouro,cep,En_Complemento',

                '@permissions': 'view'
            };

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_entity');
              }
            });

            $scope.closeAll = function () {
                ngDialog.close();
            };

            extendController($scope, $timeout, Entity, agent_id, $http);
            $scope.validaCNPJ = function(){
                if($scope.agent.cnpj.length === 0){
                    $scope.agent.cnpj = null;
                    $scope.save_field('cnpj');
                }else{
                    $http.get(MapasCulturais.createUrl('cadastro', 'validaCNPJ'),
                    {params: {
                        cnpj: $scope.agent.cnpj
                    }}).
                        success(function successCallback (sucesso){
                            if(sucesso.cdNaturezaJuridica.indexOf("1") === 0){
                                $scope.natuJuridica = sucesso.dsNaturezaJuridica;
                                ngDialog.open({
                                  template: 'modalNJ',
                                  scope: $scope
                                });
                            }
                            if((sucesso.cdNaturezaJuridica.indexOf("3") === 0) || (sucesso.cdNaturezaJuridica === "2143")){
                                $scope.save_field('cnpj');
                                $scope.messages.show('sucesso', 'alterações salvas');
                            }

                        }).error(function errorCallback (erro){
                            if(erro.data === "CNPJ invalido"){
                                ngDialog.open({
                                  template: 'modalCNPJInvalido',
                                  scope: $scope
                                });

                            }else if(erro.data === "CNPJ com fins lucrativos"){
                                ngDialog.open({
                                  template: 'modalFinsLucrativos',
                                  scope: $scope
                                });
                            }
                        });
                }
            };

        }
    ]);

    app.controller('EntityContactCtrl', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http',
        function($scope, Entity, MapasCulturais, $timeout, $location, $http){
            var agent_id = MapasCulturais.redeCulturaViva.agenteEntidade;

            var params = {
                'id': agent_id,

                '@select': 'id,rcv_tipo,tipoCertificacao,foiFomentado,tipoFomento,tipoFomentoOutros,tipoReconhecimento,edital_num,' +
                    'edital_ano,edital_projeto_nome,edital_localRealizacao,edital_projeto_etapa,' +
                    'edital_proponente,edital_projeto_resumo,edital_prestacaoContas_envio,' +
                    'edital_prestacaoContas_status,edital_projeto_vigencia_inicio,' +
                    'edital_projeto_vigencia_fim,outrosFinanciamentos,outrosFinanciamentos_descricao,' +
                    'rcv_Ds_Edital',

                '@permissions': 'view'
            };

            $scope.agent = Entity.get(params, function(){
              extendController($scope, $timeout, Entity, agent_id, $http);

              if($location.search().invalid === '1'){
                $scope.showInvalid($scope.agent.rcv_tipo, 'form_entityContact');
              }
            });

        }
  ]);

  app.controller('ConsultaCtrl', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http', '$q',
      function($scope, Entity, MapasCulturais, $timeout, $location, $http, $q){
          var agenteRes = [];
          var paramsFiltroResponsavel={
              '@select': 'id,user.id,parent.id,status,cnpj,name,rcv_tipo,cpf,nomeCompleto,emailPrivado,geoEstado,homologado_rcv',
              'rcv_tipo': 'OR(EQ(responsavel),EQ(ponto),EQ(entidade))'
          };
          $http.get("/api/agent/find",{
              params: paramsFiltroResponsavel
          }).success(function(dados){
               var agenteTodos = dados;
               dados.forEach(function(data){
                 if(data.rcv_tipo === 'responsavel'){
                       agenteRes.push(data);
                 }
               });
              agenteRes.forEach(function(respons){
                    agenteTodos.forEach(function(data){
                           if((respons.id === data.parent.id) && (data.rcv_tipo === "ponto")){
                                  respons.name = data.name;
                                  respons.geoEstado = data.geoEstado;
                                  respons.homologado_rcv = data.homologado_rcv;
                            }
                            if((respons.id === data.parent.id) && (data.rcv_tipo === "entidade")){
                                  respons.cnpj = data.cnpj;
                            }
                     });
              });
          });

  $scope.filtro = function(inputCPF,inputCNPJ,inputNameResponsavel,inputNamePonto,inputEmail,inputStatus,inputHomologado){
    var retornoFiltro = [];
    agenteRes.forEach(function(data){
      if((data.cpf === inputCPF) ^ (data.status == inputStatus) ^ (data.cnpj === inputCNPJ) ^ (data.emailPrivado === inputEmail) ^ (data.homologado_rcv === inputHomologado)){
        retornoFiltro.push(data);
      }

      if((data.name !== null) & (inputNamePonto !== undefined)){
        if(data.name.toLocaleLowerCase().indexOf(inputNamePonto.toLocaleLowerCase()) !== -1){
            if (retornoFiltro.length !== 0) {
              if(validaRetorno(retornoFiltro,data.id)){
                  retornoFiltro.push(data);
              }
            }else{
                  retornoFiltro.push(data);
            }
        }
      }
      if((data.nomeCompleto !== null) & (inputNameResponsavel !== undefined)){
        if(data.nomeCompleto.toLocaleLowerCase().indexOf(inputNameResponsavel.toLocaleLowerCase()) !== -1){
          if (retornoFiltro.length !== 0) {
            if(validaRetorno(retornoFiltro,data.id)){
                retornoFiltro.push(data);
            }
          }else{
                retornoFiltro.push(data);
          }
        }
      }
    });
    $scope.quantidade = retornoFiltro.length;
    if(retornoFiltro.length === 0){
      retornoFiltro = [{"name": "Não encontrado"}];
    }
    $scope.data = retornoFiltro;
    $scope.show = true;
    $scope.limpaFiltro();
  }

  function validaRetorno(retornoFiltro,idDado) {
    retornoFiltro.forEach(function(dados){
      if(dados.id === idDado){
        return false;
      }else{
        return true;
      }
    });
  }

  $scope.limpaFiltro = function(){
    $scope.inputCPF = undefined;
    $scope.inputCNPJ = undefined;
    $scope.inputEmail = undefined;
    $scope.inputNamePonto = undefined;
    $scope.inputNameResponsavel = undefined;
    $scope.inputStatus = undefined;
    $scope.inputHomologado = undefined;
  }

  $scope.filtroTopos = function(){
    $scope.quantidade = agenteRes.length;
    if(agenteRes.length === 0){
      agenteRes = [{"name": "Não encontrado"}];
    }
    $scope.data = agenteRes;
    $scope.show = true;
  }

  }]);

    app.controller('EntradaCtrl',['$scope', '$http', '$timeout', 'ngDialog', function($scope, $http, $timeout, ngDialog){
        $scope.data = {
            naoEncontrouCNPJ: false,
            encontrouCNPJ: false,
            cnpj: null,
            comCNPJ: false,
            buscandoCNPJ: false
        };
        extendController($scope, $timeout);
        $scope.consultaCNPJ = function(){
            $scope.data.buscandoCNPJ = true;
            $scope.messages.show('enviando', "Procurando CNPJ em nossa base");
            $http.get(MapasCulturais.apiCNPJ + '?action=get_cultura&cnpj=' + $scope.data.cnpj).
                success(function success(data){
                    if(data.Id){
                        $scope.registrar();
                        $scope.data.encontrouCNPJ = $scope.data.cnpj;
                    }else{
                        $scope.data.encontrouCNPJ = false;
                        ngDialog.open({
                          template: 'modalErro',
                          scope: $scope
                        });
                        $scope.data.encontrouCNPJ = $scope.data.cnpj;
                    }
                });
        };

        $scope.validaCNPJ = function(){
          $http.get(MapasCulturais.createUrl('cadastro', 'validaCNPJ'),
          {params: {
              cnpj: $scope.data.cnpj
          }}).
              success(function successCallback (sucesso){
                if(sucesso.cdNaturezaJuridica.indexOf("1") === 0){
                    $scope.natuJuridica = sucesso.dsNaturezaJuridica;
                    ngDialog.open({
                      template: 'modalNJ',
                      scope: $scope
                    });
                }else{
                    $scope.consultaCNPJ();
                }

             }).error(function errorCallback (erro){
                if(erro.data === "CNPJ invalido"){
                    ngDialog.open({
                      template: 'modalCNPJInvalido',
                      scope: $scope
                    });

                }else if(erro.data === "CNPJ com fins lucrativos"){
                    ngDialog.open({
                      template: 'modalFinsLucrativos',
                      scope: $scope

                    });
                }
             });
        };

        $scope.closeAll = function () {
            ngDialog.close();
        };


        $scope.registrar = function(){
            var data = {};
            if($scope.data.comCNPJ){
                data.comCNPJ = 1;
                if($scope.data.encontrouCNPJ){
                    data.CNPJ = $scope.data.encontrouCNPJ;
                }else{
                    data.CNPJ = $scope.data.cnpj;
                }
            }

            $scope.messages.show('enviando', "Registrando na rede");

            $http.post(MapasCulturais.createUrl('cadastro','registra'), data).
                    success(function(){
                        $scope.messages.show('sucesso', "Registrado com sucesso");
                        document.location = MapasCulturais.createUrl('cadastro','index');
                    }).
                    error(function(){
                        $scope.messages.show('erro', "Um erro inesperado aconteceu");
                        $scope.data.buscandoCNPJ = false;
                    });
        };
    }]);

    app.controller('ValidaCNPJCadastrados', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http',
        function($scope, Entity, MapasCulturais, $timeout, $location, $http){
            var cnpj = [];
            var retorno = [];
            var paramsCNPJ={
                '@select': 'id,parent.id,cnpj,rcv_tipo',
                'rcv_tipo': 'EQ(entidade)'
            };
            $http.get("/api/agent/find",{
                params: paramsCNPJ
            }).success(function(dados){
                dados.forEach(function(data){
                    if(data.cnpj !== null){
                        cnpj.push(data.cnpj);
                    }
                });

                cnpj.forEach(function(data, i){
                    $http.get(MapasCulturais.createUrl('cadastro', 'buscaNaturezaJuridica'),
                        {params: {
                            cnpj: data
                    }}).
                        success(function successCallback (sucesso){
                            retorno[i]={cnpj: data, naturezaJuridica: sucesso.substr(1, 4)};
                        });
                });
            });
            $scope.data = retorno;
            $scope.exportar = function(){
                var blob = new Blob([document.getElementById('table').innerHTML], {
                           type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
                       });
                   saveAs(blob, "Tabela.xls");
           };
        }
    ]);

    app.controller('DetailCtrl',['$scope', 'Entity', 'MapasCulturais', '$http', '$timeout', '$location', function($scope, Entity, MapasCulturais, $http, $timeout, $location){
        extendController($scope, $timeout);
        $scope.termos = termos;
        var url = document.URL;
        var posicao = url.slice(url.lastIndexOf("/") + 1);
        $http.get(MapasCulturais.createUrl('admin','user') + posicao)
            .success(function(data){
		        var rcv = JSON.parse(data.redeCulturaViva);
                var responsavel = {
                    'id': rcv.agenteIndividual,
                    '@select': 'id,rcv_tipo,files,singleUrl,name,rg,rg_orgao,relacaoPonto,pais,cpf,geoEstado,terms,'+
                               'emailPrivado,telefone1,telefone1_operadora,nomeCompleto,'+
                               'geoMunicipio,facebook,twitter,googleplus,telegram,whatsapp,culturadigital,diaspora,instagram,mesmoEndereco,shortDescription',
                    '@permissions': 'view'
                };
                var entidade = {
                    'id': rcv.agenteEntidade,
                    '@select':  'id,rcv_tipo,files,name,nomeCompleto,cnpj,representanteLegal,' +
                                'tipoPontoCulturaDesejado,tipoOrganizacao,' +
                                'emailPrivado,telefone1,telefone1_operadora,telefone2,telefone2_operadora,' +
                                'responsavel_nome,responsavel_email,responsavel_cargo,responsavel_telefone,' +
                                'geoEstado,geoMunicipio,pais,En_Bairro,En_Num,En_Nome_Logradouro,En_Complemento,' +
                                'tipoCertificacao,foiFomentado,tipoFomento,tipoFomentoOutros,tipoReconhecimento,edital_num,' +
                                'edital_ano,edital_projeto_nome,edital_localRealizacao,edital_projeto_etapa,' +
                                'edital_proponente,edital_projeto_resumo,edital_prestacaoContas_envio,' +
                                'edital_prestacaoContas_status,edital_projeto_vigencia_inicio,' +
                                'edital_projeto_vigencia_fim,outrosFinanciamentos,outrosFinanciamentos_descricao,' +
                                'rcv_Ds_Edital',
                    '@permissions': 'view'
                };
                var ponto = {
                    'id': rcv.agentePonto,
                    '@select':  'id,rcv_tipo,files,longDescription,atividadesEmRealizacaoLink,site,facebook,twitter,googleplus,flickr,diaspora,youtube,instagram,culturadigital,atividadesEmRealizacaoLink,' +
                                'terms,name,shortDescription,cep,tem_sede,sede_realizaAtividades,mesmoEndereco,pais,geoEstado,geoMunicipio,'+
                                'En_Bairro,En_Num,En_Nome_Logradouro,En_Complemento,localRealizacao_estado,localRealizacao_cidade,'+
                                'localRealizacao_cidade,localRealizacao_espaco,location,' +
		                        'participacaoMovPolitico,participacaoForumCultura,parceriaPoderPublico, simMovimentoPoliticoCultural, simForumCultural, simPoderPublico,' +
		                        'pontoOutrosRecursosRede,pontoNumPessoasNucleo,pontoNumPessoasColaboradores,' +
                                'pontoNumPessoasIndiretas,pontoNumPessoasParceiros,pontoNumPessoasApoiadores,pontoNumRedes,' +
                                'pontoRedesDescricao,pontoMovimentos,pontoEconomiaSolidaria,pontoEconomiaSolidariaDescricao,' +
                                'pontoEconomiaCultura,pontoEconomiaCulturaDescricao,pontoMoedaSocial,pontoMoedaSocialDescricao,' +
                                'pontoTrocasServicos,pontoTrocasServicosOutros,pontoContrataServicos,pontoContrataServicosOutros,' +
                                'pontoInvestimentosColetivos,pontoInvestColetivosOutros,pontoCustoAnual,' +
		                        'formador1_nome,formador1_email,formador1_telefone,formador1_operadora,formador1_areaAtuacao,' +
                                'formador1_bio,formador1_facebook,formador1_twitter,formador1_google,espacoAprendizagem1_atuacao,espacoAprendizagem1_tipo,' +
                                'espacoAprendizagem1_desc,metodologia1_nome,metodologia1_desc,metodologia1_necessidades,metodologia1_capacidade,' +
                                'metodologia1_cargaHoraria,metodologia1_certificacao,homologado_rcv',
                    '@permissions': 'view'
                };

                var agent = {
                    'id': rcv.agentePonto,
                    '@select':  'id,homologado_rcv',
                    '@permissions': 'view'
                };

                $scope.responsavel = Entity.get(responsavel);
                $scope.entidade = Entity.get(entidade);
                $scope.ponto = Entity.get(ponto);
                $scope.agent = Entity.get(agent, function(){
                  extendController($scope, $timeout, Entity, rcv.agentePonto, $http);
                });


            }).error(function(){
                $scope.messages.show('erro', "O usuário não foi encontrado");
            });
    }]);

    app.controller('layoutPDFCtrl', ['$scope', 'Entity', 'MapasCulturais', '$timeout', '$location', '$http',
        function($scope, Entity, MapasCulturais, $timeout, $location, $http){
            var agent_id = MapasCulturais.redeCulturaViva.agentePonto;
            var aux = 'culturaviva.gov.br/agente/';

            $scope.urlQRCODE = null;

            var params = {
                '@select': 'id,name,user.id,homologado_rcv',
                '@permissions': 'view',
                'id': 'EQ('+agent_id+')'
            };

             $http.get("/api/agent/find",{
                 params: params
             }).success(function(dados){
                window.name = dados[0].name;
                window.url = aux.concat(dados[0].user.id);
                $scope.urlQRCODE = window.url;
                $scope.show = dados[0].homologado_rcv;
            });
    }]);

})(angular);

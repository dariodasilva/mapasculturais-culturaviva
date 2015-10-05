<?php

$config['routes']['default_controller_id'] = 'rede';
$config['routes']['shortcuts']['busca'] = ['site', 'search'];
$config['auth.config']['onCreateRedirectUrl'] = $config['base.url'] . 'rede/entrada/';

return [
    'app.siteName' => 'Rede Cultura Viva',
    'app.siteDescription' => '',
    'rcv.apiCNPJ' => 'http://culturaviva.gov.br/wp-admin/admin-ajax.php',

    'redeCulturaViva.projectId' => 1,
    'registration.ownerDefinition' => [
        'required' => true,
        'label' => 'Agente responsável pelo ponto de cultura',
        'agentRelationGroupName' => 'owner',
        'description' => 'Agente individual',
        'type' => 1,
        'requiredProperties' => []
    ],
    'registration.agentRelations' => [
        [
            'required' => false,
            'label' => 'Entidade',
            'agentRelationGroupName' => 'entidade',
            'description' => 'Agente coletivo (Entidade)',
            'type' => 2,
            'requiredProperties' => []
        ],
        [
            'required' => false,
            'label' => 'Ponto/Pontão de Cultura',
            'agentRelationGroupName' => 'ponto',
            'description' => 'Agente coletivo (Ponto/Pontão de Cultura)',
            'type' => 2,
            'requiredProperties' => []
        ]
    ],
    'registration.propertiesToExport' => array(
        'id',
        'name',
        'nomeCompleto',
        'En_Bairro',
        'En_Complemento',
        'En_Nome_Logradouro',
        'En_Num',
        'atividadesEmRealizacao',
        'cep',
        'cnpj',
        'cpf',
        'createTimestamp',
        'dataDeNascimento',
        'diaspora',
        'documento',
        'edital_ano',
        'edital_localRealizacao',
        'edital_num',
        'edital_prestacaoContas_envio',
        'edital_prestacaoContas_status',
        'edital_projeto_etapa',
        'edital_projeto_nome',
        'edital_projeto_resumo',
        'edital_projeto_vigencia_fim',
        'edital_projeto_vigencia_inicio',
        'edital_proponente',
        'emailPrivado',
        'emailPrivado2',
        'emailPrivado3',
        'emailPublico',
        'endereco',
        'espacoAprendizagem1_atuacao',
        'espacoAprendizagem1_desc',
        'espacoAprendizagem1_tipo',
        'facebook',
        'flickr',
        'foiFomentado',
        'formador1_areaAtuacao',
        'formador1_bio',
        'formador1_email',
        'formador1_facebook',
        'formador1_google',
        'formador1_nome',
        'formador1_operadora',
        'formador1_telefone',
        'formador1_twitter',
        'genero',
        'geoEstado',
        'geoMunicipio',
        'googleplus',
        'idade',
        'isVerified',
        'localRealizacao_cidade',
        'localRealizacao_estado',
        'local_de_acao_espaco',
        'localizacao',
        'location',
        'longDescription',
        'metodologia1_capacidade',
        'metodologia1_cargaHoraria',
        'metodologia1_certificacao',
        'metodologia1_desc',
        'metodologia1_necessidades',
        'metodologia1_nome',
        'metodologia1_tipo',
        'outrosFinanciamentos',
        'outrosFinanciamentos_descricao',
        'parceriaPoderPublico',
        'participacaoForumCultura',
        'participacaoMovPolitico',
        'pontoContrataServicos',
        'pontoContrataServicosOutros',
        'pontoCustoAnual',
        'pontoEconomiaCultura',
        'pontoEconomiaCulturaDescricao',
        'pontoEconomiaSolidaria',
        'pontoEconomiaSolidariaDescricao',
        'pontoInvestColetivosOutros',
        'pontoInvestimentosColetivos',
        'pontoMoedaSocial',
        'pontoMoedaSocialDescricao',
        'pontoMovimentos',
        'pontoNumPessoasApoiadores',
        'pontoNumPessoasColaboradores',
        'pontoNumPessoasIndiretas',
        'pontoNumPessoasNucleo',
        'pontoNumPessoasParceiros',
        'pontoNumRedes',
        'pontoOutrosRecursosRede',
        'pontoRedesDescricao',
        'pontoTrocasServicos',
        'pontoTrocasServicosOutros',
        'precisao',
        'raca',
        'rcv_Cod_pronac',
        'rcv_Cod_salic',
        'rcv_Cod_scdc',
        'rcv_Ds_Edital',
        'rcv_Ds_Tipo_Ponto',
        'rcv_Id_Tipo_Esfera',
        'rcv_sede_spaceId',
        'relacaoPonto',
        'representanteLegal',
        'responsavel_cargo',
        'responsavel_email',
        'responsavel_nome',
        'responsavel_telefone',
        'rg',
        'rg_orgao',
        'sede_cnpj',
        'sede_realizaAtividades',
        'semCNPJ',
        'shortDescription',
        'site',
        'status',
        'telefone1',
        'telefone1_operadora',
        'telefone2',
        'telefone2_operadora',
        'telefonePublico',
        'tem_sede',
        'tipoCertificacao',
        'tipoFomento',
        'tipoFomentoOutros',
        'tipoOrganizacao',
        'tipoPontoCulturaDesejado',
        'tipoReconhecimento',
        'twitter',
        'type',
        'youtube'
    ),
];

<div  >
    <div class="form">
        <div class="row">
            <span><b> * Campos Obrigatórios </b></span>
        </div>
        <!-- <h4>Informações Obrigatórias</h4> -->
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Tipo de organização*</span>
                <span><b>{{entidade.tipoOrganizacao}}</b></span>
                <span ng-if="!entidade.tipoOrganizacao"><b>Não informado</b></span>
            </label>
            <label class="colunm-50" ng-show="entidade.tipoOrganizacao">
                <span class="destaque">Quero ser*</span>
                <span><b>{{entidade.tipoPontoCulturaDesejado}}</b></span>
                <span ng-if="!entidade.tipoPontoCulturaDesejado"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>

        <div ng-show="entidade.tipoOrganizacao==='coletivo'">
            <div class="row">
                <label class="colunm-50">
                    <span class="destaque">Nome do Coletivo Cultural*</span>
                    <span><b>{{entidade.name}}</b></span>
                    <span ng-if="!entidade.name"><b>Não informado</b></span>
                </label>
            </div>
            <div class="clear"></div>
        </div>

        <div ng-show="entidade.tipoOrganizacao">
            <div ng-show="entidade.tipoOrganizacao==='entidade'">
                <div class="row">
                    <label class="colunm-50">
                        <span class="destaque"><b>CNPJ da Entidade*</b></span>
                        <span><b>{{entidade.cnpj}}</b></span>
                    <label class="colunm-50">
                        <span class="destaque">Nome da Razão Social da Entidade*</span>
                        <span><b>{{entidade.nomeCompleto}}</b></span>
                        <span ng-if="!entidade.nomeCompleto"><b>Não informado</b></span>
                    </label>
                </div>

                <div class="clear"></div>
                <div class="row">
                    <label class="colunm-50">
                        <span class="destaque">Nome do Representante Legal*</span>
                        <span><b>{{entidade.representanteLegal}}</b></span>
                        <span ng-if="!entidade.representanteLegal"><b>Não informado</b></span>
                    </label>

                    <label class="colunm-50">
                        <span class="destaque">Nome Fantasia*</span>
                        <span><b>{{entidade.name}}</b></span>
                        <span ng-if="!entidade.name"><b>Não informado</b></span>
                    </label>
                </div>
                <div class="clear"></div>
                <?php /*
                <div class="row">
                    <label class="colunm-50">
                        <span class="destaque">Tipo de Certificação* <i>?</i></span>
                        <select name="tipoCertificacao"
                                ng-change="save_field('tipoCertificacao')"
                                ng-model="entidade.tipoCertificacao">
                            <option value="ponto_coletivo">Ponto de Cultura - Grupo ou Coletivo</option>
                            <option value="ponto_entidade">Ponto de Cultura - Entidade</option>
                            <option value="pontao_entidade">Pontão de Cultura - Entidade</option>
                        </select>
                    </label>
                </div>
                <div class="clear"></div>
                */ ?>
            </div>
        </div>

        <div class="row">
            <label class="colunm1">
                <span class="destaque">Nome do Responsável pela Entidade/Coletivo*</span>
                <span><b>{{entidade.responsavel_nome}}</b></span>
                <span ng-if="!entidade.responsavel_nome"><b>Não informado</b></span>
            </label>

            <label class="colunm2">
                <span>Cargo do Responsável*</span>
                <span><b>{{entidade.responsavel_cargo}}</b></span>
                <span ng-if="!entidade.responsavel_cargo"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span>Email do Responsável*</span>
                <span><b>{{entidade.responsavel_email}}</b></span>
                <span ng-if="!entidade.responsavel_email"><b>Não informado</b></span>
            </label>

            <label class="colunm2">
                <span>Telefone do Responsável*</span>
                <span><b>{{entidade.responsavel_telefone}}</b></span>
                <span ng-if="!entidade.responsavel_telefone"><b>Não informado</b></span>
            </label>
            <label class="colunm02">
                <span>Operadora</span>
                <span><b>{{entidade.responsavel_operadora}}</b></span>
                <span ng-if="!entidade.responsavel_operadora"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>

        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Email institucional da Entidade/Coletivo*</span>
                <span><b>{{entidade.emailPrivado}}</b></span>
                <span ng-if="!entidade.emailPrivado"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm05">
                <span>Telefone institucional da Entidade/Coletivo*</span>
                <span><b>{{entidade.telefone1}}</b></span>
                <span ng-if="!entidade.telefone1"><b>Não informado</b></span>
            </label>

            <label class="colunm02">
                <span>Operadora</span>
                <span><b>{{entidade.telefone1_operadora}}</b></span>
                <span ng-if="!entidade.telefone1_operadora"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm05">
                <span>Outro Telefone</span>
                <span><b>{{entidade.telefone2}}</b></span>
                <span ng-if="!entidade.telefone2"><b>Não informado</b></span>
            </label>

            <label class="colunm02">
                <span>Operadora</span>
                <span><b>{{entidade.telefone2_operadora}}</b></span>
                <span ng-if="!entidade.telefone2_operadora"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>

        <div class="row">
            <label class="colunm1">
                <span class="destaque">Endereço da Entidade/Coletivo*</span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
          <label class="colunm05">
            <span>País*</span>
            <span><b>{{entidade.pais}}</b></span>
            <span ng-if="!entidade.pais"><b>Não informado</b></span>
          </label>
            <label class="colunm05" ng-show="entidade.pais==='Brasil'">
                <span>Estado</span>
                <span><b>{{entidade.geoEstado}}</b></span>
                <span ng-if="!entidade.geoEstado"><b>Não informado</b></span>
            </label>
            <label class="colunm2">
                <span>Cidade</span>
                <span><b>{{entidade.geoMunicipio}}</b></span>
                <span ng-if="!entidade.geoMunicipio"><b>Não informado</b></span>
            </label>
            <label class="colunm3">
                <span>Bairro</span>
                <span><b>{{entidade.En_Bairro}}</b></span>
                <span ng-if="!entidade.En_Bairro"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
          <label class="colunm05">
              <span>Rua</span>
              <span><b>{{entidade.En_Nome_Logradouro}}</b></span>
              <span ng-if="!entidade.En_Nome_Logradouro"><b>Não informado</b></span>
          </label>
            <label class="colunm2">
                <span>Número</span>
                <span><b>{{entidade.En_Num}}</b></span>
                <span ng-if="!entidade.En_Num"><b>Não informado</b></span>
            </label>
            <label class="colunm3">
                <span>Complemento</span>
                <span><b>{{entidade.En_Complemento}}</b></span>
                <span ng-if="!entidade.En_Complemento"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
    </div>
</div>

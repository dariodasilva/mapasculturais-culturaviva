<?php
    $this->bodyProperties['ng-app'] = "culturaviva";
    $this->layout = 'cadastro';
    $this->cadastroTitle = '2. Dados da Entidade ou Coletivo Cultural';
    $this->cadastroText = 'Inclua os dados da Entidade ou Coletivo Cultural responsável pelo Ponto de Cultura';
    $this->cadastroIcon = 'icon-home';
    $this->cadastroPageClass = 'dados-entidade page-base-form';
    $this->cadastroLinkContinuar = 'pontoMapa';
?>


<form name="form_entity" ng-controller="EntityCtrl">
    <?php $this->part('messages'); ?>
    <div class="form">
        <h4>Informações Obrigatórias</h4>
        <div class="row">
            <label class="colunm1" ng-show="agent.tipoOrganizacao">
                <span class="destaque">Quero ser*</span>
                <select name="tipoPontoCulturaDesejado"
                        ng-change="save_field('tipoPontoCulturaDesejado')"
                        ng-model="agent.tipoPontoCulturaDesejado">
                    <option value="ponto">Ponto de Cultura</option>
                    <option value="pontao">Pontão de Cultura</option>
                </select>
            </label>
            <label class="colunm-50">
                <span class="destaque">Tipo de organização*</span>
                <select name="tipoOrganizacao"
                        ng-change="save_field('tipoOrganizacao')"
                        ng-model="agent.tipoOrganizacao"
                        ng-disabled="agent.tipoPontoCulturaDesejado == 'pontao'">
                    <option ng-if="agent.tipoPontoCulturaDesejado != 'pontao'" value="coletivo">Coletivo Cultural (CPF)</option>
                    <option value="entidade">Entidade (CNPJ)</option>
                </select>
            </label>
        </div>
        <div class="clear"></div>

        <div ng-show="agent.tipoOrganizacao==='coletivo'">
            <div class="row">
                <label class="colunm1">
                    <span class="destaque">Nome do Coletivo Cultural* <i class='hltip' title='Nome dado ao grupo que compõe o coletivo cultural'>?</i>
                    </span>
                    <input name="name" type="text" ng-blur="save_field('name')" ng-model="agent.name">
                </label>
            </div>
            <div class="clear"></div>
        </div>

        <div ng-show="agent.tipoOrganizacao">
            <div ng-show="agent.tipoOrganizacao==='entidade'">
                <div class="row">
                    <label class="colunm1">
                        <span class="destaque">CNPJ da Entidade*</span>
                        <input name="cnpj"
                               type="text"
                               ng-blur="validaCNPJ()"
                               ng-model="agent.cnpj"
                               ui-mask="99.999.999/9999-99">
                    </label>
                    <script type="text/ng-template" id="modalNJ">
                      <h4><b>{{natuJuridica}}</b></h4>
                      <p style="font-size: 13px;"><b>Identificamos que seu CNPJ está relacionado a órgãos ou entidades públicas. Para poder receber a certificação sua instituição deve ser qualificada como Instituição Pública de Ensino.</b></p>
                      <a style="color: red;" ng-click="save_field('cnpj'); closeAll()">Continuar</a>
                      <a href="http://culturaviva.gov.br/saiba-mais/#quais-os-criterios" style="color: red; float: right;" target="_blank">Critérios</a>
                    </script>
                    <script type="text/ng-template" id="modalCNPJInvalido">
                        <p style="font-size: 15px;"><b>CNPJ informado é invalido!</b></p>
                        <a style="color: red;" ng-click="closeAll()">Corrigir</a>
                    </script>
                    <script type="text/ng-template" id="modalFinsLucrativos">
                        <h4><b>CNPJ com fins lucrativos</b></h4>
                        <p style="font-size: 13px;"><b>Sua instituição foi identificada com Natureza Jurídica de fins lucrativos. Para se habilitar no processo de certificação sua instituição deve ser sem fins lucrativos.</b></p>
                        <a style="color: red;" ng-click="closeAll()">Ok</a>
                        <a href="http://culturaviva.gov.br/saiba-mais/#quais-os-criterios" style="color: red; float: right;" target="_blank">Critérios</a>
                    </script>
                    <label class="colunm-50">
                        <span class="destaque">Nome da Razão Social da Entidade*</span>
                        <input name="nomeCompleto"
                               type="text"
                               ng-blur="save_field('nomeCompleto')"
                               ng-model="agent.nomeCompleto">
                    </label>
                </div>

                <div class="clear"></div>
                <div class="row">
                    <label class="colunm1">
                        <span class="destaque">Nome do Representante Legal* <i class='hltip' title='Pessoa que está habilitada juridicamente a representar a entidade'>?</i></span>
                        <input name="representanteLegal" type="text" ng-blur="save_field('representanteLegal')" ng-model="agent.representanteLegal" >
                    </label>

                    <label class="colunm-50">
                        <span class="destaque">Nome Fantasia* <i class='hltip' title='Nome da entidade, tal como se reconhece e é reconhecida junto à comunidade'>?</i></span>
                        </span>
                        <div ng-messages="agent.name.$error" style="color:maroon" role="alert">
                            <div ng-message="required">You did not enter a field</div>
                            <div ng-message="minlength">Your field is too short</div>
                            <div ng-message="maxlength">Your field is too long</div>
                        </div>
                        <input type="text" ng-blur="save_field('name')" ng-model="agent.name" >
                    </label>
                </div>
                <div class="clear"></div>
                <?php /*
                <div class="row">
                    <label class="colunm-50">
                        <span class="destaque">Tipo de Certificação* <i>?</i></span>
                        <select name="tipoCertificacao"
                                ng-change="save_field('tipoCertificacao')"
                                ng-model="agent.tipoCertificacao">
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
                <span class="destaque">Nome do Responsável {{agent.tipoOrganizacao == 'coletivo' ? 'pelo Coletivo' : 'pela Entidade'}}* <i class='hltip' title='Pessoa que representa o Ponto de Cultura'>?</i></span>
                <input name="responsavel_nome" type="text" ng-blur="save_field('responsavel_nome')" ng-model="agent.responsavel_nome" />
            </label>

            <label class="colunm05">
                <span class="destaque">Cargo do Responsável*</span>
                <input name="responsavel_cargo" type="text" ng-blur="save_field('responsavel_cargo')" ng-model="agent.responsavel_cargo"/>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Email do Responsável* </span>
                <input name="responsavel_email" type="email" ng-blur="save_field('responsavel_email')" ng-model="agent.responsavel_email" />
            </label>

            <label class="colunm05">
                <span class="destaque">Telefone do Responsável*</span>
                <input name="responsavel_telefone" type="text" ng-blur="save_field('responsavel_telefone')" ng-model="agent.responsavel_telefone" ui-mask="(99) ?99999-9999"/>
            </label>
            <label class="colunm02">
                <span class="destaque">Operadora</span>
                <input name="responsavel_operadora" type="text" ng-blur="save_field('responsavel_operadora')" ng-model="agent.responsavel_operadora">
            </label><label class="colunm2">
                <span class="destaque">Outro Telefone </span>
                <input type="text" name="responsavel_telefone2" ng-blur="save_field('responsavel_telefone2')" ng-model="agent.responsavel_telefone" ui-mask="(99) ?99999 9999">
            </label>

            <label class="colunm3">
                <span class="destaque">Operadora</span>
                <input type="text" name="responsavel_operadora2" ng-blur="save_field('responsavel_operadora2')" ng-model="agent.responsavel_operadora2">
            </label>
        </div>
        <div class="clear"></div>

        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Email institucional {{agent.tipoOrganizacao == 'coletivo' ? 'do Coletivo' : 'da Entidade'}} *</span>
                <input name="emailPrivado" type="email" ng-blur="save_field('emailPrivado')" ng-model="agent.emailPrivado" />
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1" style="width:300px;">
                <span class="destaque">Telefone institucional {{agent.tipoOrganizacao == 'coletivo' ? 'do Coletivo' : 'da Entidade'}} *</span>
                <input name="telefone1" type="text" ng-blur="save_field('telefone1')" ng-model="agent.telefone1" ui-mask="(99) ?99999-9999">
            </label>

            <label class="colunm02">
                <span class="destaque">Operadora</span>
                <input name="telefone1_operadora" type="text" ng-blur="save_field('telefone1_operadora')" ng-model="agent.telefone1_operadora">
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1" style="width:300px;">
                <span class="destaque">Outro Telefone</span>
                <input type="text" ng-blur="save_field('telefone2')" ng-model="agent.telefone2" ui-mask="(99) ?99999-9999">
            </label>

            <label class="colunm02">
                <span class="destaque">Operadora</span>
                <input type="text" ng-blur="save_field('telefone2_operadora')" ng-model="agent.telefone2_operadora">
            </label>
        </div>
        <div class="clear"></div>

        <div class="row">
            <label class="colunm1">
                <span class="destaque">Endereço  {{agent.tipoOrganizacao == 'coletivo' ? 'do Coletivo' : 'da Entidade'}}* <i class='hltip' title='Endereço atrelado ao CNPJ (não precisa ser o mesmo endereço do Ponto de Cultura)'>?</i></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
          <label class="colunm2">
            <span class="destaque">País*</span>
              <select name="pais" ng-blur="save_field('pais')" ng-model="agent.pais">
                <option value="Brasil" selected>Brasil</option>
                <option value="África do Sul">África do Sul</option>      <option value="Albânia">Albânia</option>
                <option value="Alemanha">Alemanha</option>                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>                    <option value="Anguilla">Anguilla</option>
                <option value="Antigua">Antigua</option>                  <option value="Arábia Saudita">Arábia Saudita</option>
                <option value="Argentina">Argentina</option>              <option value="Armênia">Armênia</option>
                <option value="Aruba">Aruba</option>                      <option value="Austrália">Austrália</option>
                <option value="Áustria">Áustria</option>                  <option value="Azerbaijão">Azerbaijão</option>
                <option value="Bahamas">Bahamas</option>                  <option value="Bahrein">Bahrein</option>
                <option value="Bangladesh">Bangladesh</option>            <option value="Barbados">Barbados</option>
                <option value="Bélgica">Bélgica</option>                  <option value="Benin">Benin</option>
                <option value="Bermudas">Bermudas</option>                <option value="Botsuana">Botsuana</option>
                <option value="Brunei">Brunei</option>
                <option value="Bulgária">Bulgária</option>                <option value="Burkina Fasso">Burkina Fasso</option>
                <option value="Cabo Verde">Cabo Verde</option>
                <option value="Camarões">Camarões</option>                <option value="Camboja">Camboja</option>
                <option value="Canadá">Canadá</option>                    <option value="Cazaquistão">Cazaquistão</option>
                <option value="Chade">Chade</option>                      <option value="Chile">Chile</option>
                <option value="China">China</option>                      <option value="Cidade do Vaticano">Cidade do Vaticano</option>
                <option value="Colômbia">Colômbia</option>                <option value="Congo">Congo</option>
                <option value="Coréia do Sul">Coréia do Sul</option>      <option value="Costa do Marfim">Costa do Marfim</option>
                <option value="Costa Rica">Costa Rica</option>            <option value="Croácia">Croácia</option>
                <option value="Dinamarca">Dinamarca</option>              <option value="Djibuti">Djibuti</option>
                <option value="Dominica">Dominica</option>                <option value="EUA">EUA</option>
                <option value="Egito">Egito</option>                      <option value="El Salvador">El Salvador</option>
                <option value="Emirados Árabes">Emirados Árabes</option>      <option value="Equador">Equador</option>
                <option value="Eritréia">Eritréia</option>                <option value="Escócia">Escócia</option>
                <option value="Eslováquia">Eslováquia</option>            <option value="Eslovênia">Eslovênia</option>
                <option value="Espanha">Espanha</option>                  <option value="Estônia">Estônia</option>
                <option value="Etiópia">Etiópia</option>                  <option value="Fiji">Fiji</option>
                <option value="Filipinas">Filipinas</option>              <option value="Finlândia">Finlândia</option>
                <option value="França">França</option>                    <option value="Gabão">Gabão</option>
                <option value="Gâmbia">Gâmbia</option>                    <option value="Gana">Gana</option>
                <option value="Geórgia">Geórgia</option>                  <option value="Gibraltar">Gibraltar</option>
                <option value="Granada">Granada</option>                  <option value="Grécia">Grécia</option>
                <option value="Guadalupe">Guadalupe</option>              <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>              <option value="Guiana">Guiana</option>
                <option value="Guiana Francesa">Guiana Francesa</option>      <option value="Guiné-bissau">Guiné-bissau</option>
                <option value="Haiti">Haiti</option>                      <option value="Holanda">Holanda</option>
                <option value="Honduras">Honduras</option>                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungria">Hungria</option>                  <option value="Iêmen">Iêmen</option>
                <option value="Ilhas Cayman">Ilhas Cayman</option>        <option value="Ilhas Cook">Ilhas Cook</option>
                <option value="Ilhas Curaçao">Ilhas Curaçao</option>      <option value="Ilhas Marshall">Ilhas Marshall</option>
                <option value="Ilhas Turks & Caicos">Ilhas Turks & Caicos</option>      <option value="Ilhas Virgens (brit.)">Ilhas Virgens (brit.)</option>
                <option value="Ilhas Virgens(amer.)">Ilhas Virgens(amer.)</option>      <option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
                <option value="Índia">Índia</option>                     <option value="Indonésia">Indonésia</option>
                <option value="Inglaterra">Inglaterra</option>           <option value="Irlanda">Irlanda</option>
                <option value="Islândia">Islândia</option>               <option value="Israel">Israel</option>
                <option value="Itália">Itália</option>                   <option value="Jamaica">Jamaica</option>
                <option value="Japão">Japão</option>                     <option value="Jordânia">Jordânia</option>
                <option value="Kuwait">Kuwait</option>                   <option value="Latvia">Latvia</option>
                <option value="Líbano">Líbano</option>                   <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lituânia">Lituânia</option>               <option value="Luxemburgo">Luxemburgo</option>
                <option value="Macau">Macau</option>                     <option value="Macedônia">Macedônia</option>
                <option value="Madagascar">Madagascar</option>           <option value="Malásia">Malásia</option>
                <option value="Malaui">Malaui</option>                   <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>                     <option value="Marrocos">Marrocos</option>
                <option value="Martinica">Martinica</option>             <option value="Mauritânia">Mauritânia</option>
                <option value="Mauritius">Mauritius</option>             <option value="México">México</option>
                <option value="Moldova">Moldova</option>                 <option value="Mônaco">Mônaco</option>
                <option value="Montserrat">Montserrat</option>           <option value="Nepal">Nepal</option>
                <option value="Nicarágua">Nicarágua</option>             <option value="Niger">Niger</option>
                <option value="Nigéria">Nigéria</option>                 <option value="Noruega">Noruega</option>
                <option value="Nova Caledônia">Nova Caledônia</option>      <option value="Nova Zelândia">Nova Zelândia</option>
                <option value="Omã">Omã</option>                         <option value="Palau">Palau</option>
                <option value="Panamá">Panamá</option>                   <option value="Papua-nova Guiné">Papua-nova Guiné</option>
                <option value="Paquistão">Paquistão</option>             <option value="Peru">Peru</option>
                <option value="Polinésia Francesa">Polinésia Francesa</option>      <option value="Polônia">Polônia</option>
                <option value="Porto Rico">Porto Rico</option>           <option value="Portugal">Portugal</option>
                <option value="Qatar">Qatar</option>                     <option value="Quênia">Quênia</option>
                <option value="Rep. Dominicana">Rep. Dominicana</option>      <option value="Rep. Tcheca">Rep. Tcheca</option>
                <option value="Reunion">Reunion</option>                <option value="Romênia">Romênia</option>
                <option value="Ruanda">Ruanda</option>                  <option value="Rússia">Rússia</option>
                <option value="Saipan">Saipan</option>                  <option value="Samoa Americana">Samoa Americana</option>
                <option value="Senegal">Senegal</option>                <option value="Serra Leone">Serra Leone</option>
                <option value="Seychelles">Seychelles</option>          <option value="Singapura">Singapura</option>
                <option value="Síria">Síria</option>                    <option value="Sri Lanka">Sri Lanka</option>
                <option value="St. Kitts & Nevis">St. Kitts & Nevis</option>      <option value="St. Lúcia">St. Lúcia</option>
                <option value="St. Vincent">St. Vincent</option>        <option value="Sudão">Sudão</option>
                <option value="Suécia">Suécia</option>                  <option value="Suiça">Suiça</option>
                <option value="Suriname">Suriname</option>              <option value="Tailândia">Tailândia</option>
                <option value="Taiwan">Taiwan</option>                  <option value="Tanzânia">Tanzânia</option>
                <option value="Togo">Togo</option>                      <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                <option value="Tunísia">Tunísia</option>                <option value="Turquia">Turquia</option>
                <option value="Ucrânia">Ucrânia</option>                <option value="Uganda">Uganda</option>
                <option value="Uruguai">Uruguai</option>                <option value="Venezuela">Venezuela</option>
                <option value="Vietnã">Vietnã</option>                  <option value="Zaire">Zaire</option>
                <option value="Zâmbia">Zâmbia</option>                  <option value="Zimbábue">Zimbábue</option>
              </select>
          </label>
            <label class="colunm2" ng-if="agent.pais === 'Brasil'">
                <span class="destaque">Estado*</span>
                <select name="En_Estado" ng-blur="save_field('En_Estado')" ng-model="agent.En_Estado">
                    <option value="AC">Acre</option>              <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>             <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>             <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>  <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>             <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>       <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>      <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>           <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>        <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option> <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>           <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>         <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
                <span class="error" ng-repeat="error in errors.estado">{{ error }}</span>
            </label>
            <label class="colunm2" ng-if="agent.pais !== 'Brasil'">
                <span class="destaque">Estado</span>
                <input name="En_Estado" type="text" ng-blur="save_field('En_Estado')" ng-model="agent.En_Estado"/>
            </label>
            <label class="colunm2">
                <span class="destaque">{{agent.pais == 'Brasil' ? 'Cidade*' : 'Cidade'}}</span>
                <input name="En_Municipio" type="text" ng-blur="save_field('En_Municipio')" ng-model="agent.En_Municipio"/>
            </label>
            <label class="colunm2">
                <span class="destaque">{{agent.pais == 'Brasil' ? 'Bairro*' : 'Bairro'}}</span>
                <input name="En_Bairro" type="text" ng-blur="save_field('En_Bairro')" ng-model="agent.En_Bairro"/>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
          <label class="colunm2">
              <span class="destaque">{{agent.pais == 'Brasil' ? 'Rua*' : 'Rua'}}</span>
              <input name="En_Nome_Logradouro" type="text" ng-blur="save_field('En_Nome_Logradouro')" ng-model="agent.En_Nome_Logradouro"/>
          </label>
            <label class="colunm2">
                <span class="destaque">{{agent.pais == 'Brasil' ? 'Número*' : 'Número'}}</span>
                <input name="En_Num" type="text" ng-blur="save_field('En_Num')" ng-model="agent.En_Num"/>
            </label>
            <label class="colunm2">
                <span class="destaque">{{agent.pais == 'Brasil' ? 'CEP*' : 'CEP'}}</span>
                <input type="text"
                       name="cep"
                       ng-blur="save_field('cep')"
                       ng-model="agent.cep"
                       ui-mask="99999-999"
                       ng-if="agent.pais === 'Brasil'">
                <input type="text"
                      name="cep"
                      ng-blur="save_field('cep')"
                      ng-model="agent.cep"
                      ng-if="agent.pais !== 'Brasil'">
            </label>
            <label class="colunm2">
                <span class="destaque">Complemento</span>
                <input type="text" ng-blur="save_field('En_Complemento')" ng-model="agent.En_Complemento"/>
            </label>
        </div>
        <div class="clear"></div>
    </div>
</form>

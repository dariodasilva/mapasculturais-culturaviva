<?php
    $this->bodyProperties['ng-app'] = "culturaviva";
    $this->layout = 'cadastro';
    $this->cadastroTitle = '1. Informações do Responsável';
    $this->cadastroText = 'Precisamos saber quem é você e pegar seus contatos! Afinal, comunicação é um requisito vital para que nossa rede se mantenha viva!';
    $this->cadastroIcon = 'icon-user';
    $this->cadastroPageClass = 'responsavel page-base-form';
    $this->cadastroLinkContinuar = 'entidadeDados';
?>


<form name="form_responsavel" ng-controller="ResponsibleCtrl">
    <?php $this->part('messages'); ?>
    <div class="form">
        <h4>Informações Obrigatórias</h4>
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Nome completo*</span>
                <input type="text" name="nomeCompleto" ng-blur="save_field('nomeCompleto')" ng-model="agent.nomeCompleto" />
            </label>

            <label class="colunm2">
                <span class="destaque">CPF*</span>
                <input type="text"
                       name="cpf"
                       ng-blur="save_field('cpf')"
                       ng-model="agent.cpf"
                       ui-mask="999.999.999-99">
            </label>

            <?php /*
            <label class="colunm2">
                <span>RG*</span>
                <input type="text"
                       ng-blur="save_field('rg')"
                       ng-model="agent.rg">
            </label>
            <label class="colunm3">
                <span>Órgão expeditor*</span>
                <input type="text"
                       ng-blur="save_field('rg_orgao')"
                       ng-model="agent.rg_orgao">
            </label>

            */ ?>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span class="destaque">E-mail Pessoal*</span>
                <input type="email" name="emailPrivado" ng-blur="save_field('emailPrivado')" ng-model="agent.emailPrivado" />
            </label>

            <label class="colunm2">
                <span class="destaque">Telefone Pessoal (com DDD)*</span>
                <input type="text" name="telefone1" ng-blur="save_field('telefone1')" ng-model="agent.telefone1" ui-mask="(99) ?99999 9999">
            </label>

            <label class="colunm3">
                <span class="destaque">Operadora</span>
                <input type="text" name="telefone1_operadora" ng-blur="save_field('telefone1_operadora')" ng-model="agent.telefone1_operadora">
            </label>
            <label class="colunm2">
                <span class="destaque">Outro Telefone </span>
                <input type="text" name="telefone2" ng-blur="save_field('telefone2')" ng-model="agent.telefone2" ui-mask="(99) ?99999 9999">
            </label>

            <label class="colunm3">
                <span class="destaque">Operadora</span>
                <input type="text" name="telefone2_operadora" ng-blur="save_field('telefone2_operadora')" ng-model="agent.telefone2_operadora">
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Qual sua relação com o Ponto/Pontão de Cultura?* <i class='hltip' title='Você não precisa necessariamente ser o responsável legal para entrar na Rede Cultura Viva, descreva o que você faz no Ponto de Cultura. Ex. colaborador; parceiro; funcionário; coordenador de comunicação; etc'>?</i></span>
                <select name="relacaoPonto" ng-blur="save_field('relacaoPonto')" ng-model="agent.relacaoPonto">
                    <option value="responsavel">Sou o responsável pelo Ponto/Pontão de Cultura</option>
                    <option value="funcionario">Trabalho no Ponto/Pontão de Cultura</option>
                    <option value="parceiro">Sou parceiro do Ponto/Pontão e estou ajudando a cadastrar</option>
                </select>
            </label>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form form-opcional">
        <h4>Informações Opcionais</h4>
        <div class="row">
            <div class="img_updade" ng-controller="ImageUploadCtrl" ng-init="init('responsavel')">
                <div class="file-item">
                    <a ng-if="agent.files.avatar" class="exclui" ng-click="deleteFile(agent.files.avatar)" title="Excluir arquivo">x</a>
                    <div type="file" ngf-select="uploadFile($file, 'avatar')" accept="config.image.validation" ngf-max-size="config.image.maxUploadSize" title="{{agent.files.avatar ? 'Clique para alterar a foto' : 'Clique para incluir uma foto'}}">
                        <img ng-if="!agent.files.avatar" src="<?php $this->asset('img/incluir_img.png') ?>" width="160" height="138">
                        <img ng-if="agent.files.avatar" src="{{agent.files.avatar.files.avatarBig.url}}" width="160" height="138">
                    </div>
                </div>
                <div class="progress row" ng-show="f.progress >= 0">
                    <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
                </div>
            </div>

            <label class="nome_chamado">
                <span class="destaque">Qual nome você gostaria de ser chamado <i class='hltip' title='Utilize este espaço para nos informar se você possui um nome social, nome artístico ou nome pelo qual é conhecido em sua comunidade'>?</i></span>
                <input type="text" ng-blur="save_field('name')" ng-model="agent.name"/>
            </label>
            <div class="onde_voce_mora">
                <span class="destaque">Onde você mora?</span>
            </div>
            <label class="colunm-30">
              <span class="destaque">País</span>
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
              <label class="colunm05" ng-show="agent.pais==='Brasil'">
                  <span class="destaque">Estado</span>
                  <select name="geoEstado" ng-blur="save_field('geoEstado')" ng-model="agent.geoEstado">
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
            <label class="cidade">
                <span class="destaque">Cidade</span>
                <input type="text" ng-blur="save_field('geoMunicipio')" ng-model="agent.geoMunicipio"/>
            </label>
            <div class="clear"></div>
        </div>
        <div class="row">
            <span class="destaque redessociais">Seu perfil nas redes sociais: <i class='hltip' title='Queremos saber seu perfil nas redes sociais para podermos conectá-l@ com nossas atualizações e novidades.'>?</i></span>
            <label class="colunm-redes facebook">
                <span class="destaque"><img src="<?php $this->asset('img/facebook.png') ?>"> Seu perfil no Facebook</span>
                <input type="text" ng-blur="save_field('facebook')" ng-model="agent.facebook" placeholder="http://"/>
            </label>

            <label class="colunm-redes twitter">
                <span class="destaque"><img src="<?php $this->asset('img/twitter.png') ?>"> Seu perfil no Twitter</span>
                <input type="text" ng-blur="save_field('twitter')" ng-model="agent.twitter" placeholder="http://"/>
            </label>

            <label class="colunm-redes googleplus">
                <span class="destaque"><img src="<?php $this->asset('img/googlePlus.ico') ?>"> Seu perfil no Google+</span>
                <input type="text" ng-blur="save_field('googleplus')" ng-model="agent.googleplus" placeholder="http://"/>
            </label>
            <label class="colunm-redes telegram">
                <span class="destaque"><img src="<?php $this->asset('img/telegram.ico') ?>"> Seu usuário no Telegram</span>
                <input type="text" ng-blur="save_field('telegram')" ng-model="agent.telegram" placeholder="@SeuNome"/>
            </label>
            <label class="colunm-redes whatsapp">
                <span class="destaque"><img src="<?php $this->asset('img/whatsapp.png') ?>"> Seu número do WhatsApp</span>
                <input type="text" ng-blur="save_field('whatsapp')" ng-model="agent.whatsapp" placeholder="(11) _____-_____ "/>
            </label>
            <label class="colunm-redes culturadigital">
                <span class="destaque"><img src="<?php $this->asset('img/CulturaDigital_favi.png') ?>"> Seu perfil no CulturaDigital.br</span>
                <input type="text" ng-blur="save_field('culturadigital')" ng-model="agent.culturadigital" placeholder="http://"/>
            </label>
            <label class="colunm-redes diaspora">
              <span class="destaque"><img src="<?php $this->asset('img/icon_diaspora.png') ?>">Perfil na Diáspora:</span>
                <input type="text" ng-blur="save_field('diaspora')" ng-model="agent.diaspora" placeholder="http://"/>
            </label>
            <label class="colunm-redes instagram">
                <span class="destaque"><img src="<?php $this->asset('img/instagram.png') ?>"> Seu perfil no Instagram.com</span>
                <input type="text" ng-blur="save_field('instagram')" ng-model="agent.instagram" placeholder="http://"/>
            </label>
            <label class="colunm-redes flick">
                <span class="destaque"><img src="<?php $this->asset('img/icon_flicker.png') ?>"> Página no Flickr</span>
                <input type="text" ng-blur="save_field('flickr')" ng-model="agent.flickr" placeholder="http://"/>
            </label>
            <label class="colunm-redes youtube">
                <span class="destaque"><img src="<?php $this->asset('img/icon_youtube.png') ?>"> Perfil no Youtube:</span>
                <input type="text" ng-blur="save_field('youtube')" ng-model="agent.youtube" placeholder="http://"/>
            </label>

        </div>
    </div>
</form>

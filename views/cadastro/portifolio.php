<?php
    $this->bodyProperties['ng-app'] = "culturaviva";
    $this->layout = 'cadastro';
    $this->cadastroTitle = '4. Portfólio e Anexos';
    $this->cadastroText = 'Inclua suas fotos, links e redes sociais! Isto nos ajuda a entender que tipo de atividades culturais você realiza como Ponto de Cultura!';
    $this->cadastroIcon = 'icon-picture';
    $this->cadastroPageClass = 'portfolio page-base-form';
    $this->cadastroLinkContinuar = 'entidadeFinanciamento';
?>
<style>

</style>
<form name="form_portifolio" ng-controller="PortifolioCtrl">
    <?php $this->part('messages'); ?>
    <div class="form">
        <h4>Informações Obrigatórias</h4>
        <div class="row" ng-controller="ImageUploadCtrl" ng-init="init('ponto')">
            <span class="destaque espacoleft">Atividades já realizadas* <i class='hltip' title='Nos ajude a entender o histórico de seu Ponto de Cultura e as atividades desenvolvidas nele.'>?</i></span>

            <div class="colunm-20">
                <div class="file-item">
                    <a ng-if="agent.files.portifolio" href="#" class="exclui" ng-click="deleteFile(agent.files.portifolio)" title="Excluir Portfólio">x</a>
                    <div type="file" ngf-select="uploadFile($file, 'portifolio')" accept="config.pdf.validation" ngf-max-size="config.pdf.maxUploadSize" title="{{agent.files.portifolio ? 'Clique para alterar o Portfólio' : 'Clique para incluir um Portfólio'}}">
                        <img ng-if="!agent.files.portifolio" src="<?php $this->asset('img/incluir_img.png') ?>" width="160" height="138">
                        <img ng-if="agent.files.portifolio" src="<?php $this->asset('img/pdflogo.png') ?>" width="160" height="138">
                    </div>
                    <div id="errorBox">
                      <span id="msg_errorBox" ng-hide=errozao>Arquivos devem possuir no máximo 20MB</span>
                  </div>
                </div>
                <a ng-if="agent.files.portifolio" href="{{agent.files.portifolio.url}}" target="_blank">Baixar Arquivo</a>
                <div class="progress row" ng-show="f.progress >= 0">
                    <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
                </div>
            </div>


            <label class="colunm-50">

                <p>Caso não possua portfólio online você pode anexar arquivos no formato PDF de até 20MB.</p>
                <p>Outra possibilidade é gravar um vídeo de até 10 minutos contando sobre seu Ponto de Cultura. Publique-o no Youtube e compartilhe o link aqui.</p>
		<div class="row" ng-controller="PortifolioCtrl">
			<label class="colunm1">
                		<span class="destaque">
				                  Portfólio Online
				<i class='hltip' title="Caso possua um portfólio online, coloque o link aqui.">?</i></span>
	        		<input type="text" name="atividadesEmRealizacaoLink" placeholder="http://" ng-blur="save_field('atividadesEmRealizacaoLink')" ng-model="agent.atividadesEmRealizacaoLink" />
			</label>
		</div>
                <p>Precisa de ajuda para montar seu portfólio?
                    <i class='hltip' title='Um portifólio é um relatório das atividades desenvolvidas pelo Ponto de Cultura com imagens, vídeos e outros itens que comprovem a sua existência'>?</i>
                    <br>
                    <a href="http://docs.cultura.gov.br/products/files/doceditor.aspx?fileid=138&doc=NEQxOFBKRmNORzhYaVJ1NGNZUC8xNG1EMC9WaWgvRkFqbGc0MlhOV3BVZz0_IjEzOCI1" target="_blank">Clique aqui</a> para baixar um modelo com orientações.
                </p>
            </label>
      </div>
      <div class="row" ng-if="agent_entidade.tipoOrganizacao == 'coletivo'">
        <div ng-controller="ImageUploadCtrl" ng-init="init('ponto')">
          <h4>Carta de Autorização de Coletivo sem Constituição Jurídica</h4>
            <div class="colunm-20">
              <div class="file-item">
                  <a ng-if="agent.files.ata" href="#" class="exclui" ng-click="deleteFile(agent.files.ata)" title="Excluir Portfólio">x</a>
                  <div type="file" ngf-select="uploadFile($file, 'ata')" accept="config.pdf.validation" ngf-max-size="config.pdf.maxUploadSize" title="{{agent.files.ata ? 'Clique para alterar a Carta' : 'Clique para incluir a Carta'}}">
                    <img ng-if="!agent.files.ata" src="<?php $this->asset('img/incluir_img.png') ?>" width="160" height="138">
                    <img ng-if="agent.files.ata" src="<?php $this->asset('img/pdflogo.png') ?>" width="160" height="138">
                  </div>
            </div>
            <a ng-if="agent.files.ata" href="{{agent.files.ata.url}}" target="_blank">Baixar Arquivo</a>
            <div class="progress row" ng-show="f.progress >= 0">
                <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
            </div>
          </div>
              <label class="colunm-50">
                  Precisa de ajuda para montar sua carta?
                  <br>
                  <a href="<?php $this->asset('pdf/Carta_de_Apoio_da_Comunidade_à_Coletivo vs 3.pdf') ?>" target="_blank">Clique aqui</a> para baixar um modelo com orientações.
                </label>
        </div>
      </div>

        <div class="row">
            <h4>Cartas de Reconhecimento</h4>
            <p style="text-align:justify;">Anexar 02 cartas de apoio à entidade ou coletivo cultural requerente, emitidas por Pontos de Cultura, instituições públicas, privadas, ou coletivos culturais relacionadas com arte, cultura, educação ou desenvolvimento comunitário. As cartas devem ser assinadas e digitalizadas. Serão aceitas somente assinaturas manuscritas em papel ou impressões digitais em caso de pessoas não alfabetizadas.</p>
            <p>O ato de assinar uma Carta de Reconhecimento implica na responsabilidade da instituições públicas, privadas, ou coletivos culturais para com a credibilidade do Ponto/Pontão de Cultura, firmando a legitimidade do mesmo.</p>
        </div>
        <div class="row">
            <span class="destaque espacoleft">Carta de Reconhecimento * <i class='hltip' title='As cartas de apoio nos ajudam a entender como o Ponto de Cultura se conecta com a comunidade ao seu redor e certifica a participação da comunidade no processo.'>?</i></span>
            <div class="colunm-20" ng-controller="ImageUploadCtrl" ng-init="init('ponto')">
              <div class="file-item">
                  <a ng-if="agent.files.carta1" href="#" class="exclui" ng-click="deleteFile(agent.files.carta1)" title="Excluir Carta de Recomendação">x</a>
                  <div type="file" ngf-select="uploadFile($file, 'carta1')" accept="config.pdf.validation" ngf-max-size="config.pdf.maxUploadSize" title="{{agent.files.carta1 ? 'Clique para alterar a carta de recomendação' : 'Clique para incluir uma carta de recomendação'}}">
                      <img ng-if="!agent.files.carta1" src="<?php $this->asset('img/incluir_img.png') ?>" width="160" height="138">
                      <img ng-if="agent.files.carta1" src="<?php $this->asset('img/pdflogo.png') ?>" width="160" height="138">
                  </div>
              </div>
              <a ng-if="agent.files.carta1" href="{{agent.files.carta1.url}}" target="_blank">{{agent.files.carta1.name}}</a>
              <div class="progress row" ng-show="f.progress >= 0">
                  <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
              </div>
            </div>
            <div class="colunm-20" ng-controller="ImageUploadCtrl" ng-init="init('ponto')">
              <div class="file-item">
                  <a ng-if="agent.files.carta2" href="#" class="exclui" ng-click="deleteFile(agent.files.carta2)" title="Excluir Portfólio">x</a>
                  <div type="file" ngf-select="uploadFile($file, 'carta2')" accept="config.pdf.validation" ngf-max-size="config.pdf.maxUploadSize" title="{{agent.files.carta2 ? 'Clique para alterar a carta de recomendação' : 'Clique para incluir uma carta de recomendação'}}">
                      <img ng-if="!agent.files.carta2" src="<?php $this->asset('img/incluir_img.png') ?>" width="160" height="138">
                      <img ng-if="agent.files.carta2" src="<?php $this->asset('img/pdflogo.png') ?>" width="160" height="138">
                  </div>
              </div>
              <a ng-if="agent.files.carta2" href="{{agent.files.carta2.url}}" target="_blank">{{agent.files.carta2.name}}</a>
              <div class="progress row" ng-show="f.progress >= 0">
                  <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
              </div>
            </div>
<!--
                <div class="file-item">
                    <a ng-if="agent.files.carta1" href="#" class="exclui" ng-click="deleteFile(agent.files.portifolio)" title="Excluir Portfólio">x</a>
                    <div type="file" ngf-select="uploadFile($file, 'carta1')" accept="config.pdf.validation" ngf-max-size="config.pdf.maxUploadSize" title="{{agent.files.portifolio ? 'Clique para alterar o Carta' : 'Clique para incluir Carta'}}">
                        <img ng-if="!agent.files.carta1" src="<?php $this->asset('img/incluir_pdf.png') ?>" width="160" height="138">
                        <img ng-if="agent.files.carta1" src="<?php $this->asset('img/pdflogo.png') ?>" width="160" height="138">
                    </div>
                </div>
                <a ng-if="agent.files.carta1" href="{{agent.files.carta1.url}}" target="_blank">{{agent.files.carta1.name}}</a>
                <div class="progress row" ng-show="f.progress >= 0">
                    <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
                </div>
-->

            <label class="colunm-50">

                <p>
                    Precisa de um modelo de carta?
                    <br>
                    <a href="<?php $this->asset('pdf/Modelos_de_Carta_de_Referência_.docx')?>" target="_blank">Clique aqui</a> para baixar.
                </p>
            </label>
        </div>
        <div class="clear"></div>
        <?php /*
        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Atividades culturais em realização* <i>?</i></span>
                <textarea ng-blur="save_field('atividadesEmRealizacao')" ng-model="agent.atividadesEmRealizacao"></textarea>
            </label>
        </div>
        <div class="clear"></div>
        */ ?>
    </div>
    <div class="form form-opcional">
        <h4>Informações Opcionais</h4>
        <div class="row">
            <span class="destaque destaque-conecte">Conecte seu Ponto com as redes sociais: <i class='hltip' title='Ajude-nos a te encontrar e saber as novidades.'>?</i></span>
        </div>
        <div class="row">
            <label class="colunm-redes site-oficial">
                <span class="destaque"><img src="<?php $this->asset('img/location.png') ?>">  Site oficial</span>
                <input type="text" ng-blur="save_field('site')" ng-model="agent.site" placeholder="http://"/>
            </label>
        </div>
        <div class="row">
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
        <div class="clear"></div>
        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Conte um pouco sobre a história do Ponto de Cultura (max. 800 caracteres) <i class='hltip' title='Nos diga um pouco mais sobre o ponto de cultura, como por exemplo como ele começou e como surgiu a idéia'>?</i>  </span>
                <textarea ng-blur="save_field('longDescription')" maxlength="800" ng-model="agent.longDescription"></textarea>
                <span>{{800 - agent.longDescription.length}} Characters</span>
            </label>

        </div>
        <div class="clear"></div>
        <div class="row" ng-controller="ImageUploadCtrl" ng-init="init('ponto')">
            <span class="destaque espacoleft">Fotos de Divulgação do Ponto de Cultura <i class='hltip' title='Essas imagens devem mostrar as atividades que seu Ponto de Cultura desenvolve'>?</i></span>
            <p class="espacoleft">Inclua no máximo 10 arquivos, no formato JPG ou PNG com até 1MB</p>
            <div class="img_updade file-item" ng-repeat="f in agent.files.gallery">
                <a class="exclui" ng-click="deleteFile(f)" title="Excluir arquivo">x</a>
                <img src="{{f.files.avatarBig.url}}" width="160" height="138">
            </div>
            <div class="img_updade file-item">
                <div type="file" ngf-select="uploadFile($file, 'gallery')" accept="config.image.validation" ngf-max-size="config.image.maxUploadSize" title="Clique para incluir uma foto">
                    <img src="<?php $this->asset('img/incluir_img.png') ?>" width="160" height="138">
                </div>
                <div class="progress row" ng-show="f.progress >= 0">
                    <span style="width:{{f.progress}}%;" ng-bind="f.progress + '%'"></span>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</form>

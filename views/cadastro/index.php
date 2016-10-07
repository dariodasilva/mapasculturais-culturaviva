<?php
$this->bodyProperties['ng-app'] = "culturaviva";
?>
<style>
  a{
    color: #078979;
  }
  a:hover{
    color: #078979;
  }
  #selo-index{
  margin-left: 750px;
  margin-top: -213px;
  }
  #selo-img{
    height: 180px;
    width:auto;
  }
  canvas{
      width: 10px;
      height: 10px;
  }
</style>
<div id="page-cadastro" ng-controller="DashboardCtrl">
    <?php $this->part('messages'); ?>
    <section class="texto">
<!--        <div class="messenger">
            <a href="#" class="close">X</a>
            <p>Algumas informações já foram preenchidas de acordo com o cadastro que o MinC possui de seu Ponto. Confira com essas informações antes de validá-las!</p>
        </div>
        1. Informações do Responsável
        2. Entidade ou Coletivo Cultural
        3. Projetos Financiados
        4. Seu Ponto no Mapa
        5. Portifólio e Anexos
        6. Atuação e Articulação
        7. Economia Viva
        8. Formação
-->
        <article>
            <h2>Seja bem-vindo(a) <br>à Rede Cultura Viva</h2>
            <p>Esta é a página do seu Ponto de Cultura. Apenas você tem acesso a ela.</p>
            <p>Fique a vontade para ir preenchendo as sessões. Você não precisa fazer tudo agora! Quando sua página estiver completa clique em "Enviar".</p>
            <p>Depois, seu ponto poderá criar eventos, projetos e usar a plataforma para se manter em contato com o Ministério da Cultura.</p>
        </article>
        <div ng-if="agent_ponto.homologado_rcv" id="selo-index">
          <img id="selo-img" src="<?php $this->asset('img/verified-icon-big.png') ?>">
        </div>
    </section>
    <section class="boxs-cadastro">
	<article class="boxs-cadastro" style="width: 100%; background: #078979 none repeat scroll 0% 0%;"><header><center><h4>Certificação Simplificada</h4></center></header></article>
        <a href="<?php echo $app->createUrl('cadastro', 'responsavel'); ?>">
        <article class="box-info-responsavel">
            <header>
              <span class="icon icon-user"></span>
              <h4> 1. Informações do Responsável</h4>
              <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
              <div class="texto">
                <p>Precisamos saber quem é você e pegar seus contatos</p>
              </div>
<!--                <div class="circle-status c100 p56 small">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'entidadeDados'); ?>">
        <article class="box-entidade-dados border-left">
            <header>
                <span class="icon icon-home"></span>
                <h4> 2. Entidade ou Coletivo Cultural</h4>
                <span class="btn_mais"> + </span>

            </header>
            <div class="infos">
                <div class="texto">
                     <p>Conte mais sobre sua organização</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'pontoMapa'); ?>">
        <article class="box-ponto-mapa">
            <header>
                    <span class="icon icon-location"></span>
                    <h4> 3. Seu Ponto no Mapa</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
                <div class="texto">
                     <p>Mostre onde você atua</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'portifolio'); ?>">
        <article class="box-portfolio border-left">
            <header>
              <span class="icon icon-picture"></span>
              <h4> 4. Portfólio e Anexos</h4>
              <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
                <div class="texto">
                     <p>Anexe os documentos obrigatórios para a autodeclaração</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'articulacao'); ?>" ng-if="agent_entidade.tipoPontoCulturaDesejado == 'pontao'">
        <article class="box-atuacao-articulaco border-left">
            <header>
                    <span class="icon icon-chat"></span>
                    <h4> 5. Atuação e Articulação</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Fale um pouco mais sobre as atividades realizadas pelo seu Ponto</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
	<div ng-show="data.statusInscricao > 0">
	<article class="boxs-cadastro" style="width: 100%; background: #078979 none repeat scroll 0% 0%;"><header><center><h4>Informações Complementares</h4></center></header></article>
        <a href="<?php echo $app->createUrl('cadastro', 'entidadeFinanciamento'); ?>">
        <article class="box-entidade-financiados">
            <header>
              <span class="icon icon-dollar"></span>
              <h4 ng-if="agent_entidade.tipoPontoCulturaDesejado != 'pontao'"> 5. Projetos Financiados</h4>
              <h4 ng-if="agent_entidade.tipoPontoCulturaDesejado == 'pontao'"> 6. Projetos Financiados</h4>
              <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Já recebeu recursos do Ministério da Cultura? </p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'articulacao'); ?>" ng-if="agent_entidade.tipoPontoCulturaDesejado != 'pontao'">
        <article class="box-atuacao-articulaco border-left">
            <header>
                    <span class="icon icon-chat"></span>
                    <h4> 6. Atuação e Articulação</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Fale um pouco mais sobre as atividades realizadas pelo seu Ponto</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'economiaViva'); ?>">
        <article class="box-economia-viva">
            <header>
                    <span class="icon icon-vcard"></span>
                    <h4> 7. Economia Viva</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Compartilhe recursos e serviços</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'formacao'); ?>">
        <article class="box-formacao border-left">
            <header>
                    <span class="icon icon-book-open"></span>
                    <h4> 8. Formação</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Conecte conhecimentos e metodologias</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
	</div>
        <div class="clear"></div>
    </section>
    <section class="box-status">
        <article class="validar-ponto">
<!--            <h4><i class="icon-publish"> </i> Enviar </h4>-->
            <label class="colunm-full aceito-termo" style="color:#FFF">
              <p>
                <input type="checkbox"
                       name="termos"
                       ng-model="agent.termos_de_uso"
                       ng-true-value="1"
                       ng-false-value="0"
                       ng-checked="agent.termos_de_uso === '1'"
                       ng-change="save_field('termos_de_uso')"> Aceito os <a href="/termos-de-uso-e-privacidade/" style="color:#FFF"> Termos de Uso e Privacidade</a> e o <a href="/termo-de-adesao/" style="color:#FFF">Termo de Adesão à Política Nacional de Cultura Viva </a>
              </p>
              <p style="font-weight:bold""color:red">
                <input type="checkbox"
                       name="veracidade"
                       ng-model="agent.info_verdadeira"
                       ng-true-value="1"
                       ng-false-value="0"
                       ng-checked="agent.info_verdadeira === '1'"
                       ng-change="save_field('info_verdadeira')"> Declaro que as informações prestadas são verdadeiras, assumindo inteira responsabilidade pelas mesmas.
              </p>
            </label>
            <p class="mensagem-validar">Para validar seu ponto, você precisa preencher todas as informações obrigatórias.</p>
            <div class="clear"></div>
        </article>
        <article class="content-status">

        <?php /*
        <article class="content-status">
            <div class="status">

                <div class="circle-status c100 p13">
                    <span>13%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-user"></span>
                <p>Informações do Responsável<br />(45% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p65">
                    <span>65%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-home"></span>
                <p>Entidade ou Coletivo Cultural<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p13">
                    <span>13%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-dollar"></span>
                <p>Projetos Financiados<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p100">
                    <span>100%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-location"></span>
                <p>Seu Ponto no Mapa<br />(100% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p50">
                    <span>50%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-picture"></span>
                <p>Portifólio e Anexos<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p100">
                    <span>100%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-chat"></span>
                <p>Atuação e Articulação<br />(100% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p55">
                    <span>55%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-vcard"></span>
                <p>Economia Viva<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p90">
                    <span>90%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-book-open"></span>
                <p>Formação<br />(50% informações opcionais)</p>

            <div class="clear"></div>

            <div class="infos-messenge">
                <a href="#" class="close">X</a>
                Algumas informações já foram preenchidas de acordo com o cadastro que o MinC possui de seu Ponto. Configra com atenção essas informações antes de validá-las!
            </div>
        */ ?>

    <div class='alert danger' style="margin:0 10%" ng-show="data.validationErrors">
                Alguns campos obrigatórios não foram preenchidos
		    <!-- Dados do responsavel -->
    		<strong ng-show="data.mostrarErroResponsavel == 'responsavel'"><br/>
			       <a href="/cadastro/responsavel/#?invalid=1">Em "Informações do Responsável" </a>
		    </strong>
		    <strong ng-show="data.mostrarErroEntidadeDado == 'entidade_showdado'"><br/>
			       <a href="/cadastro/entidadeDados/#?invalid=1">Em "Dados da Entidade ou Coletivo Cultural" </a>
		    </strong>
    		<strong ng-show="data.mostrarErroPontoMapa == 'ponto_mapa'"><br/>
			       <a href="/cadastro/pontoMapa/#?invalid=1">Em "Seu Ponto no Mapa" </a>
		    </strong>
    		<strong ng-show="data.mostrarErroPonto == 'ponto_portifolio'"><br/>
			       <a href="/cadastro/portifolio/#?invalid=1">Em "Portfólio e Anexos"</a>
		    </strong>
  </div>
  <script type="text/ng-template" id="modal1">
    <p>Dados enviados com sucesso!</p>
    <p ng-if ="data.statusInscricao = 1">Agora que preencheu nosso cadastro, conheça também o <a color="#078979" href="http://cadsol.mte.gov.br/inter/cadsol/main.seam" target="_blank">cadastro de economia solidária</a> e o <a href="http://simmc.c3sl.ufpr.br/#/pid" target="_blank"> cadastro de pontos de inclusão digital.</a></p>
    <b> Existe alguma observação que você gostaria de fazer?</b>
    <textarea cols="65" ng-model="agent.obs" ng-blur="save_field('obs')"></textarea>
  </script>
  <script type="text/ng-template" id="modal2">
    <p>Dados atualizados com sucesso!</p>
  </script>

  <div class="page-base-form">
    <button class="btn-validar" ng-disabled="(agent.termos_de_uso === null || agent.termos_de_uso === '0' || agent.info_verdadeira === null || agent.info_verdadeira === '0')" ng-click="enviar()"> {{data.statusInscricao > 0 ? 'Atualizar' : 'Enviar'}} </button>
      <p ng-show="data.statusInscricao > 0" >
                Recebemos seus dados com sucesso!
                Em breve você receberá uma notificação sobre a validação do seu Ponto ou Pontão de Cultura!
                Continue navegando e, caso altere algum campo, clique em atualizar.
                Muito obrigada por fazer parte da Rede Cultura Viva!
      </p>
  </div>
     </article>

    </section>
</div>
<div style="margin-top:-50px; margin-right: 300px; font-size: 35px" ng-controller="layoutPDFCtrl">
    <div ng-show="show" style="float:right;">
        <a id="download">Baixar Certificado</a>
        <div ng-hide="urlQRCODE.length != 0">
            <qr text="urlQRCODE" id="qrcode"></qr>
        </div>
    </div>
</div>
<script type="text/javascript">
    var qr = document.getElementById('qrcode');
    function convertImgToBase64(callback){
        var img = new Image();
        img.onload = function(){
            var canvas = document.createElement('CANVAS');
            var ctx = canvas.getContext('2d');
            canvas.height = 1241;
            canvas.width = 1754;
            ctx.drawImage(this, 0, 0);
            var dataURL = canvas.toDataURL('image/png');
            callback(dataURL);
            canvas = null;
        };
        img.src = '/assets/rcv/img/certificado.png';
    }

    var button = document.getElementById("download");

    button.onclick = function(){
        convertImgToBase64(function(dataUrl){
            var doc = new jsPDF('landscape','pt',[1754,1241]);
            if(window.name.length < 40){
                doc.setFontSize(40);
            }else if(window.name.length < 70){
                doc.setFontSize(20);
            }else{
                doc.setFontSize(15);
            }
            doc.addImage(dataUrl,'png',0,0,1754,1241);
            doc.setFontType("bold");
            doc.text(window.name, 770, 395);
            doc.setFontSize(30);
            doc.text(window.url,570,1225);
            var dataURLQR = qr.children[0].toDataURL('image/png');
            doc.addImage(dataURLQR,'png',667,1014,177,177);
            doc.save('Certificado.pdf');
        });
    };
</script>

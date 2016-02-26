<?php
$this->bodyProperties['ng-app'] = "culturaviva";
?>
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
    </section>
    <section class="boxs-cadastro">
	<article class="boxs-cadastro" style="width: 100%; background: #078979 none repeat scroll 0% 0%;"><header><center><h4>Autodeclaração</h4></center></header></article>
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
	<div ng-show="data.statusInscricao > 0">
	<article class="boxs-cadastro" style="width: 100%; background: #078979 none repeat scroll 0% 0%;"><header><center><h4>Informações Complementares</h4></center></header></article>
        <a href="<?php echo $app->createUrl('cadastro', 'entidadeFinanciamento'); ?>">
        <article class="box-entidade-financiados">
            <header>
              <span class="icon icon-dollar"></span>
              <h4> 5. Projetos Financiados</h4>
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
        <a href="<?php echo $app->createUrl('cadastro', 'articulacao'); ?>">
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
                       ng-change="save_field('termos_de_uso')"> Aceito os <a href="/termos-de-uso-e-privacidade/" style="color:#FFF"> Termos de Uso e Privacidade</a> e o <a href="/termo-de-adesao/" style="color:#FFF">Termo de Adesão à Política Nacional de Cultura Viva </a>
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
			       <a href="/cadastro/responsavel/?invalid=1">Em "Informações do Responsável" </a>
		    </strong>
		    <strong ng-show="data.mostrarErroEntidadeDado == 'entidade_showdado'"><br/>
			       <a href="/cadastro/entidadeDados/?invalid=1">Em "Dados da Entidade ou Coletivo Cultural" </a>
		    </strong>
    		<strong ng-show="data.mostrarErroPontoMapa == 'ponto_mapa'"><br/>
			       <a href="/cadastro/pontoMapa/?invalid=1">Em "Seu Ponto no Mapa" </a>
		    </strong>
    		<strong ng-show="data.mostrarErroPonto == 'ponto_portifolio'"><br/>
			       <a href="/cadastro/portifolio/?invalid=1">Em "Portfólio e Anexos"</a>
		    </strong>
  </div>
  <script type="text/ng-template" id="modal">
    <p>Dados atualizados com sucesso!</p>
    <p>Continue atualizando suas informações!</p>
    <a href="/cadastro/entidadeFinanciamento/">5.Projetos Financiados</a>
    <a href="/cadastro/articulacao/">6.Atuação e Articulação</a>
    <a href="/cadastro/economiaViva/">7.Economia Viva</a>
    <a href="/cadastro/formacao/">8.Formação</a>
  </script>

  <button class="btn-validar" ng-disabled="agent.termos_de_uso === '0'" ng-click="enviar()"> {{data.statusInscricao > 0 ? 'Atualizar' : 'Enviar'}} </button>
  <div class="page-base-form">

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

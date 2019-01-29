<div  >
    <?php $this->part('messages'); ?>
    <div class="form">
        <div class="row">
            <span><b> * Campos Obrigatórios </b></span>
        </div>
        <!-- <h4>Informações Obrigatórias</h4> -->
        <div class="row">
            <label class="colunm1">
                <span>Nome completo*</span>
                <span><b>{{responsavel.nomeCompleto}}</b></span>
                <span ng-if="!responsavel.nomeCompleto"><b>Não informado</b></span>
            </label>

            <label class="colunm2">
                <span>CPF*</span>
                <span><b>{{responsavel.cpf}}</b></span>
                <span ng-if="!responsavel.cpf"><b>Não informado</b></span>
            </label>

            <?php /*
            <label class="colunm2">
                <span>RG*</span>
                <input type="text"
                       ng-blur="save_field('rg')"
                       ng-model="responsavel.rg">
            </label>
            <label class="colunm3">
                <span>Órgão expeditor*</span>
                <input type="text"
                       ng-blur="save_field('rg_orgao')"
                       ng-model="responsavel.rg_orgao">
            </label>

            */ ?>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span>E-mail Pessoal*</span>
                <span><b>{{responsavel.emailPrivado}}</b></span>
                <span ng-if="!responsavel.emailPrivado"><b>Não informado</b></span>
            </label>

            <label class="colunm2">
                <span>Telefone Pessoal*</span>
                <span><b>{{responsavel.telefone1}}</b></span>
                <span ng-if="!responsavel.telefone1"><b>Não informado</b></span>
            </label>
            <label class="colunm2">
                <span>Telefone Pessoal</span>
                <span><b>{{responsavel.telefone2}}</b></span>
                <span ng-if="!responsavel.telefone2"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Qual sua relação com o Ponto/Pontão de Cultura?*<i class='hltip' title='Você não precisa necessariamente ser o responsável legal para entrar na Rede Cultura Viva, descreva o que você faz no Ponto de Cultura. Ex. colaborador; parceiro; funcionário; coordenador de comunicação; etc'>?</i></span>
                <span><b>{{responsavel.relacaoPonto}}</b></span>
                <span ng-if="!responsavel.relacaoPonto"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form">
        <!-- <h4>Informações Opcionais</h4> -->
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Qual nome você gostaria de ser chamado <i class='hltip' title='Utilize este espaço para nos informar se você possui um nome social, nome artístico ou nome pelo qual é conhecido em sua comunidade'>?</i></span>
                <span><b>{{responsavel.name}}</b></span>
                <span ng-if="!responsavel.name"><b>Não informado</b></span>
            </label>
        </div>
        <div class="row">
            <label class="colunm1">
                <span class="destaque">Onde você mora?</span>
            </label>
            <label class="colunm1">
              <span>País</span>
              <span><b>{{responsavel.pais}}</b></span>
              <span ng-if="!responsavel.pais"><b>Não informado</b></span>
            </label>
            <label class="colunm2" ng-show="responsavel.pais==='Brasil'">
                  <span>Estado</span>
                  <span><b>{{responsavel.En_Estado}}</b></span>
                  <span ng-if="!responsavel.En_Estado"><b>Não informado</b></span>
            </label>
            <label class="colunm3">
                <span>Cidade</span>
                <span><b>{{responsavel.En_Municipio}}</b></span>
                <span ng-if="!responsavel.En_Municipio"><b>Não informado</b></span>
            </label>
        </div>
        <div class="clear"></div>
        <div class="row">
            <label class="colunm1">
                <span class="destaque redessociais">Perfil nas redes sociais: <i class='hltip' title='Queremos saber Perfil nas redes sociais para podermos conectá-l@ com nossas atualizações e novidades.'>?</i></span>
            </label>
            <label class="colunm2"></label>
            <label class="colunm-redes facebook">
                <span><i class="icon icon-facebook-squared"></i> Perfil no Facebook</span>
                <span><b>{{responsavel.facebook}}</b></span>
                <span ng-if="!responsavel.facebook"><b>Não informado</b></span>
            </label>

            <label class="colunm-redes twitter">
                <span><i class="icon icon-twitter"></i> Perfil no Twitter</span>
                <span><b>{{responsavel.twitter}}</b></span>
                <span ng-if="!responsavel.twitter"><b>Não informado</b></span>
            </label>

            <label class="colunm-redes googleplus">
                <span><i class="icon icon-gplus"></i> Perfil no Google+</span>
                <span><b>{{responsavel.googleplus}}</b></span>
                <span ng-if="!responsavel.googleplus"><b>Não informado</b></span>
            </label>
            <label class="colunm-redes telegram">
                <span><i class="icon icon-telegram"></i> Usuário no Telegram</span>
                <span><b>{{responsavel.telegram}}</b></span>
                <span ng-if="!responsavel.telegram"><b>Não informado</b></span>
            </label>
            <label class="colunm-redes whatsapp">
                <span><i class="icon icon-whatsapp"></i> Número do WhatsApp</span>
                <span><b>{{responsavel.whatsapp}}</b></span>
                <span ng-if="!responsavel.whatsapp"><b>Não informado</b></span>
            </label>
            <label class="colunm-redes culturadigital">
                <span><i class="icon icon-culturadigital"></i> Perfil no CulturaDigital.br</span>
                <span><b>{{responsavel.culturadigital}}</b></span>
                <span ng-if="!responsavel.culturadigital"><b>Não informado</b></span>
            </label>
            <label class="colunm-redes diaspora">
                <span><i class="icon icon-diaspora"></i> Perfil no Diasporabr.com.br</span>
                <span><b>{{responsavel.diaspora}}</b></span>
                <span ng-if="!responsavel.diaspora"><b>Não informado</b></span>
            </label>
            <label class="colunm-redes instagram">
                <span><i class="icon icon-instagram"></i> Perfil no Instagram.com</span>
                <span><b>{{responsavel.instagram}}</b></span>
                <span ng-if="!responsavel.instagram"><b>Não informado</b></span>
            </label>
        </div>
    </div>
</div>

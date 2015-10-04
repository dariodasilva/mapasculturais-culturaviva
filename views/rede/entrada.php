
<section id="page-entrada">
    <article>
        <div class="row title">
            <h3>
                <strong>Declare seu ponto de Cultura</strong>
                Você já possui um CNPJ?
            </h3>
            <p>Responda e verificaremos se já temos informações sobre seu Ponto ou Pontão de Cultura na base de dados do MinC. </p>
            <a href="#" class="btn-cnpj btn-sem-cnpj js-btn-sem-cnpj btn_active">Sem CNPJ</a>
            <a href="#" class="btn-cnpj btn-com-cnpj js-btn-com-cnpj btn_active">com CNPJ</a>
        </div>
        <div class="row">
            <div class="colunm-full js-sem-cnpj esconde">
                <p>
                    Você não precisa ter um CNPJ para autodeclarar seu Ponto de Cultura.
                    <br />
                    Continue com a validação em nome do seu Coletivo Cultural.
                </p>
                <a href="#" class="btn btn_active btn_continuar">Continuar</a>
            </div>
            <div class="colunm-full js-com-cnpj esconde">
                <form method="POST" action="<?php echo $app->createUrl('cadastro', 'registra')?>">
                    <input type="hidden" name="comCNPJ" value="true"/>
                    <div class="cnpj-form">
                            <label>CNPJ*</label>
                            <input type="text" name="CNPJ" value="" />
                            <input type="submit" class="btn" value="OK" />
                    </div>
                    <div class="clear"></div>
                    <div class="resposta-cnpj">
                        <p>Não encontramos seu CNPJ em nossa base de dados. Isso quer dizer que você ainda não é um Ponto ou Pontão de Cultura certificado, mas basta continuar para fazer sua autodeclaração e entrar na Rede Cultura Viva.</p>
                        <button type="submit" class="btn btn_active btn_continuar">Continuar</button>
                         <a href="#" class="ja-sou js-modal">Já sou um Ponto ou Pontão de Cultura. Por que isto aconteceu? <span>?</spa></a>
                    </div>
                </form>
            </div>
        </div>

    </article>
    <hr />
    <article>

        <div class="row">
            <div class="colunm1 criterios">
                <h4>Critérios para a Autodeclaração</h4>
                <p>Aqui estão algumas coisas que você precisa saber antes de autodeclarar seu Ponto de Cultura: </p>
                <div class="js-icons">
                    <span class="icon-user ic1 active"></span>
                    <span class="icon-vcard ic2"></span>
                    <span class="icon-picture ic3"></span>
                    <span class="icon-book-open ic4"></span>
                    <span class="icon-mail-read ic5"></span>
                    <span class="icon-pencil ic6"></span>
                    <span class="icon-publish ic7"></span>
                </div>
            </div>
            <div class="colunm1">
                <div class="slide js-user sl1">
                    <span class="icon-user"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
                <div class="slide js-vcard sl2">
                    <span class="icon-vcard"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
                <div class="slide js-picture sl3">
                    <span class="icon-picture"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
                <div class="slide js-book-open sl4">
                    <span class="icon-book-open"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
                <div class="slide js-mail-read sl5">
                    <span class="icon-mail-read"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
                <div class="slide js-pencil sl6">
                    <span class="icon-pencil"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
                <div class="slide js-publish sl7">
                    <span class="icon-publish"></span>
                    <h4>Dados do Responsável</h4>
                    <p>Dados Básicos do Responsável pelo Cadastro: Nome completo do responsável pelo cadastro, contatos, redes sociais, entre outras informações</p>
                </div>
            </div>
        </div>
    </article>
    <section class="modal">
        <div class="modal-content">
            <a class="js-close-modal">x</a>
            <h6><span>?</span> Já sou um Ponto ou Pontão de Cultura. Por que isso aconteceu?</h6>
            <p>Se você colocou o CNPJ da instituição e o mesmo não foi localizado, isso significa que não possuímos as informações de sua entidade em nossa base de dados e necessitamos que você preencha as informações para a complementação do cadastro. Isso acontece porque apesar de a Secretaria da Cidadania e da Diversidade Cultural reconhecer todas as formas de Ponto de Cultura, o banco de dados de Pontos e Pontões conveniados diretamente com o Minc e/ou coneniados com as Redes não está completo. Agora, com a nova Política Nacional de Cultura Viva, todos os Pontos de Cultura serão contemplados no Cadastro.</p>
            <p>Se ainda tem dúvidas, entre em contato conosco em <a href="#">email@email.com</a></p>
        </div>
    </section>
</section>

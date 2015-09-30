<?php
    $this->bodyProperties['ng-app'] = "culturaviva";
    $this->layout = 'cadastro';
    $this->cadastroTitle = 'Fale mais sobre seu ponto';
    $this->cadastroText = 'Queremos entender melhor quais são as atividades realizadas pelo seu Ponto e quem é o público que as frequenta';
    $this->cadastroIcon = 'icon-vcard';
    $this->cadastroPageClass = 'ponto-mais page-base-form';
    
?>

<form ng-controller="ResponsibleCtrl">
    <div class="form">
        <h4>Informações Obrigatórias</h4>
        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Em qual edital do Ministério da Cultura a entidade/coletivo já foi contemplado? <i>?</i><br>(Pode escolher mais de uma opção)</span>
            </label>
            <taxonomy-checkboxes taxonomy="contemplado_edital" entity="agent" terms="termos.contemplado_edital"></taxonomy-checkboxes>
        </div>
        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Quais são as ações estruturantes do Ponto/Pontão de Cultura? <i>?</i><br>(Pode escolher mais de uma opção)</span>
            </label>
            <taxonomy-checkboxes taxonomy="acao_estruturante" entity="agent" terms="termos.acao_estruturante"></taxonomy-checkboxes>
        </div>
        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Quais são as áreas do Ponto/Pontão de Cultura? <i>?</i><br>(Pode escolher mais de uma opção)</span>
            </label>
            <taxonomy-checkboxes taxonomy="area" entity="agent" terms="termos.area" restricted-terms="true"></taxonomy-checkboxes>
        </div>
        <div class="row">
            <label class="colunm-full">
                <span class="destaque">Quais os públicos que participam das ações do Ponto/Pontão de Cultura? <i>?</i><br>(Pode escolher mais de uma opção)</span>
            </label>
            <taxonomy-checkboxes taxonomy="publico_participante" entity="agent" terms="termos.publico_participante"></taxonomy-checkboxes>
        </div>
        <div class="row">
            <h4>Rede Colaborativa</h4>
            <p>O Ponto/Pontão de Cultura só se realiza plenamente quando se articula em rede. Agir em rede é interagir em um universo de troca e colaboração mútua. Espaços, serviços, equipamentos, atividades, conexão, aquilo que o Ponto/Pontão tem, somado ao que o outro pode oferecer, multiplicam as possibilidades da rede e gera uma outra economia viva,  colaborativa e transformadora. </p>
            <span class="destaque">O que o Ponto/Pontão de Cultura pode oferecer para a rede?*</span>
            <label class="colunm-full">
                <span class="destaque">Infra-Estrutura*</span>
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" >  Acesso à internet 
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Sala de aula
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Auditório 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Teatro
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Estúdio
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Palco
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Galpão
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Hackerspace
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Casa 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Apartamento
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Cozinha
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Garagem
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Jardim
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Bar
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Laboratório
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Gráfica
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Loja
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Outros Espaços. 
            </label>
            <span class="destaque">Equipamentos*</span>
            <label class="colunm1">
                <input type="checkbox" name="" > Câmera fotográfica
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Câmera filmadora
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Microfone 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Fone de Ouvido
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Boom
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Spot de luz 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Refletor
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Mesa de Som
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Caixa de Som
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Instrumento Musical
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Computador
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Mesa de Edição
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Impressora
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Scanner
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Outros. Quais? 
            </label>
            <span class="destaque">Recursos Humanos</span>
            <label class="colunm1">
                <input type="checkbox" name="" > Ator / Atriz
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Dançarino / Dançarina
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Músico / Musicista 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Pesquisador
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Oficineiro
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Produtor 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Elaborador de Projeto Cultural
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Captador de Recursos
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Realizador audiovisual (Videomaker) 
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Designer
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Fotógrafo 
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Hacker
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Hacker
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Iluminador
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Sonorizador
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Maquiador
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Cenógrafo
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Eletricista
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Bombeiro Hidráulico
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Consultor
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Palestrante
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Rede Médica Solidária
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Outros. Quais?
            </label>
            <span class="destaque">Hospedagem</span>
            <label class="colunm1">
                <input type="checkbox" name="" > Convênio com Rede Hoteleira
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Hospedagem Solidária
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Camping
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Outros. Quais?
            </label>
            <span class="destaque">Deslocamento/Transportes</span>
            <label class="colunm1">
                <input type="checkbox" name="" > Passagem Aérea
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Carona, Veículo
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Passagem Terrestre
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Outros. Quais?
            </label>
            <span class="destaque">Serviços de Comunicação</span>
            <label class="colunm1">
                <input type="checkbox" name="" > Assessoria de Imprensa
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Produção de Conteúdo e Mobilização nas Redes Sociais
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Produção de Conteúdo e Informação
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Jornalismo
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Audiovisual
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Fotografia
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Desenvolvimento Web
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Mídia Comunitária
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Design
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Outros. Quais?
            </label>
            <span class="destaque">Outros recursos (descreva outros itens que o Ponto/Pontão de Cultura tem disponível e não estavam especificados acima):</span>
            <label class="colunm-full">
            <textarea></textarea >
            </label>
        </div>
        <div class="row">
            <h4>Conhecimento em Rede!</h4>
            <p>Pontos e Pontões de cultura também são formadores e multiplicadores de cultura. Esta parte do cadastro visa conectar conhecimentos e metodologias educativas,  de formação e aprendizagem desenvolvidas pelos Pontos e Pontões de Cultura, gerando uma grande Rede de Formação Livre Cultura Viva.</p>
            <p>O objetivo é mapear e sistematizar iniciativas de formação - formais e não formais, empíricas e teóricas, ancestrais e contemporâneas, urbanas e rurais - a fim de facilitar e ampliar as trocas de conhecimento na rede.</p>
            <p>As informações registradas neste cadastro farão parte de um banco de dados acessível a todos os Pontos e Pontões de Cultura, com o objetivo de estimular o intercâmbio de saberes.</p>
            <p>Este  mapeamento prioriza as experiências produtivas no campo cultural e está dividido em 03 categorias:</p>
            <span class="destaque">1) Formadores: </span>
            <p>Formadores, professores, pesquisadores, mestres e mestras das culturas populare e tradicionais, arte-educadores e  investigadores que atuem no campo da cultura. </p>
            <span class="destaque">2) Espaços de Aprendizagem: </span>
            <p>Espaços culturais, sedes, eventos de formação e plataformas que possam ser consideradas espaços de aprendizagem.</p>
            <span class="destaque">3) Metodologias:</span>
            <p>Experiências de formação e aprendizagem, vivências, oficinas, cursos, palestras, dinâmicas de troca de conhecimento, entre outras metodologias.</p>
            <span class="destaque">Categoria da inscrição:</span>
            <span class="destaque"> Formadores</span>
            <strong>FORMADOR 1</strong>
            <label class="colunm-full">
                <span>Nome</span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Email: </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Telefone: </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Áreas de atuação (oficinas/atividades ministradas):</span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Descrição/Mini-bio:  </span>
                <input type="text">
            </label>
            <span class="destaque redessociais">Seu perfil nas redes sociais: <i>?</i></span>
            <label class="colunm-redes facebook">
                <span><i class="icon icon-facebook-squared"></i> Seu perfil no Facebook</span>
                <input type="text" ng-blur="save_field('facebook')" ng-model="agent.facebook" placeholder="http://"/>
            </label>

            <label class="colunm-redes twitter">
                <span><i class="icon icon-twitter"></i> Seu perfil no Twitter</span>
                <input type="text" ng-blur="save_field('twitter')" ng-model="agent.twitter" placeholder="http://"/>
            </label>

            <label class="colunm-redes googleplus">
                <span><i class="icon icon-gplus"></i> Seu perfil no Google+</span>
                <input type="text" ng-blur="save_field('googleplus')" ng-model="agent.googleplus" placeholder="http://"/>
            </label>
            <strong>FORMADOR 2</strong>
            <label class="colunm-full">
                <span>Nome</span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Email: </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Telefone: </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Áreas de atuação (oficinas/atividades ministradas):</span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Descrição/Mini-bio:  </span>
                <input type="text">
            </label>
            <span class="destaque redessociais">Seu perfil nas redes sociais: <i>?</i></span>
            <label class="colunm-redes facebook">
                <span><i class="icon icon-facebook-squared"></i> Seu perfil no Facebook</span>
                <input type="text" ng-blur="save_field('facebook')" ng-model="agent.facebook" placeholder="http://"/>
            </label>

            <label class="colunm-redes twitter">
                <span><i class="icon icon-twitter"></i> Seu perfil no Twitter</span>
                <input type="text" ng-blur="save_field('twitter')" ng-model="agent.twitter" placeholder="http://"/>
            </label>

            <label class="colunm-redes googleplus">
                <span><i class="icon icon-gplus"></i> Seu perfil no Google+</span>
                <input type="text" ng-blur="save_field('googleplus')" ng-model="agent.googleplus" placeholder="http://"/>
            </label>
            <span class="destaque"> Espaços de Aprendizagem</span>
            <span class="destaque">Que tipo de espaço/plataforma quer registrar?</span>
            <label class="colunm-full">
                <input type="checkbox" name="" > Temporário (Por exemplo: Festival, seminário, encontro, evento digital ou presencial, entre outras)
            </label>
            <label class="colunm-full">
                <input type="checkbox" name="" > Permanente (Por exemplo:  Sede do Ponto de Cultura, espaços culturais onde podem ser realizadas atividades e processos formativos)
            </label>
            <p>Descreva o espaço (Cite atividades realizadas, público alcançado, periodicidade de ações):</p>
            <span class="destaque"> Metodologias</span>
            <strong>METODOLOGIA 1</strong>
            <label class="colunm-full">
                <span>Nome da metodologia:  </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Descrição:  </span>
                <textarea></textarea>
            </label>
            <label class="colunm-full">
                <span>Necessidades técnicas:  </span>
                <textarea></textarea>
            </label>
            <label class="colunm-full">
                <span>Capacidade de público:  </span>
                 <input type="text">
            </label>
            <label class="colunm-full">
                <span>Carga horária:  </span>
                 <input type="text">
            </label>
            <label class="colunm-full">
                <span>Possui certificação?</span>
                <input type="radio" name="certificacao"> Sim
                <input type="radio" name="certificacao"> Não  
            </label>
            <strong>Tipo de Metodologia</strong>
            <label class="colunm1">
                <input type="checkbox" name="" > Não formal
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Conhecimento popular
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Conhecimento empírico
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Outro. Qual?
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Acadêmica
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Ensino básico
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Ensino médio
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Ensino superior
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Graduação
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Pós-graduação
            </label>
            <span class="destaque">METODOLOGIA 2</span>
            <label class="colunm-full">
                <span>Nome da metodologia:  </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span>Descrição:  </span>
                <textarea></textarea>
            </label>
            <label class="colunm-full">
                <span>Necessidades técnicas:  </span>
                <textarea></textarea>
            </label>
            <label class="colunm-full">
                <span>Capacidade de público:  </span>
                 <input type="text">
            </label>
            <label class="colunm-full">
                <span>Carga horária:  </span>
                 <input type="text">
            </label>
            <strong>Tipo de Metodologia</strong>
            <label class="colunm1">
                <input type="checkbox" name="" > Não formal
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Conhecimento popular
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Conhecimento empírico
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Outro. Qual?
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Acadêmica
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Ensino básico
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Ensino médio
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Ensino superior
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Graduação
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Pós-graduação
            </label>
            <span class="destaque">Áreas de atuação</span>
            <p>Especifique a área de experiência e temas que você pode compartilhar conhecimento:*</p>
            <label class="colunm1">
                <input type="checkbox" name="" > Produção Cultural
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Artes Cênicas
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Artes Visuais
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Artesanato
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Audiovisual
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Capacitação
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Capoeira
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Contador de Histórias
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Cultura Afro
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Cultura Alimentar
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Cultura Digital
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Culturas Indígenas
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Culturas Populares
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Comunicação
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Direitos Humanos
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Esporte
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Fotografia
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Gastronomia
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Gênero 
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Hip Hop
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Juventude
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Literatura
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Meio Ambiente
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Moda
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Música
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Software Livre
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Tradição Oral
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Turismo
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Internacional
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Outros. Quais?
            </label>
            



            

        </div>
    </div>
</form>

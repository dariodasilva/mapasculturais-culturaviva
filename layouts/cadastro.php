<?php
$this->part('header');

$link = $this->cadastroLinkContinuar;
$link_continuar = $app->createUrl('cadastro', $link );
?>

<div class="page-<?php echo $this->cadastroPageClass ?>">

    <header>
        <div class="icon <?php echo $this->cadastroIcon ?>"></div>
        <h3><?php echo $this->cadastroTitle ?></h3>

<!--        <div class="circle-status c100 p56 small">
            <span>56%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
       </div>-->
    </header>

    <p><?php echo $this->cadastroText ?></p>
    <div class="btn_voltar_topo">
       <a href="<?php echo $app->createUrl('cadastro', 'index'); ?>" target="_self">voltar ao início <i class="icon icon-home"></i></a>
    </div>

    <?php echo $TEMPLATE_CONTENT; ?>
    <div class="btn_voltar">
       <a href="<?php echo $app->createUrl('cadastro', 'index'); ?>" target="_self">voltar ao início <i class="icon icon-home"></i></a>
    </div>
    <!--<button type="button" class="btn btn_continuar" data-path='<?php /*echo $link_continuar;*/?>'>Continuar >></button>-->
    <a href="<?php echo $link_continuar;  ?>" class="btn btn_continuar" target="_self">Continuar >> </a>
    <div class="clear"></div>
</div>

<?php echo $this->part('footer'); ?>

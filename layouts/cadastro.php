<?php
$this->part('header');

$link = $this->cadastroLinkContinuar;
$link_back = $this->cadastroLinkBack;

$link_continuar = $app->createUrl('cadastro', $link );
?>

<div class="page-<?php echo $this->cadastroPageClass ?>">

    <header>
        <div class="icon <?php echo $this->cadastroIcon ?>"></div>
        <h3><?php echo $this->cadastroTitle ?></h3>
    </header>

    <p><?php echo $this->cadastroText ?></p>
    <div class="btn_voltar_topo">
       <a href="<?php echo $app->createUrl('cadastro', 'index'); ?>" target="_self">voltar ao início <i class="icon icon-home"></i></a>
    </div>

    <?php echo $TEMPLATE_CONTENT; ?>

    <a href="<?php echo $link_continuar;  ?>" class="btn btn_continuar" target="_self">Continuar >> </a>
    <a href="<?php echo $app->createUrl('cadastro', $link_back);  ?>" class="btn btn_voltar" target="_self"> << Voltar </a>
    <div class="clear"></div>
</div>

<?php echo $this->part('footer'); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 hide">
            <div class="noticias-ruim">NOS DIAS 0000 VOCÊ FICARÁ SEM ÁGUA, DAS 03:00 AS 15:00h</div>
        </div>
        <div class="col-xs-12 hide"><div class="mt30"></div></div>
        <div class="col-xs-12 hide">
            <div class="noticias-boas">SEU SERVIÇO FOI REESTABELECIDO... SEU LINDO</div>
        </div>
        <div class="mt70"></div>
        <div class="col-xs-12 mt40">
            <div class="menu-topo">
                <div class="row">
                    <div class="col-xs-7 border-left">
                        SOLICITAÇÃO
                    </div>
                    <div class="col-xs-2 border-left">
                        ATENDENTE
                    </div>
                    <div class="col-xs-3">
                        RESUMO
                    </div>
                </div>
            </div>
        </div>
        <!--        Aqui        -->
        <?php foreach ($chamados as $key => $value) { ?>
            <div class="col-xs-12"><div class="mt10"></div></div>
            <div class="col-xs-12">
                <!-- <a href="<?php echo Router::url('/aberto')?>" class="link-solicitacoes"> -->
                <a href="<?php echo sprintf('chamados/%s/%d', Util::slug($value['Chamado']['descr_servico']), $value['Chamado']['id'])?>" class="link-solicitacoes">
                    <div class="row">
                        <div class="col-xs-7 border-left">
                            <div class="dt-80">
                                <div class="dt-c">
                                    <?php echo $value['Chamado']['descr_servico'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 border-left">
                            <div class="dt-80">
                                <div class="dt-c">
                                    <?php echo $value['Chamado']['atendente'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="dt-80">
                                <div class="dt-c">
                                    <?php echo $value['Chamado']['resumo'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12">
                <div class="mt10"></div>
                <div class="line-1"></div>
            </div>
        <?php }?>
    </div>
</div>
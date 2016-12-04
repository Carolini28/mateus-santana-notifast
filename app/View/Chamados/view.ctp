<div class="container p-difere text-center">
    <div class="row">
        <div class="col-xs-12"><div class="mt100"></div></div>

            <div class="col-xs-6 text-left">
                <?php echo $chamado[0]['Chamado']['descr_servico'] ?>
            </div>
            <div class="col-xs-6 text-right">
                <?php echo strftime('%A, %d de %B de %Y', strtotime('today')); ?>
            </div>
            <div class="col-xs-12">
                <div class="mt10"></div>
                <div class="line-1"></div>
                <div class="mt60"></div>
            </div>

            <?php foreach ($eventos as $key => $value): ?>

            <?php 
            
                $mes = '';
                $data = explode("-", $value['EventoChamado']['data']); 
                $horario = explode(" ", $data[2]);
                $hora = explode(":", $horario[1]);

                foreach ($arr_meses as $key => $values) {
                   if($key == $data[1]){
                        $mes = $values;
                   }
                }
            ?>    
                
            
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-5 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <?php echo $value['EventoChamado']['descricao'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <?php echo $horario[0]  ?> de <?php echo $mes ?>  de <?php echo $data[0] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <?php echo $hora[0] ?> : <?php echo $hora[1] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <ul class="list-inline estila">
                                    <li><?php 

                                            if($value['EventoChamado']['status'] == 'Realizado'){
                                                echo $this->Html->image('ok.png'); 
                                            }else if($value['EventoChamado']['status'] == 'Informação'){
                                                echo $this->Html->image('ok4.png');    
                                            }else if($value['EventoChamado']['status'] == 'Cancelado'){
                                                 echo $this->Html->image('ok2.png');   
                                            }else{
                                                 echo $this->Html->image('ok3.png');   
                                            }
                                        ?>
                                                    
                                    </li>
                                            
                                    <li><?php echo $value['EventoChamado']['status'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach ?>
        <div class="col-xs-12">
            <div class="mt20"></div>
            <div class="line-2"></div>
            <div class="mt20"></div>
        </div>

        <!--     <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-5 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                Equipe tecnica encaminhada para consertar o problema
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                04 de dezembro de 2016
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                10:10
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <ul class="list-inline estila">
                                    <li><?php echo $this->Html->image('ok4.png'); ?></li>
                                    <li>Informação</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-xs-12">
            <div class="mt20"></div>
            <div class="line-2"></div>
            <div class="mt20"></div>
        </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-5 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                Equipe tecnica remanejada, houve um emprevisto em um hospital
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                04 de dezembro de 2016
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                12:10
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <ul class="list-inline estila">
                                    <li><?php echo $this->Html->image('ok2.png'); ?></li>
                                    <li>Cancelado</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-xs-12">
            <div class="mt20"></div>
            <div class="line-2"></div>
            <div class="mt20"></div>
        </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-5 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                Problema resolvido
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                04 de dezembro de 2016
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 border-left">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                17:10
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="dt-alinha">
                            <div class="dt-c">
                                <ul class="list-inline estila">
                                    <li><?php echo $this->Html->image('ok3.png'); ?></li>
                                    <li>AVISO</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-xs-12">
            <div class="mt20"></div>
            <div class="line-2"></div>
            <div class="mt20"></div>
        </div>
 -->
        <div class="col-xs-12"><div class="mt100"></div></div>
    </div>
</div>
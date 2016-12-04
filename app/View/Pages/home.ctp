<div class="container">
    <div class="row">
        <div class="col-md-6 col-xs-12 col-md-offset-3 mt60">
            <?php echo $this->Form->create('Cliente', array('class' => 'form-entrar', 'inputDefaults' => array('div' => false, 'label' => false))); ?>
<!--            <div class="row">-->
                <div class="col-xs-12">
                    <div class="row">
                        <div class="form-aqui text-center">
                            <h1>Entre</h1>
                            <div class="mt30"></div>
                            <a href="<?php echo $fb_loginUrl; ?>" class="link-do-face">Logue pelo Facebook</a>
                            <div class="mt10"></div>
                            <p>ou</p>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('cpf', array('placeholder' => 'CPF', 'class' => 'cpf')); ?>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('numero_ligacao', array('placeholder' => 'Nº da Ligação', 'class' => 'numero')); ?>
                            <div class="mt30"></div>
                            <?php echo $this->Form->submit('Entrar'); ?>
                        </div>
                    </div>
                </div>
<!--            </div>-->
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<?php $this->append('script'); ?>
<script>
    $(document).ready(function(){
        $('.cpf').mask('000.000.000-00');
        $('.numero').mask('00000000-0');
    });
</script>
<?php $this->end(); ?>

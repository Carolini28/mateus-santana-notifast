<div class="container">
    <div class="row">
        <div class="col-md-6 col-xs-12 col-md-offset-3 mt60">
            <?php echo $this->Form->create('Cliente', array('class' => 'form-entrar', 'inputDefaults' => array('div' => false, 'label' => false))); ?>
<!--            <div class="row">-->
                <div class="col-xs-12">
                    <div class="row">
                        <div class="form-aqui text-center">
                            <h1>Complete seu cadastro</h1>
                            <div class="mt30"></div>
                            <?php echo $this->Form->input('cpf', array('placeholder' => 'CPF', 'class' => 'cpf')); ?>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('numero_ligacao', array('placeholder' => 'Nº da Ligação', 'class' => 'numero')); ?>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('nome', array('placeholder' => 'Nome', 'class' => '')); ?>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('email', array('placeholder' => 'E-mail', 'class' => '')); ?>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('telefone', array('placeholder' => 'Telefone', 'class' => 'tel')); ?>
                            <div class="mt10"></div>
                            <?php echo $this->Form->input('celular', array('placeholder' => 'Celular', 'class' => 'cel')); ?>
                            <div class="mt10"></div>
                            <p>Deseja receber informações sobre seus futuros débitos?</p>
                            <div class="text-center">
                                <label for="infDeb"><input type="radio" name="data[Cliente][info_debitos]" id="infDeb" value="1" <?php echo (isset($this->request->data['Cliente']['info_debitos']) && $this->request->data['Cliente']['info_debitos'] ? 'checked="checked"' : ''); ?>> Sim</label>
                                <label for="infDebn"><input type="radio" name="data[Cliente][info_debitos]" id="infDebn" value="0" <?php echo (isset($this->request->data['Cliente']['info_debitos']) && !$this->request->data['Cliente']['info_debitos'] ? 'checked="checked"' : ''); ?>> Não</label>
                            </div>
                            <div class="mt10"></div>
                            <p>E notificações por SMS? (Refere-se às notificações de suas solicitações)</p>
                            <div class="text-center">
                                <label for="infDeb2"><input type="radio" name="data[Cliente][info_sms]" id="infDeb2" value="1" <?php echo (isset($this->request->data['Cliente']['info_sms']) && $this->request->data['Cliente']['info_sms'] ? 'checked="checked"' : ''); ?>> Sim</label>
                                <label for="infDebn2"><input type="radio" name="data[Cliente][info_sms]" id="infDebn2" value="0" <?php echo (isset($this->request->data['Cliente']['info_sms']) && !$this->request->data['Cliente']['info_sms'] ? 'checked="checked"' : ''); ?>> Não</label>
                            </div>
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
        $('.tel').mask('(00) 0000-0000');
        $('.cel').mask('(00) 00000-0000');
    });
</script>
<?php $this->end(); ?>

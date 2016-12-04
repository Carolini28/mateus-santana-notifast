<div class="container">
    <div class="row">
        <br />Fomulario de contato<br />
<!--         <form id="form1" action="send.php" method="post" name="form1"> -->
        <?php echo $this->Form->create('Cliente',array('inputDefaults' => array('div' => false, 'label' => false),'class' => 'form-dentro', 'url' => Router::url(array('controller' => 'clientes', 'action' => 'index'), true) ));
        ?>
            <h1>Fomulário de contato</h1>
 
            <label for="nome">Nome</label>
            <input id="nome" type="text" name="nome" />
 
            <label for="email">E-mail</label>           
            <input id="email" type="text" name="email" />
 
<!--             <label for="mensagem">Mensagem</label> -->
<!--             <textarea id="mensagem" cols="45" name="mensagem" rows="5"></textarea> -->
<!--             <input id="button" type="submit" name="button" value="Enviar" /> -->
            <?php echo $this->Form->submit('Enviar',array('value' => 'Enviar','class' => 'link-home-dente')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
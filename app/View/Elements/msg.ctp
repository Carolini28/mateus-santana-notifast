<?php
$_id = Security::hash(time());
if (!isset($class)) :
    $class = "";
else : 
    $class = "alert-{$class}";
endif;
if (!isset($hide)) :
	$hide = true;
endif;
?>
<div id="<?php echo $_id; ?>" class="alert alert-block <?php echo $class; ?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message; ?>
</div>
<?php if ($hide) : ?>
<script type="text/javascript">
	setTimeout(function(){
		jQuery('#<?php echo $_id; ?>').fadeOut('slow');
	}, 2000);
</script>
<?php endif; ?>
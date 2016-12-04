<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Águas Guarirobas</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('stylesheet');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.mask');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
<header>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php echo $this->Html->link($this->Html->image('logo.jpg'), '/', array('escape' => false)); ?>
			</div>
		</div>
	</div>
</header>
<div class="container">
	<div class="row">
		<?php echo $this->Session->flash(); ?>
	</div>
</div>
<?php
	echo $this->fetch('content');
?>
<footer>
	<div class="mt100"></div>
	UpSort &copy; 2016
</footer>
<?php
	echo $this->fetch('script');
?>
<script>
	$(document).ready(function(){
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	});
</script>
</body>
</html>

<?php
        if(!defined('PATH')){die('Access denied.');}
	$titleName='Error !';
	include_once(PATH.'tpl/header.php');
?>
		<div>Error: <?php echo $errInfo;?></div>
<?php include_once(PATH.'tpl/footer.php');
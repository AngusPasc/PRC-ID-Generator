<?php
        if(!defined('PATH')){die('Access denied.');}
	$titleName='验证结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/header.php');
?>
		<div>根据计算，您提供的身份证号码：<?php echo $inputIDNum; ?> 存在一些问题。</div>
		<div>
<?php echo $eArrS;?>
		</div>
		<div>
			<a href="<?php echo SURL;?>?act=firstpage">返回</a>
		</div>
<?php
include_once(PATH.'tpl/footer.php');
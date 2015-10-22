<?php
        if(!defined('PATH')){die('Access denied.');}
	$titleName='验证结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/header.php');
?>
		<div>根据计算，您输入的身份证号码：<?php echo $inputIDNum; ?>是一个有效的身份证号码。</div>
		<div>
			该身份证发证所在地：<?php echo $placesArr[$placeId];?>。
			<br />
			该身份证的持有人出生日期：<?php echo $birthDate[0];?>年<?php echo $birthDate[1];?>月<?php echo $birthDate[2];?>日。
			<br />
			该身份证的持有人是<?php echo $sex;?>性。
		</div>
		<div>
			<a href="<?php echo SURL;?>?act=firstpage">返回</a>
		</div>
<?php
include_once(PATH.'tpl/footer.php');
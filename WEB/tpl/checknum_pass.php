<?php
	if(!defined('PATH'))die('Access denied.');
	$titleName='验证结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/head.php');
echo <<<EOF
		<div>根据计算，您输入的身份证号码：{$_REQUEST['ipt_idn']}是一个有效的身份证号码。</div>
		<div>
			该身份证发证所在地：{$placesArr[$placeId]}。
			<br />
			该身份证的持有人出生日期：{$birthDate[0]}年{$birthDate[1]}月{$birthDate[2]}日。
			<br />
			该身份证的持有人是{$sex}性。
		</div>
		<div>
			<a href="{$_SERVER['PHP_SELF']}?act=firstpage">返回</a>
		</div>
EOF;
include_once(PATH.'tpl/foot.php');
<?php
	if(!defined('PATH'))die('Access denied.');
	$titleName='验证结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/head.php');

echo <<<EOF
		<div>根据计算，您提供的身份证号码：{$_REQUEST['ipt_idn']} 存在一些问题。</div>
		<div>
{$eArrS}
		</div>
		<div>
			<a href="{$_SERVER['PHP_SELF']}?act=firstpage">返回</a>
		</div>
EOF;
include_once(PATH.'tpl/foot.php');
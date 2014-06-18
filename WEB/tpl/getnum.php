<?php
	if(!defined('PATH'))die('Access denied.');
	$titleName='生成结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/head.php');
echo <<<EOF
		<div>
			得到的身份证号：
			<br />
			<input type="text" value="{$gtdID}" size="18" />
			<br />
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				<input type="hidden" name="act" value="getnum" />
				<input type="hidden" name="ipt_loc" value="{$_REQUEST['ipt_loc']}" />
				<input type="hidden" name="ipt_bth" value="{$_REQUEST['ipt_bth']}" />
				<input type="hidden" name="ipt_sex" value="{$_REQUEST['ipt_sex']}" />
				<input type="submit" value="换一个" />
			</form>
			{$esStr}
		</div>
EOF;
include_once(PATH.'tpl/foot.php');
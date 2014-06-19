<?php
	if(!defined('PATH'))die('Access denied.');
	$titleName='生成结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/head.php');
echo <<<EOF
		<div>
			得到的身份证号：
			<br />
			身份证号码信息：
			<br />
			发证单位：{$idInfo[0]}
			<br />
			出生日期：{$idInfo[1]}
			<br />
			性别：{$idInfo[2]}
			<br />
			身份证号码：
			<br />
			<input type="text" value="{$gtdID}" size="18" />
			<br />
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				<input type="hidden" name="act" value="getnum" />
				<input type="hidden" name="ipt_loc" value="{$_REQUEST['ipt_loc']}" />
				<input type="hidden" name="ipt_bth" value="{$_REQUEST['ipt_bth']}" />
				<input type="hidden" name="ipt_sex" value="{$_REQUEST['ipt_sex']}" />
				<input type="submit" name="useInput" value="换一个(同地区同生日)" />
				&nbsp;&nbsp;
				<input type="submit" name="useRandom" value="换一个(随机地区随机生日)" />
			</form>
			{$esStr}
		</div>
		<div>
			<a href="{$_SERVER['PHP_SELF']}?act=firstpage">返回</a>
		</div>
EOF;
include_once(PATH.'tpl/foot.php');
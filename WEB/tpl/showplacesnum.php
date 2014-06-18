<?php
	if(!defined('PATH'))die('Access denied.');
	$titleName='地区编号列表';
	include_once(PATH.'tpl/head.php');
?>
	<div>
<?php
foreach($showArr as $k=>$v)echo "\t\t\t{$k}-{$v}\n\t\t\t<br />\n";
echo <<<EOF
		</div>
		<div>
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				{$pageRes}
				<br />
				<input type="text" value="{$_REQUEST['p']}" size="3" />
				<input type="hidden" name="act" value="showplacesnum" />
				<input type="submit" value="&gt;&gt;" />
			</form>
		</div>
EOF;
include_once(PATH.'tpl/foot.php');
?>
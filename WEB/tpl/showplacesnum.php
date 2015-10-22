<?php
        if(!defined('PATH')){die('Access denied.');}
	$titleName='地区编号列表';
	include_once(PATH.'tpl/header.php');
?>
	<div>
<?php
foreach($showArr as $k=>$v){echo "\t\t\t{$k}-{$v}\n\t\t\t<br />\n";}
?>
		</div>
		<div>
                    <form action="<?php echo SURL;?>" method="post">
				<?php echo $pageRes;?>
				<br />
                                <input type="text" value="<?php echo $currentPage;?>" size="3" />
				<input type="hidden" name="act" value="showplacesnum" />
				<input type="submit" value="&gt;&gt;" />
			</form>
		</div>
<?php
include_once(PATH.'tpl/footer.php');
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
				<?php
				  # 翻页导航生成部分
					$pagerAmount=3;
					$pagerMinNumber=$currentPage-$pagerAmount<1?1:$currentPage-$pagerAmount;
					$pagerMaxNumber=$currentPage+$pagerAmount>$maxPageNum?$maxPageNum:$currentPage+$pagerAmount;
					$pageRes='';
					for($i=$pagerMinNumber;$i<=$pagerMaxNumber;$i++){ ?>
						<a href="<?php echo SURL;?>?act=showplacesnum&amp;p=<?php echo $i; ?>"><?php echo $i; ?></a>&nbsp;
					<?php } ?>
				<?php echo $pageRes;?>
				<br />
				当前第<?php echo $currentPage;?>页，共<?php echo $maxPageNum;?>页。
				<br />
				<input type="text" value="<?php echo $currentPage;?>" size="3" />
				<input type="hidden" name="act" value="showplacesnum" />
				<input type="submit" value="&gt;&gt;" />
			</form>
		</div>
<?php
include_once(PATH.'tpl/footer.php');
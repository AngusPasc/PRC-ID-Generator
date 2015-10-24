<?php
        if(!defined('PATH')){die('Access denied.');}
	$titleName='生成结果：中国大陆身份证号码计算工具';
	include_once(PATH.'tpl/header.php');
?>
		<div>
			得到的身份证号：
			<br />
			身份证号码信息：
			<br />
			发证单位：<?php echo $idInfo[0];?>
			<br />
			出生日期：<?php echo $idInfo[1];?>
			<br />
			性别：<?php echo $idInfo[2];?>
			<br />
			身份证号码：
			<br />
                        <input type="text" value="<?php echo $gtdID;?>" size="18" />
			<br />
			<form action="<?php echo SURL;?>" method="post">
				<input type="hidden" name="act" value="getnum" />
                                <input type="hidden" name="ipt_loc" value="<?php echo $locationNum;?>" />
                                <input type="hidden" name="ipt_bth" value="<?php echo $inputBirthDate;?>" />
                                <input type="hidden" name="ipt_sex" value="<?php echo $inputSex;?>" />
				<input type="submit" name="useInput" value="换一个(同地区同生日)" />
				&nbsp;&nbsp;
				<input type="submit" name="useRandom" value="换一个(随机地区随机生日)" />
			</form>
			<?php echo $esStr;?>
		</div>
		<div>
                    <a href="<?php echo SURL;?>?act=firstpage">返回</a>
		</div>
<?php
include_once(PATH.'tpl/foot.php');
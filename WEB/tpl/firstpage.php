<?php
if(!defined('PATH')){die('Access denied.');}
$titleName='中国大陆身份证号码计算工具';
include_once(PATH.'tpl/head.php');
?>
		<div>
			请在下面输入相应的数据：
			<form action="<?php echo SURL;?>" method="post">
				生成一个身份证号码：
				<br />
				<input type="hidden" name="act" value="getnum" />
				地区编码（6位数字）：
                                <input name="ipt_loc" type="text" value="<?php echo $setdLoc;?>" size="10" maxlength="6" />
				<br />
				<a href="<?php echo SURL;?>?act=showplacesnum" target="_blank">查看地区编码表</a> - <a href="<?php echo SURL;?>?act=downloadPlacesNumList" target="_blank">下载地区编码表</a>
				<br />
				生日日期（8位数字）：
				<input name="ipt_bth" type="text" size="10" maxlength="8" />
				<br />
				性别（请选择）：
				<br />
				<input type="radio" name="ipt_sex" value="0" checked="checked" />男/<input type="radio" name="ipt_sex" value="1" />女
				<br />
				<input type="submit" name='useInput' value="生成(使用输入值)" />
				&nbsp;&nbsp;
				<input type="submit" name='useRandom' value="生成(使用随机值)" />
			</form>
			<br />
			<form action="<?php echo SURL;?>" method="post">
				检验一个身份证号：
				<br />
				<input type="hidden" name="act" value="checkNum" />
				请输入身份证号码：
				<br />
				<input type="text" name="ipt_idn" size="18" />
				<br />
				<input type="submit" value="验证" />
			</form>
		</div>
<?php
include_once(PATH.'tpl/foot.php');
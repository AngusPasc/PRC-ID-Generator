<?php
function fixNum($iNum,$n){
	$m=strlen($iNum);
	for($i=0;$i<$n-$m;$i++)
		$iNum="0".$iNum;
	return $iNum;
}
function getCheck($idNum){
	$xs=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
	$lst='10X98765432';
	$sumOfId=0;
	for($i=0;$i<17;$i++)
		$sumOfId+=intval($idNum[$i])*$xs[$i];
	return $lst[$sumOfId%11];
}
function genID($location,$birth,$sex,$randNum,&$gdId){
	if(!preg_match("~\d{6}~U",$location))
		return -1;
	elseif(!preg_match("~\d{4}\d{2}\d{2}~U",$birth,$birthmchs))
		return -2;
	elseif($randNum>999)
		return -3;
	if($randNum<0){
		$randNum=rand(0,499)*2;
		if($sex==0)$randNum+=1;
	}
	$aldIs=$location.$birth.fixNum($randNum,3);
	$gdId=$aldIs.getCheck($aldIs);
	return 0;
}
function reportErr($errInfo){
	header('Content-Type:text/html; charset=UTF-8');
	echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<title>Error!</title>
	<body>
		<p>Error: {$errInfo}</p>
	</body>
</html>
EOF;
}
$pact=isset($_REQUEST['act'])?$_REQUEST['act']:'firstpage';
switch($pact){
	case 'firstpage':
		$setdLoc=isset($_REQUEST['ipt_usp'])?$_REQUEST['ipt_usp']:'';
		header('Content-Type:text/html; charset=UTF-8');
		echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<title>中国大陆身份证号码计算工具</title>
	<body>
		<p>
			请在下面输入相应的数据：
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				<input type="hidden" name="act" value="getnum" />
				<br />
				地区编码（6位数字）：
				<input name="ipt_loc" type="text" value="{$setdLoc}" size="10" maxlength="6" />
				<br />
				<a href="{$_SERVER['PHP_SELF']}?act=showplacesnum" target="_blank">查看地区编码表</a> - <a href="{$_SERVER['PHP_SELF']}?act=downloadPlacesNumList" target="_blank">下载地区编码表</a>
				<br />
				生日日期（8位数字）：
				<input name="ipt_bth" type="text" size="10" maxlength="8" />
				<br />
				性别（请选择）：
				<br />
				<input type="radio" name="ipt_sex" value="0" checked="checked" />男/<input type="radio" name="ipt_sex" value="1" />女
				<br />
				<input type="submit" value="生成" />
			</form>
		</p>
	</body>
</html>
EOF;
		break;
	case 'showplacesnum':
		if(!is_readable('Places'))
			reportErr('File: `Places` not found on this server!');
		else{
			$fp=fopen('Places','r');
			#$ctn=false;
			header('Content-Type: text/html; charset=UTF-8');
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html>\n\t<title>地区编号列表</title>\n\t<body>\n\t\t<p>\n";
			while(!feof($fp)){
				$tsl=trim(fgets($fp));
				echo "\t\t\t{$tsl}\n\t\t\t<br />\n";
			}
			fclose($fp);
			echo "\t\t</p>\n\t</body>\n</html>";
		}
		break;
	case 'getnum':
		genID(intval($_REQUEST['ipt_loc']),intval($_REQUEST['ipt_bth']),intval($_REQUEST['ipt_sex']),-1,$gtdID);
		header('Content-Type:text/html; charset=UTF-8');
		echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<title>生成结果：中国大陆身份证号码计算工具</title>
	<body>
		<p>
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
		</p>
	</body>
</html>
EOF;
		break;
	case "downloadPlacesNumList":
		header('Content-Type: application/octet-stream');
		header('Connection: close');
		header('Content-Disposition: attachment; filename="IDPlaceListOfChina.txt"');
		header('Content-Length: '.filesize('Places'));
		$fp=fopen('Places','rb');
		while(!feof($fp)){
			echo fread($fp,8192);
			flush();
		}
		fclose($fp);
		break;
	default:
		reportErr('Unexcepted user action got.');
		break;
}
exit;
?>

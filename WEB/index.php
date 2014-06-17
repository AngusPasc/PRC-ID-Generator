<?php
require_once('places.php');
require_once('chsname.php');
function daysInMonth($year,$month){
	if($month==2){
		if(($year/4==0 and $year/100<>0) or $year/400==0)
			return 29;
		else
			return 28;
	}elseif($month<8 and $month%2)
		return 31;
	elseif(!$month/2)
		return 31;
	else
		return 30;
}
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
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>Error!</title>
	</head>
	<body>
		<div>Error: {$errInfo}</div>
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
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>中国大陆身份证号码计算工具</title>
	</head>
	<body>
		<div>
			请在下面输入相应的数据：
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				生成一个身份证号码：
				<br />
				<input type="hidden" name="act" value="getnum" />
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
			<br />
			<form action="{$_SERVER['PHP_SELF']}" method="post">
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
	</body>
</html>
EOF;
		break;
	case 'showplacesnum':
		if(!is_readable('Places'))
			reportErr('File: `Places` not found on this server!');
		else{
			#$fp=fopen('Places','r');
			if(!isset($_REQUEST['p']) || $_REQUEST['p']=='' || intval($_REQUEST['p'])<1)
				$_REQUEST['p']=1;
			else
				$_REQUEST['p']=intval($_REQUEST['p']);
			$itemOffset=30*$_REQUEST['p']-30;
			$totalItem=count($placesArr);
			$maxPageNum=intval($totalItem/30);
			if($totalItem%30<>0)
				$maxPageNum+=1;
			if($itemOffset>=$totalItem)
				reportErr('Page Out Of Index!');
			if($_REQUEST['p']<$maxPageNum){
				if($_REQUEST['p']>1)
					$pageRes="<a href=\"{$_SERVER['PHP_SELF']}?act=showplacesnum&amp;p=".($_REQUEST['p']-1)."\">&lt;&lt;上一页</a>-<a href=\"{$_SERVER['PHP_SELF']}?act=showplacesnum&amp;p=".($_REQUEST['p']+1)."\">下一页&gt;&gt;</a>";
				else
					$pageRes="<a href=\"{$_SERVER['PHP_SELF']}?act=showplacesnum&amp;p=".($_REQUEST['p']+1)."\">下一页&gt;&gt;</a>";
			}else
				$pageRes="<a href=\"{$_SERVER['PHP_SELF']}?act=showplacesnum&amp;p=".($_REQUEST['p']-1)."\">&lt;&lt;上一页</a>";
			$showArr=array_slice($placesArr,$itemOffset,30,true);
			header('Content-Type: text/html; charset=UTF-8');
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\n\t<head>\n\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n\t\t<title>地区编号列表</title>\n\t</head>\n\t<body>\n\t\t<div>\n";
			foreach($showArr as $k=>$v)
				echo "\t\t\t{$k}-{$v}\n\t\t\t<br />\n";
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
	</body>
</html>
EOF;
		}
		break;
	case 'getnum':
		genID(intval($_REQUEST['ipt_loc']),intval($_REQUEST['ipt_bth']),intval($_REQUEST['ipt_sex']),-1,$gtdID);
		header('Content-Type:text/html; charset=UTF-8');
		echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>生成结果：中国大陆身份证号码计算工具</title>
	</head>
	<body>
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
		</div>
	</body>
</html>
EOF;
		break;
	case "checkNum":
		$_REQUEST['ipt_idn']=strtoupper($_REQUEST['ipt_idn']);
		$summery=array();
		if(!preg_match('~^\d{17}[\dX]$~s',$_REQUEST['ipt_idn']))
			$summery[]='注意：您输入的不符合身份证号码特征，身份证号应该为18位数字或者17位数字+X';
		else{
			$checkNum=getCheck($_REQUEST['ipt_idn']);
			$placeId=intval(substr($_REQUEST['ipt_idn'],0,6));
			$birthDate=array(substr($_REQUEST['ipt_idn'],6,4),substr($_REQUEST['ipt_idn'],10,2),substr($_REQUEST['ipt_idn'],12,2));
			if(!isset($placesArr[$placeId]) || !$placesArr[$placeId])
				$summery[]='这个身份证号码的地区编码属于未知地区。';
			if($birthDate[1]<13 && $birthDate[2]<32){
				if($birthDate[0]<date('Y')-101)
					$summery[]='注意：此身份证号码的主人的年龄已经超出了100岁！';
				elseif($birthDate[0].$birthDate[1].$birthDate[2]>date('Ymd'))
					$summery[]='注意：此身份证号码的主人可能还未出生！';
				else{
					if(daysInMonth($birthDate[0],$birthDate[1])<$birthDate[2])
						$summery[]="在{$birthDate[0]}年{$birthDate[1]}月没有{$birthDate[2]}日！";
				}
			}else
				$summery[]='身份证号指定的日期不规范！';
			if($_REQUEST['ipt_idn'][17]<>$checkNum)
				$summery[]='该身份证号无法通过计算校检。';
		}
		header('Content-Type: text/html; charset=UTF-8');
		if(!count($summery)){
			$sex=intval(substr($_REQUEST['ipt_idn'],16,1))%2?'男':'女';
			echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>验证结果：中国大陆身份证号码计算工具</title>
	</head>
	<body>
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
	</body>
</html>
EOF;
		}else{
			header('Content-Type: text/html; charset=UTF-8');
			$eArrS='';
			foreach($summery as $k=>$v)
				$eArrS.="\t\t\t{$v}\n\t\t\t<br />\n";
			echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>验证结果：中国大陆身份证号码计算工具</title>
	</head>
	<body>
		<div>根据计算，您提供的身份证号码：{$_REQUEST['ipt_idn']} 存在一些问题。</div>
		<div>
{$eArrS}
		</div>
		<div>
			<a href="{$_SERVER['PHP_SELF']}?act=firstpage">返回</a>
		</div>
	</body>
</html>
EOF;
		}
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

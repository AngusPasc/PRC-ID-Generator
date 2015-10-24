<?php
# error_reporting(E_ALL);
define('PATH',dirname(__FILE__).'/');
require_once(PATH.'places.php');
# require_once('chsname.php');
define('SURL',filter_input(INPUT_SERVER,'PHP_SELF'));
# define('SURL',$_SERVER['PHP_SELF']);
if(SURL==NULL){
    die('Function `filter_input` not works properly! you can use `$_POST` `$_GET` `$_SERVER` and etc. instand if you want.');
}
$surl=SURL;
function gpr($requestKey){
        return filter_has_var(INPUT_POST,$requestKey)?filter_input(INPUT_POST,$requestKey):filter_input(INPUT_GET,$requestKey);
}
function daysInMonth($year,$month){
	if($month==2){
		if(($year%4==0 and $year%100<>0) or $year%400==0){
			return 29;
                }else{
			return 28;
                }
	}elseif($month<8 and $month%2){
		return 31;
        }elseif(!$month%2){
		return 31;
        }else{
		return 30;
        }
}
function fixNum($iNum,$n){
	$m=strlen($iNum);
	for($i=0;$i<$n-$m;$i++){
		$iNum="0".$iNum;
        }
	return $iNum;
}
function getCheck($idNum){
	$xs=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
	$lst='10X98765432';
	$sumOfId=0;
	for($i=0;$i<17;$i++){
		$sumOfId+=intval($idNum[$i])*$xs[$i];
        }
	return $lst[$sumOfId%11];
}
function genID($location,$birth,$sex,$randNum,&$gdId){
        $birthmchs=array();
	if(!preg_match("~\d{6}~U",$location)){
		return -1;
        }elseif(!preg_match("~\d{4}\d{2}\d{2}~U",$birth,$birthmchs)){
		return -2;
        }elseif($randNum>999){
		return -3;
        }
	if($randNum<0){
		$randNum=rand(0,499)*2;
                if($sex==0){$randNum+=1;}
	}
	$aldIs=$location.$birth.fixNum($randNum,3);
	$gdId=$aldIs.getCheck($aldIs);
	return 0;
}
function reportErr($errInfo){
        if($errInfo==''){$errInfo='Unknown Error!';}
	include(PATH.'tpl/reporterror.php');
	exit;
}
$pact=gpr('act');
if($pact==NULL){$pact='firstpage';}
switch($pact){
	case 'firstpage':
		$setdLoc=gpr('ipt_usp');
		include(PATH.'tpl/firstpage.php');
		break;
	case 'showplacesnum':
		if(!is_readable('Places')){
			reportErr('File: `Places` not found on this server!');
                }else{
			#$fp=fopen('Places','r');
                        $currentPage=gpr('p');
			if(!$currentPage || intval($currentPage)<1){
				$currentPage=1;
                        }else{
				$currentPage=intval($currentPage);
                        }
			$itemOffset=30*$currentPage-30;
			$totalItem=count($placesArr);
			$maxPageNum=intval($totalItem/30);
			if($totalItem%30<>0){
                            $maxPageNum+=1;
                        }
			if($itemOffset>=$totalItem){
				reportErr('Page Out Of Index!');
                        }
			if($currentPage<$maxPageNum){
				if($currentPage>1){
					$pageRes='<a href="'.SURL.'?act=showplacesnum&amp;p='.($currentPage-1).'">&lt;&lt;上一页</a>-<a href="'.SURL.'?act=showplacesnum&amp;p='.($currentPage+1).'">下一页&gt;&gt;</a>';
                                }else{
					$pageRes='<a href="'.SURL.'?act=showplacesnum&amp;p='.($currentPage+1).'">下一页&gt;&gt;</a>';
                                }
			}else{
				$pageRes='<a href="'.SURL.'?act=showplacesnum&amp;p='.($currentPage-1).'>&lt;&lt;上一页</a>';
                        }
            //show pager number
           	$show_pager_number='';
            for($i=0;$i<=$maxPageNum;$i++)
            	$show_pager_number=$show_pager_number.'<a href="'.SURL.'?act=showplacesnum&amp;p='.$i.'">'.$i.'页---</a>'; 
			$showArr=array_slice($placesArr,$itemOffset,30,true);
			include(PATH.'tpl/showplacesnum.php');
		}
		break;
	case 'getnum':
		if(gpr('useRandom')){
			$locationNum=array_rand($placesArr);
			$tmp=array(mt_rand(date('Y')-50,date('Y')-19),sprintf('%02s',mt_rand(1,12)),0);
			$tmp[2]=sprintf('%02s',mt_rand(1,daysInMonth($tmp[0],$tmp[1])));
			$inputBirthDate=implode('',$tmp);
			$inputSex=mt_rand(0,1);
		}elseif(gpr('useInput')){
			$locationNum=intval(gpr('ipt_loc'));
			$inputBirthDate=intval(gpr('ipt_bth'));
                        $inputSex=intval(gpr('ipt_sex'));
		}else{
			reportErr('Error: Neither useInput or useRandom defined.');
                }
		$genRes=genID($locationNum,$inputBirthDate,$inputSex,-1,$gtdID);
		switch($genRes){
			case 0:
				$ess=array();
				$birthDate=array(substr($inputBirthDate,0,4),substr($inputBirthDate,4,2),substr($inputBirthDate,6,2));
				$idInfo=array('未知地区',$birthDate[0].'年'.$birthDate[1].'月'.$birthDate[2].'日',$gtdID[16]%2?'男':'女');
				if(!isset($placesArr[$locationNum]) || !$placesArr[$locationNum]){
					$ess[]='注意：不能确定地区编码所在地点！';
                                }else{
					$idInfo[0]=$placesArr[$locationNum];
                                }
				if($birthDate[1]<13 && $birthDate[2]<32){
					if($birthDate[0]<date('Y')-101){
						$ess[]='注意：此身份证号码的主人的年龄已经超出了100岁！';
                                        }elseif($birthDate[0].$birthDate[1].$birthDate[2]>date('Ymd')){
						$ess[]='注意：此身份证号码的主人可能还未出生！';
                                        }else{
                                                if(daysInMonth($birthDate[0],$birthDate[1])<$birthDate[2]){
                                                    $ess[]="注意：在{$birthDate[0]}年{$birthDate[1]}月没有{$birthDate[2]}日！";
                                                }
					}
				}else{
					$ess[]='注意：身份证号指定的日期不规范！';
                                }
				$esStr=implode("\n\t\t\t<br />\n\t\t\t",$ess);
				include(PATH.'tpl/getnum.php');
				break;
			case -1:
				reportErr('地区编码必须是6位数字！');
				break;
			case -2:
				reportErr('生日日期必须是8位数字！');
				break;
			default:
				reportErr('Error Number Not Defined !');
				break;
		}
		break;
	case "checkNum":
		$inputIDNum=strtoupper(gpr('ipt_idn'));
		$summery=array();
		if(!preg_match('~^\d{17}[\dX]$~s',$inputIDNum)){
			$summery[]='注意：您输入的不符合身份证号码特征，身份证号应该为18位数字或者17位数字+X';
                }else{
			$checkNum=getCheck($inputIDNum);
			$placeId=intval(substr($inputIDNum,0,6));
			$birthDate=array(substr($inputIDNum,6,4),substr($inputIDNum,10,2),substr($inputIDNum,12,2));
			if(!isset($placesArr[$placeId]) || !$placesArr[$placeId]){
				$summery[]='这个身份证号码的地区编码属于未知地区。';
                        }
			if($birthDate[1]<13 && $birthDate[2]<32){
				if($birthDate[0]<date('Y')-101){
					$summery[]='注意：此身份证号码的主人的年龄已经超出了100岁！';
                                }elseif($birthDate[0].$birthDate[1].$birthDate[2]>date('Ymd')){
					$summery[]='注意：此身份证号码的主人可能还未出生！';
                                }else{
					if(daysInMonth($birthDate[0],$birthDate[1])<$birthDate[2]){
						$summery[]="在{$birthDate[0]}年{$birthDate[1]}月没有{$birthDate[2]}日！";
                                        }
				}
			}else{
				$summery[]='身份证号指定的日期不规范！';
                        }
			if($inputIDNum[17]<>$checkNum){
				$summery[]='该身份证号无法通过计算校检。';
                        }
		}
		header('Content-Type: text/html; charset=UTF-8');
		if(!count($summery)){
			$sex=$inputIDNum[16]%2?'男':'女';
			include(PATH.'tpl/checknum_pass.php');
		}else{
			header('Content-Type: text/html; charset=UTF-8');
			$eArrS='';
			foreach($summery as $k=>$v){
				$eArrS.="\t\t\t{$v}\n\t\t\t<br />\n";
                        }
			include(PATH.'tpl/checknum_fail.php');
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


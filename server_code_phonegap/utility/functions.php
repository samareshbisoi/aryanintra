<?php

function ShowRatingHTML($rate) {
$HTML = '';
	 $rateINT = intval($rate);
			$decimal = $rate - $rateINT; 
			 for($star=1;$star<=$rateINT;$star++) { 
			 $HTML = $HTML.'<i class="fa fa-star"></i>';
			 } 
			 
			  if($decimal > 0){ 
				$rateINT++;
				$HTML = $HTML.'<i class="fa fa-star-half-o"></i>';
				 } 
		 
		  for($star=($rateINT+1);$star<=5;$star++) { 
		  	$HTML = $HTML.'<i class="fa fa-star-o"></i>';
		   } 
	return $HTML ;	   
}

function loadVariable($name,$default)
{
	if(isset($_REQUEST[$name]))
		return $_REQUEST[$name];
	else
		return $default;
}

function pr($arr,$e=1)
{
	if(is_array($arr))
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";		
	}
	else
	{
		echo "<br>Not and array...<br>";
		echo "<pre>";
		var_dump($arr);
		echo "</pre>";
		
	}
	if($e==1)
	{
		exit();
	}
	else
	{
		echo "<br>";
	}
}


function inputEscapeString($str,$Type='DB',$htmlEntitiesEncode = true)
{
	if($Type === 'DB')
	{
		if(get_magic_quotes_gpc()===0)
		{
			$str = addslashes($str);
		}
	}
	elseif($Type === 'FILE')
	{
		if(get_magic_quotes_gpc()===1)
		{
			$str = stripslashes($str);	
		}
	}
	else
	{
		$str = $str;
	}
	
	if($htmlEntitiesEncode === true)
	{
		$str = htmlentities($str);
	}
	
	return $str;
}


function outputEscapeString($str,$Type = 'INPUT', $htmlEntitiesDecode = true )
{

	if(get_magic_quotes_runtime()==1)
	{
		$str = stripslashes($str);	
	}
	
	if($htmlEntitiesDecode === true)
	{
		$str = html_entity_decode($str);
	}
	
	if($Type == 'INPUT')
	{
		$str = htmlentities($str);
	}
	elseif($Type == 'TEXTAREA')
	{
		$str = $str;
	}
	elseif($Type == 'HTML')
	{
		$str = nl2br($str);
	}
	else
	{
		$str = $str;
	}
	
	return $str ;
}


function loadFromSession($key,$var,&$ptr)
{
	global $p;
	if(isset($_REQUEST[$var]))
	{
		if($_REQUEST[$var]<>'')
		{
			return false;
		}
	}
	if(isset($_SESSION[$key][$p][$var]))
	{
		if($_SESSION[$key][$p][$var]<>'')
		{
			$ptr = $_SESSION[$key][$p][$var];
			return true;
		}
		else
			return false;
	}
	else
		return false;
}

function checkLogout()
{
	$a=loadVariable('a','');
	if($a=="logout")
	{
		$_SESSION[SUCCESS_MSG] = "";
		$pos = strpos($_SERVER['PHP_SELF'],'webadmin');
		if($pos)
		{
			if(isset($_SESSION[ADMIN_SESSION_VAR]))
			{
				$_SESSION[ADMIN_SESSION_VAR] = "";
				unset($_SESSION[ADMIN_SESSION_VAR]);
				$_SESSION['LIST_PAGR'] = "";
				unset($_SESSION['LIST_PAGE']);
				$_SESSION[SUCCESS_MSG] = "You have successfully logged out...";
			}
		}
		else
		{
			if(isset($_SESSION[USER_SESSION_VAR]))
			{
				$_SESSION[USER_SESSION_VAR]="";
				unset($_SESSION[USER_SESSION_VAR]);
				$_SESSION[SUCCESS_MSG] = "You have successfully logged out...";
			}
		}
		
		
	}
}

function showMessage()
{
	if(isset($_SESSION[SUCCESS_MSG]))
	{
		if($_SESSION[SUCCESS_MSG] <> "")
		{
			//echo "<p><font color='#3D673D'><b>".$_SESSION[SUCCESS_MSG]."</b></font></p>";
			?>
			<br />
								<div class="well bg-white text-danger strong ">
									<?=$_SESSION[SUCCESS_MSG]?>
								</div>
			<?
			$_SESSION[SUCCESS_MSG] = "";
			return true;		
		}
	}

	if(isset($_SESSION[ERROR_MSG]))
	{
		if($_SESSION[ERROR_MSG] <> "")
		{
			//echo "<p><font color='#9E1010'><b>".$_SESSION[ERROR_MSG]."</b></font></p>";
			?>
			<br />
								<div class="well bg-white text-danger strong ">
									<?=$_SESSION[ERROR_MSG]?>
								</div>
			<?
			$_SESSION[ERROR_MSG] = "";
			return true;		
		}
	}
	
	return false;
	
}

function securityCheck($p)
{

	$pos = strpos($_SERVER['PHP_SELF'],'webadmin');
	$path = '';
	
	$pageArray = array();
	if($pos)
	{
		$path = 'webadmin';
		
		$pageArray = explode(',',ADMIN_UNSECURED_PAGES);
	}
	else
	{
		$pageArray = explode(',',USER_UNSECURED_PAGES);
	}
	
	if(in_array($p,$pageArray))
	{
		return $p;
	}
	else
	{
		if($pos)
		{
			if(isset($_SESSION[ADMIN_SESSION_VAR]))
			{
				return $p;
			}
			else
			{
				return 'login';
			}
		}
		else
		{
			if(isset($_SESSION[USER_SESSION_VAR]))
			{
				return $p;
			}
			else
			{
				return 'registration';
			}
		}
		
	}
}

function fillMultiLevelCombo($schem,$table,$value,$text,$selected = '',$condition = '')
{
	
	global $objDB;
	
	$Query = "select ".$value.",".$text." from ".$schem.".".$table." WHERE parent_cat_id = 0 ";
	if($condition <> '')
		$Query .= $condition;
	$Query .=" ORDER BY ".$text;
	
	$objDB->setQuery($Query);
	
	$rs = $objDB->select();
	
	$str = "";
	
	for($i=0;$i<count($rs);$i++)
	{
		$str .= "<option value=\"".$rs[$i][$value]."\" ";
		
			if(is_array($selected))
			{
				foreach($selected as $val)
				{
					if($val == $rs[$i][$value])
						$str .= " selected ";

				}
			}
			else
			{
				if($selected == $rs[$i][$value])
					$str .= " selected ";
			
			}
		$str .= ">".$rs[$i][$text]."</option>\n";
	}
	
	return $str;

}

function fillCombo($schem,$table,$value,$text,$selected = '',$condition = '')
{
	global $objDB;
	
	$Query = "select ".$value.",".$text." from ".$schem.".".$table." ";
	if($condition <> '')
		$Query .= $condition;
	$Query .=" ORDER BY ".$text;
	
	$objDB->setQuery($Query);
	
	$rs = $objDB->select();
	
	$str = "";
	
	for($i=0;$i<count($rs);$i++)
	{
		$str .= "<option value=\"".$rs[$i][$value]."\" ";
		
			if(is_array($selected))
			{
				foreach($selected as $val)
				{
					if($val == $rs[$i][$value])
						$str .= " selected ";

				}
			}
			else
			{
				if($selected == $rs[$i][$value])
					$str .= " selected ";
			
			}
		$str .= ">".$rs[$i][$text]."</option>\n";
	}
	
	return $str;
}

function getImageExtension($filename) 
{ 
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
	$n = count($exts)-1;
	$exts = $exts[$n]; 
	return $exts; 
} 

function getAudioExtension($filename) 
{ 
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
	$n = count($exts)-1;
	$exts = $exts[$n]; 
	return $exts; 
} 

function thumbnail($filethumb,$file,$Twidth,$Theight,$tag)
{
	list($width,$height,$type,$attr)=getimagesize($file);
	switch($type)
	{
		case 1:
			$img = imagecreatefromgif($file);
		break;
		case 2:
			$img=imagecreatefromjpeg($file);
		break;
		case 3:
			$img=imagecreatefrompng($file);
		break;
	}
	if($tag == "width") //width contraint
	{
		$Theight=round(($height/$width)*$Twidth);
	}
	elseif($tag == "height") //height constraint
	{
		$Twidth=round(($width/$height)*$Theight);
	}
	else
	{
		if($width > $height)
			$Theight=round(($height/$width)*$Twidth);
		else
			$Twidth=round(($width/$height)*$Theight);
	}
	$thumb=imagecreatetruecolor($Twidth,$Theight);
	
	if(imagecopyresampled($thumb,$img,0,0,0,0,$Twidth,$Theight,$width,$height))
	{
		
		switch($type)
		{
			case 1:
				imagegif($thumb,$filethumb);
			break;
			case 2:
				imagejpeg($thumb,$filethumb,100);
			break;
			case 3:
				imagepng($thumb,$filethumb);
			break;
		}
		chmod($filethumb,0666);
		return true;
	}
}

//==================================   Site Specific Functions ===========================================

function getMenuName($id)
{
	global $objDB;
	$val = '';
	$Query = "select menuName from ".SITE_TABLE_PREFIX."menus WHERE id='".$id."' ";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	
	if(count($rsTotal) == 1)
	{
		$val = $rsTotal[0]['menuName'];
	}
	return $val;
}

function getCMSName($id)
{
	global $objDB;
	$val = 'Home';
	$Query = "select title from ".SITE_TABLE_PREFIX."contents WHERE id='".$id."' ";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	
	if(count($rsTotal) == 1)
	{
		$val = $rsTotal[0]['title'];
	}
	return $val;
}


function getTotalSubCategory($id)
{
	global $objDB;
	$val = 0;
	$Query = "select count(id) as CNT from ".SITE_TABLE_PREFIX."job_categories WHERE parentId='".$id."'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if($rsTotal)
	{
		$val = $rsTotal[0]['CNT'];
	}
	
	return $val;
}

function getParentId($id)
{
	global $objDB;
	$val = 0;
	$Query = "select parentId from ".SITE_TABLE_PREFIX."job_categories WHERE id='".$id."'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	
	if(count($rsTotal) == 1)
	{
		$val = $rsTotal[0]['parentId'];
	}
	
	return $val;
}


function getParentCMSId($id)
{
	global $objDB;
	$val = 0;
	$Query = "select parentId from ".SITE_TABLE_PREFIX."contents WHERE id='".$id."'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	
	if(count($rsTotal) == 1)
	{
		$val = $rsTotal[0]['parentId'];
	}
	
	return $val;
}


function getTotalSubCMS($id)
{
	global $objDB;
	$val = 0;
	$Query = "select count(id) as CNT from ".SITE_TABLE_PREFIX."contents WHERE parentId='".$id."'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if($rsTotal)
	{
		$val = $rsTotal[0]['CNT'];
	}
	
	return $val;
}

function getCategoryName($id)
{
	global $objDB;
	$val = 'ROOT';
	$Query = "select name from ".SITE_TABLE_PREFIX."job_categories WHERE id='".$id."'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	
	if(count($rsTotal) == 1)
	{
		$val = $rsTotal[0]['name'];
	}
	
	return $val;
}



function fillCategoryCombo($pid,$selected = '',$condition = '',$depth=0)
{
	global $objDB;
	
	$tab='';
	for($k=0;$k<$depth;$k++)
		$tab .=	"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if($depth > 0)
		$tab .=	"-->";
	
	$Query = "select id,title from contents WHERE parentId='".$pid."' and status =1";

	if($condition <> '')
		$Query .= $condition;
	$Query .=" ORDER BY title";

	$objDB->setQuery($Query);
	
	$rs = $objDB->select();
	
	$str = "";
	
	for($i=0;$i<count($rs);$i++)
	{
		$str .= "<option value=\"".$rs[$i]['id']."\" ";
		
			if(is_array($selected))
			{
				foreach($selected as $val)
				{
					if($val == $rs[$i]['id'])
						$str .= " selected ";

				}
			}
			else
			{
				if($selected == $rs[$i]['id'])
					$str .= " selected ";
			
			}
		$str .= ">".$tab.$rs[$i]['title']."</option>\n";
		
		$str.= fillCategoryCombo($rs[$i]['id'],$selected,$condition,$depth+1);
		
	}
	
	return $str;
}


function replaceURL(){
	return str_replace(".php",".html",$_SERVER['PHP_SELF']);
}


?>
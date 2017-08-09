<?php
$URL =  "http://".$_SERVER['HTTP_HOST'].str_replace("php","html",$_SERVER['PHP_SELF']);

if(isset($category_id)) {
$URL =  "http://".$_SERVER['HTTP_HOST']."/category_listing-".$category_id;
}

$currentPage = loadVariable('pg',1);

if(isset($showAll))
{
	if($showAll == 0)
	{
		loadFromSession('LIST_PAGE','pg',$currentPage);
	}
}

$totalPageCount = ceil($totalRecordCount / $dataPerPage );

if($totalPageCount <=0)
	$totalPageCount =1;

if($currentPage <=0)
	$currentPage = 1;

if($currentPage > $totalPageCount)
	$currentPage = 1;

$totalSegment = ceil($totalPageCount / $pageSegmentSize);

$currentSegment = ceil($currentPage / $pageSegmentSize);


$startPage = (($currentSegment -1)* $pageSegmentSize ) + 1;

$endPage = $startPage + $pageSegmentSize -1;
if($endPage > $totalPageCount)
	$endPage = $totalPageCount;
	
	
	
$nextSegment = "#";
if(($currentSegment + 1) <= $totalSegment)
	$nextSegment= $currentSegment + 1;
	
if($nextSegment <> "#")
{
	$sp = (($nextSegment -1)* $pageSegmentSize ) + 1;
	$nextSegment = $URL."pg-".$sp.$extraParam.".html";
}
	
$nextPage = "#";
if($currentPage + 1 <= $totalPageCount)
{
	$sp = $currentPage + 1; 
	$nextPage = $URL."pg-".$sp.$extraParam.".html";
}

$prevPage = "#";
if($currentPage -1 > 0)
{
	$sp = $currentPage - 1; 
	$prevPage = URL.$page_name."-pg".$sp.$extraParam.".html";
}


$prevSegment = "#";
if(($currentSegment - 1) > 0)
	$prevSegment= $currentSegment - 1;
	
if($prevSegment <> "#")
{
	$sp = (($prevSegment -1)* $pageSegmentSize ) + 1;
	$prevSegment = URL.$page_name."-pg".$sp.$extraParam.".html";
}


$start = (($currentPage -1) * $dataPerPage) ; 

$startRecord = $start+1;
if($totalRecordCount==0)
	$startRecord = 0;
	
$Limit = " LIMIT ".$dataPerPage." OFFSET ".$start;
?>

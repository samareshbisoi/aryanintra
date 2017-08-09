<? if($pageRecordCount > 0 ) { ?>

<ul class="pagination-list">

<li><a href="<?=$prevSegment?>" >Prev</a></li>
<!--<li><a href="<?=$prevPage?>" >&laquo;</a></li>
-->	<? 	$cnt = 0;	
		for($i=$startPage;$i<=$endPage;$i++) 
		{ 
			$cnt++;
			$linkClass = ""; if($currentPage == $i) {$linkClass = "";} 
			$tdClass = ''; if($currentPage == $i) {$tdClass = 'class="active"';} 
			$page = $i; if($i<10) {$page = '0'.$i;}
	?>
	<li  ><a <?=$tdClass?> href="<?=URL.$page_name."-pg".$i.$extraParam.".html"?>" ><?=($page)?></a></li>
	<? } ?>
	<!-- 
	<? 		
		for($i=$cnt;$i<$pageSegmentSize;$i++) 
		{ 
			$tdClass = "tdPaging"; if($currentPage == $i) {$tdClass = "tdPagingCurrent";} 
	?>
	<td class="<?=$tdClass?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<? } ?>
	-->
	<!--<li><a href="<?=$nextPage?>" >&raquo;</a></li>-->
    <li><a href="<?=$nextSegment?>"  >Next</a></li>
  </ul>


<? } else { ?>
<!--[ Showing <?=$startRecord?> to <?=($start+$pageRecordCount)?> of <?=$totalRecordCount?> ]&nbsp;&nbsp;-->
	No Record Found...
<? } ?>

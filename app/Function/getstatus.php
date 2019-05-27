<?php 
function status($id){
	if($id == 1){
		return '新添加';
	} elseif ($id == 2) {
		return '热销';
	} elseif ($id == 3) {
		return '已下架';
	}
}



 ?>
<?php
header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
require_once("inc/dbconnect.php");
if(isset($_POST['action']) && $_POST['action']=="list"){
	
	
	$per_page = 10;  

	$total = 0; 
	$start_page = 0; 
	$cur_page = 1; 
	$chk_page = 0; 
	

	$sql = "
	 SELECT news_id,news_type,news_title,news_detail,news_date FROM news_data WHERE 1
	";
	

	$result = $mysqli->query($sql);
	if($result && $result->num_rows > 0){ 
		$total = $result->num_rows; 
	}
	
	if(isset($_POST['page']) && $_POST['page']>0){
		$chk_page = $_POST['page'];
		$cur_page = $_POST['page']+1;
		$start_page = $_POST['page']*$per_page;
	}
	$sql.="
		LIMIT ".$start_page.",".$per_page."
	";
	$i=0;
	$result = $mysqli->query($sql);
	if($result && $result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$i++;
	
			$json_data['data'][] = array(
				"item_id" 			=> ($chk_page*$per_page)+$i,
				"news_id" 				=> $row['news_id'],
				"news_date" 		=> $row['news_date'],
				"news_detail" 		=> $row['news_detail'],
				"news_title" 		=> $row['news_title'],						
				"news_type" 			=> $row['news_type']
			);
		}

		if($result->num_rows > 0){
			$json_data['curpage'] = $cur_page;
			$json_data['perpage'] = $per_page;
			$json_data['total'] = 	$total;
			$json_data['allpage'] = ceil($total/$per_page); 
		}
	}

}





if(isset($_POST['action']) && $_POST['action']=="item"){
	if(isset($_POST['chk_news_id']) && $_POST['chk_news_id']!=""){
		$sql = "
		 SELECT * FROM news_data WHERE news_id='".$_POST['chk_news_id']."'
		";
		$result = $mysqli->query($sql);
		if($result && $result->num_rows > 0){
				$row = $result->fetch_assoc();
				$json_data['data'][] = array(
					"news_id" 				=> $row['news_id'],
					"news_date" 		=> $row['news_date'],
					"news_detail" 		=> $row['news_title'],
					"news_title" 	=> $row['news_detail'],						
					"news_type" 			=> $row['news_type']
				);
		}
	}

}

if(isset($_POST['action']) && $_POST['action']=="delete"){
	$_error_msg = null;
	$_success_msg = null;		
	if(isset($_POST['del_news_id']) && $_POST['del_news_id']!=""){
		$sql = "
		 DELETE FROM news_data WHERE news_id='".$_POST['del_news_id']."'
		";
		$result = $mysqli->query($sql);
		if($result && $mysqli->affected_rows>0){
			$_success_msg = "Delete News successful!";
		}else{
			$_error_msg = "Eror, please try again!";
		}
	}else{
		$_error_msg = "Eror, please try again!";
	}
	$json_data[]=array(  
		"success" => $_success_msg,
		"error" => $_error_msg
	);     	

}




if(isset($_POST['action']) && $_POST['action']=="edit"){
	$_error_msg = null;
	$_success_msg = null;	
	if(isset($_POST['newsid']) && $_POST['newsid']!=""){			
		$sql = "
		UPDATE news_data SET 
		news_date='".$_POST['datetime']."',
		news_title='".$_POST['title']."',
		news_detail='".$_POST['detail']."',
		news_type='".$_POST['newstype']."'
		WHERE news_id=".$_POST['newsid']."		
		";
		$result = $mysqli->query($sql);
		if($result){
			if($mysqli->affected_rows>0){
				$_success_msg = "Change news data successful!";
			}else{
				$_success_msg = "Update news successful!";
			}			
		}else{
			$_error_msg = "Eror, please try again!";
		}
	}
	$json_data[]=array(  
		"success" => $_success_msg,
		"error" => $_error_msg
	);     
				
}


if(isset($_POST['action']) && $_POST['action']=="add"){
	$_error_msg = null;
	$_success_msg = null;	
	
	$sql = "
	INSERT INTO news_data SET 
	news_date='".$_POST['datetime']."',
	news_title='".$_POST['title']."',
	news_detail='".$_POST['detail']."',
	news_type='".$_POST['newstype']."'		
	";
	$result = $mysqli->query($sql);
	if($result && $mysqli->affected_rows>0){
		$insert_newsID = $mysqli->insert_id;
		$_success_msg = "Add new news successful!";
	}else{
		$_error_msg = "Eror, please try again!";
	}
	$json_data[]=array(  
		"success" => $_success_msg,
		"error" => $_error_msg
	);    
		 			
}


if(isset($json_data)){  
    $json= json_encode($json_data);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}
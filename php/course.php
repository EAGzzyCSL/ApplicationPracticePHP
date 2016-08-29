<?php
	$sql = "select * from Course";
	$stmt = sqlsrv_query($conn, $sql);
	if( $stmt == false){
			 $returnStr = ERROR(500);
			 echo $returnStr;
	}
	
	else{
		$array;
		$i=0;
		while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
			$array[$i]['C_Name']=$row['C_Name'];
			$array[$i]['C_Type']=$row['C_Type'];
			$array[$i]['C_Student']=$row['C_Student'];
			$array[$i]['C_Time']=$row['C_Time'];
			$array[$i]['C_Teacher']=$row['C_Teacher'];
			$array[$i]['C_ID']=$row['C_ID'];
			$array[$i]['C_Remark']=$row['C_Remark'];
			$i++;
		}
		echo JSON($array);
	}
?>
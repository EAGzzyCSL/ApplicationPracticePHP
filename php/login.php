<?php
	if($sqlConn)
	{
		$U_ID = $_POST["U_ID"];
		$U_Password = $_POST['U_Password'];
		
		$sql = "select * from [User] where U_ID='$U_ID'";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if( $stmt == false)
		{
			 $returnStr = ERROR(500);
			 echo $returnStr;
		}
		else
		{
			$password="";
			while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
			{
				$password = $row['U_Password'];
				$U_ChName = $row['U_ChName'];
				$U_Type = $row['U_Type'];
			}
			if($password=="")
			{
				$Msg = iconv('UTF-8', 'GBK', '登录失败');
				$array['Msg'] = $Msg;
				$array['Code'] = 0;
				$returnStr = JSON($array);
				
				echo $returnStr;
			}
			else
			{
				if($U_Password==$password)
				{
				$row['U_ID'] = $U_ID;
				$row['U_ChName'] = $U_ChName;
				$row['U_Type'] = $U_Type;
				
				$array['User'] = $row;
				$Msg = iconv('UTF-8', 'GBK', '登录成功');
				$array['Msg'] = $Msg;
				$array['Code'] = 1;
				
				// 获取IP 
				$nowIP =  getIP(); 
				
				//session记录
				$_SESSION["U_ID"] = $U_ID;
				
				//签到记录
				$sql = "INSERT INTO Sign (U_ID,S_Type, S_IP) values ('$U_ID', 1, '$nowIP');";
				
				$stmt = sqlsrv_query($conn, $sql);
				}
				else
				{
					$Msg = iconv('UTF-8', 'GBK', '登录失败');
					$array['Msg'] = $Msg;
					$array['Code'] = 0;
				}
				
				$returnStr = JSON($array);
				
				echo $returnStr;
			}
		}
	}
?>
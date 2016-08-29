<?php
	session_start();
	
	require "jsonHelper.php";
	require "conectSql.php";
	
	$PostType = $_GET['PostType'];
	
	switch ($PostType) {
		case "course": require "course.php"; break;
		case "research": require "research.php"; break;
		case "education_result": require "education_result.php"; break;
		case "education_thesis": require "education_thesis.php"; break;
		case "teaching_material": require "teaching_material.php"; break;
		case "education_reform": require "education_reform.php"; break;
		case "research_result": require "research_result.php"; break;
		case "research_thesis": require "research_thesis.php"; break;
		case "copyright": require "copyright.php"; break;
		case "patent": require "patent.php"; break;
		case "recruit": require "recruit.php"; break;
		case "internation_cooperation": require "internation_cooperation.php"; break;
		case "teacher": require "teacher.php"; break;
		case "student": require "student.php"; break;
		
		case "login": require "login.php"; break;
		case "session": require "session.php"; break;
		case "loginOut": require "loginOut.php"; break;
		case "signInfo": require "signInfo.php"; break;
		case "book": require "book.php"; break;
		case "addBook": require "addBook.php"; break;
		case "applyBook": require "applyBook.php"; break;
		case "applyBookRec": require "applyBookRec.php"; break;
		case "applyConvertBorrow": require "applyConvertBorrow.php"; break;
		case "expiredBook": require "expiredBook.php"; break;
		case "beExpiringBook": require "beExpiringBook.php"; break;
		case "violation": require "violation.php"; break;
		case "returnBook": require "returnBook.php"; break;
		case "personInfo": require "personInfo.php"; break;
		case "changePersonInfo": require "changePersonInfo.php"; break;
		case "changePassword": require "changePassword.php"; break;
		case "addUser": require "addUser.php"; break;
		case "addDynamic": require "addDynamic.php"; break;
		case "dynamicList": require "dynamicList.php"; break;
		case "dynamicInfo": require "dynamicInfo.php"; break;
		case "delDynamic": require "delDynamic.php"; break;
		case "updateDynamic": require "updateDynamic.php"; break;	}
	
	sqlsrv_close($conn);
?>
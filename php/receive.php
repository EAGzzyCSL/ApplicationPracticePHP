<?php
session_start();

require "jsonHelper.php";
require "connectSql.php";

$PostType = $_GET['PostType'];

switch ($PostType) {
    case "Register":
        require "Register_1.php";
        break;
    case "Login":
        require "Login_2.php";
        break;
    case "Check_token":
        require "Check_token_3.php";
        break;
    case "Get_hotshop":
        require "Get_hotshop_4.php";
        break;
    case "Get_hotgoods":
        require "Get_hotgoods_5.php";
        break;
    case "Shop_search":
        require "Shop_search_6.php";
        break;
    case "Get_shopgoods":
        require "Get_shopgoods_7.php";
        break;
    case "Get_goodscomment":
        require "Get_goodscomment_8.php";
        break;
    case "Add_goods":
        require "Add_goods_9.php";
        break;
    case "Add_comment":
        require "Add_comment_10.php";
        break;
    case "praise":
        require "praise_11.php";
        break;
    case "Get_collection":
        require "Get_collection_12.php";
        break;
    case "add_collection":
        require "add_collection_13.php";
        break;
    case "Judge_collection":
        require "Judge_collection_14.php";
        break;
    case "Get_Cgoods":
        require "Get_Cgoods_15.php";
        break;
    case "Add_friends":
        require "Add_friends_16.php";
        break;
    case "Get_userinfor":
        require "Get_userinfor_17.php";
        break;
    case "Get_school":
        require "Get_school_18.php";
        break;
    case "Update_userinfor":
        require "Update_userinfor_19.php";
        break;
    case "Admin_login":
        require "Admin_login_20.php";
        break;
    case "Add_shop":
        require "Add_shop_21.php";
        break;
    case "Get_tag":
        require "Get_tag_22.php";
        break;
    case "Add_tag":
        require "Add_tag_23.php";
        break;
    case "Goods_search":
        require "Goods_search_24.php";
        break;
    case "delete_collection":
        require "delete_collection_25.php";
        break;
    case "logout":
        require "logout_26.php";
        break;
}
mysqli_close($conn);
?>
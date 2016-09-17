<?php 
session_start();
if (isset($_SESSION['currentUser']) == false || $_SESSION['currentUser'] == '') {
    header('location:admin.php');
}
function getParentLoc()
{
    $_request_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $index_of_slash = strrpos($_request_url, '/');
    $url_parent = substr($_request_url, 0, $index_of_slash + 1);
    return $url_parent;
}
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>校园美食评后台管理系统</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/theme.min.css" rel="stylesheet">
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <style type="text/css">
        /*列表样式*/
        .div_one {
            margin: 1em 0;
            padding: 1em;
            display: flex;
            height: 20em;
        }
        
        .div_one:nth-child(odd) {
            background-color: #f9f9f9;
        }
        
        .div_one:nth-child(even) {}
        
        .div_info {
            display: inline-block;
            vertical-align: top;
            flex: 0 0 20em;
        }
        
        .div_imgs {
            flex: 1 0 0;
            height: 100%;
        }
        
        .img_pic {
            margin: 0 1em;
            height: 100%;
            width: 30em;
        }
        
        .div_opt {
            display: inline-block;
        }
        
        .form_delete {
            display: inline;
        }
        
        #div_container {
            margin-top: 5em;
        }
        /*模态框*/
        
        #img_preview {
            display: block;
            margin: 0 auto;
            height: 20em;
            width: 40em;
        }
        /*面板*/
        
        .tab-pane {
            padding: 1em;
        }
        /*chart*/
        
        .div_chart_group {
            display: flex;
            flex-wrap: wrap;
        }
        
        .div_chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 1em;
            justify-content: space-around;
        }
        
        .canvas_chart {}
        
        .span_chart_title {
            font-size: 2em;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">校园美食评后台管理系统</a>
            </div>
            <form class="navbar-form navbar-right" action="php/logOut.php" method="post">
                <!--  表单发送注销请求-->
                <input id="button_logout" type="submit" class="btn btn-primary" value="注销" />
            </form>
        </div>
    </nav>

    <!-- 列表部分 -->
    <div id="div_container" class="container">
        <!-- tab标签 -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#manager" data-toggle="tab">内容管理</a></li>
            <li><a href="#statistics" data-toggle="tab">数据统计</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="manager">
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-4">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_canteen">添加餐厅</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_school">添加学校</button>
                    </div>
                </div>
                <div class="row">
                    <div id="div_list" class="col-lg-offset-1 col-lg-6">
                        <?php 
                require 'php/_db_con.php';
                $stmt = $db_con->prepare(
                'SELECT * FROM `shop`');
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                while ($one = $stmt_result->fetch_assoc()) {
                    ?>
                        <div class="div_one">
                            <div class="div_info">
                                <h2 class="h2_title">
                            <?php echo $one['name'];
                    ?>
                          </h2>
                                <h4 class="span_address">地址：
                            <?php echo $one['address'];
                    ?>
                  </h4>
                                <h4 class="span_school">学校：
                            <?php 
                            $stmt_getSchoolName = $db_con->prepare(
                            'SELECT * FROM `school` WHERE `ID`=?');
                    $stmt_getSchoolName->bind_param('i', $one['school_ID']);
                    $stmt_getSchoolName->execute();
                    $stmt_getSchoolName_result = $stmt_getSchoolName->get_result();
                    if ($schoolName = $stmt_getSchoolName_result->fetch_assoc()) {
                        echo $schoolName['name'];
                    }
                    $stmt_getSchoolName->close();
                    ?>
                  </h4>
                            </div>
                            <div class="div_imgs">
                                <img class="img_pic" src="
                          <?php echo $one['image'];
                    ?>
                          " />
                            </div>
                            <div class="div_opt">
                                <form class="form_delete" action="php/deleteShop.php" method="post">
                                    <input name="id" type="hidden" value="
                              <?php echo $one['ID'];
                    ?>
                              " />
                                    <input type="submit" value="删除" class="btn btn-danger" />
                                </form>
                            </div>
                        </div>
                        <?php 
                }
                  $stmt->close();
                   ?>
                    </div>
                </div>
                <!--列表页面结束  -->
            </div>
            <!-- 统计面板  -->
            <div class="tab-pane fade" id="statistics">
                <div class="div_chart_group">
                    <?php
                  // get all shop
                  $stmt_getAllShop = $db_con->prepare('SELECT `ID`,`name` FROM `shop`');
                  $stmt_getAllShop->execute();
                  $stmt_result_getAllShop = $stmt_getAllShop->get_result();
                  $shopIdArray = array();
                  while ($oneShop = $stmt_result_getAllShop->fetch_assoc()) {
                      array_push($shopIdArray, $oneShop['ID']);
                      echo '<div class="div_chart">';
                      echo '<canvas class="canvas_chart"></canvas>';
                      echo '<span class="span_chart_title">'.$oneShop['name'].'</span></div>';
                  }
                  $stmt_result_getAllShop->close();
                  $stars_data_array = array();
                  foreach ($shopIdArray as $shopId) {
                      $sql_query_star = 'CALL GetStarsOfShop('.$shopId.');';
                      $star_result = $db_con->query($sql_query_star);
                      while ($db_con->more_results()) {
                          $db_con->next_result();
                          if ($res = $db_con->store_result()) {
                              $res->free();
                          }
                      }
                      if ($star_result != false) {
                          $shop_stars = mysqli_fetch_assoc($star_result);

                          array_push($stars_data_array, '['.implode(',', $shop_stars).']');
                      } else {
                          printf("Error: %s\n", $db_con->error);
                      }
                  }
                  ?>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="modal_add_canteen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加新的餐厅</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="form_upload" method="post" action="http://up-z1.qiniu.com" enctype="multipart/form-data">
                        <!-- php连接七牛云获取token -->
                        <?php

                        require 'vendor/autoload.php';
                        require 'php/config.php';
                        use Qiniu\Auth;

                        $bucket = $config['bucket'];
                        $accessKey = $config['accessKey'];
                        $secretKey = $config['secretKey'];
                        $auth = new Auth($accessKey, $secretKey);
                        $policy = array(
                          'returnUrl' => getParentLoc().'php/303tolocal.php',
                          'returnBody' => '{"key": $(key), "hash":$(etag),"canteen_name":$(x:canteen_name),"canteen_address":$(x:canteen_address),"canteen_school":$(x:canteen_school)}',
                        );
                        $upToken = $auth->uploadToken($bucket, null, 3600, $policy);
                        echo '<input name="token" type="hidden" value="'.$upToken.'">';
                      ?>
                            <div class="form-group">
                                <input class="form-control" required="required" name="x:canteen_name" placeholder="食堂名称" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" required="required" name="x:canteen_address" placeholder="食堂地址" />
                            </div>
                            <div class="form-group">
                                <label for="name">选择学校</label>

                                <select id="select_school" name="x:canteen_school" class="form-control"> 
                            <?php 
                            $stmt = $db_con->prepare('SELECT * FROM `school`');
                            $stmt->execute();
                            $stmt_result = $stmt->get_result();
                            while ($one = $stmt_result->fetch_assoc()) {
                                echo '<option value="'.$one[ID].'">'.$one['name'].'</option>';
                            }
                            $stmt->close();
                             ?>
                          </select>
                            </div>
                            <div class="form-group">
                                <label for="input_img">选择食堂照片</label>
                                <input id="input_img" class="filestyle" name="file" required="required" accept="image/png,image/jpeg" type="file" />
                            </div>
                            <img id="img_preview" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" form="form_upload" class="btn btn-primary" value="保存" />
                </div>
            </div>
        </div>
    </div>
    <!--添加学校的-->
    <div class="modal fade" id="modal_add_school" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加学校</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="form_add_school" method="post" action="php/addSchool.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <input placeholder="输入学校名称" class="form-control" name="schoolName" required="required" list="schoolList" />
                            <datalist id="schoolList">
                    <?php 
                    $stmt = $db_con->prepare('SELECT * FROM `school`');
                    $stmt->execute();
                    $stmt_result = $stmt->get_result();
                    while ($one = $stmt_result->fetch_assoc()) {
                        echo '<option value="'.$one['name'].'" />';
                    }
                    $stmt->close();
                     ?>
                  </datalist>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="submit" form="form_add_school" class="btn btn-primary" value="保存" />
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        <?php 
    // echo the script of js to show data;
    echo 'var data_stars=['.implode(',', $stars_data_array).'];';
     ?>
    </script>
    <script type="text/javascript">
        (function() {
            var button_add = document.getElementById("button_add");
            var img_preview = document.getElementById("img_preview");
            var input_img = document.getElementById("input_img");
            var form_upload = document.getElementById("form_upload");
            imgPreview(input_img, img_preview);

            function imgPreview(the_input, the_img) {
                if (typeof FileReader != 'undefined') {
                    the_input.onchange = function() {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            the_img.src = event.target.result;
                        };
                        if (the_input.files[0] != undefined) {
                            reader.readAsDataURL(the_input.files[0]);
                        } else {
                            the_img.src = "";
                        }
                    };
                }
            }
            var form_delete=document.getElementsByClassName("form_delete");
            for(var i=0;i<form_delete.length;i++){
              form_delete[i].onsubmit=function(){
                if(!window.confirm("确认删除?")){
                  return false;
                }
              }
            }
        })();

        (function() {
            var pie_label = [
                "零星",
                "一星",
                "二星",
                "三星",
                "四星",
                "五星"
            ];
            var pie_bkg = [
                "#FF6384",
                "#36A2EB",
                "#FFCE56",
                "#4CAF50",
                "#7C4DFF",
                "#607D8B"
            ];
            var chart_ctxs = document.getElementsByClassName("canvas_chart");
            for (var i = 0; i < chart_ctxs.length; i++) {
                new Chart(chart_ctxs[i].getContext("2d"), {
                    type: 'pie',
                    data: {
                        labels: pie_label,
                        datasets: [{
                            data: data_stars[i],
                            backgroundColor: pie_bkg
                        }]
                    },
                    options: {
                        responsive: false,
                    }
                });
            }
        })();
    </script>
</body>

</html>
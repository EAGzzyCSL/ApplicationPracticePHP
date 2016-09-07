<?php 
session_start();
if (isset($_SESSION['currentUser']) == false || $_SESSION['currentUser'] == '') {
    header('location:admin.php');
}
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>校园美食评后台管理系统</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
        #button_add {}
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
        }

        .img_pic {
            
            margin: 0 1em;
            height: 100%;
        }

        .div_opt {
            display: inline-block;
        }

        .form_delete {
            display: inline;
        }
        #div_container{
          margin-top: 5em;
        }
        /*模态框*/

        #img_preview {
            display: block;
            margin: 0 auto;
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
    <div id="div_container" classs="container">
        <div class="col-lg-offset-3 col-lg-2">
            <button id="button_add" class="btn btn-primary" data-toggle="modal" data-target="#modal_add">添加</button>
        </div>
        <div id="div_list" class="col-lg-6 col-lg-offset-3">
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
                    <?php
                      echo $one['image'];
              ?>
                    " />
                </div>
                <div class="div_opt">
                    <button type="button" class="btn btn-primary">编辑</button>
                    <form class="form_delete" action="php/deleteShop.php" method="post">
                        <input name="id" type="hidden" value="
                        <?php
                          echo $one['ID'];
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
    <!-- modal -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                          'returnUrl' => $config['returnUrl'],
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
        <script type="text/javascript">
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
        </script>
</body>

</html>

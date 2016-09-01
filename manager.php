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
        }

        .div_one:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .div_one:nth-child(even) {}

        .div_info {
            display: inline-block;
            vertical-align: top;
        }

        .div_imgs {
            flex: 1 0 0;
        }

        .img_pic {
            height: 9em;
            width: 16em;
            margin: 0 1em;
        }

        .div_opt {
            display: inline-block;
        }

        .form_delete {
            display: inline;
        }
        /*模态框*/

        #img_preview {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">校园美食评后台管理系统</a>
            </div>
            <form class="navbar-form navbar-right" action="" method="post">
                <!--  表单发送注销请求-->
                <input id="button_logout" type="submit" class="btn btn-primary" value="注销" />
            </form>
        </div>
    </nav>
    <!-- 列表部分 -->
    <div classs="container">
        <div class="col-lg-offset-2 col-lg-2">
            <button id="button_add" class="btn btn-primary" data-toggle="modal" data-target="#modal_add">添加</button>
        </div>
        <div id="div_list" class="col-lg-10 col-lg-offset-2">
            <div class="div_one">
                <div class="div_info">
                    <h2 class="h2_title">三食堂</h2>
                    <span class="span_address">教工食堂旁边</span>
                </div>
                <div class="div_imgs">
                    <img class="img_pic" src="test.png" />
                </div>
                <div class="div_opt">
                    <button type="button" class="btn btn-primary">编辑</button>
                    <form class="form_delete">
                        <input type="hidden" value="the data id" />
                        <input type="submit" value="删除" class="btn btn-danger" />
                    </form>
                </div>
            </div>
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
                        $test = 'hello world';
                        $policy = array(
                          'returnUrl' => $config['returnUrl'],
                          'returnBody' => '{"key": $(key), "hash":$(etag),"canteen_name":$(x:canteen_name),"canteen_address":$(x:canteen_address)}',
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

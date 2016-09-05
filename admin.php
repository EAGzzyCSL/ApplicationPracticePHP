<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/md5.min.js"></script>
    <style type="text/css">
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        #h1_title {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 id="h1_title">校园美食评后台管理系统</h1>
    <div class="container">
        <form id="form_login" role="form" class="col-lg-4 col-lg-offset-4" method="post">
            <div class="form-group">
                <input class="form-control" required="required" type="text" name="username" placeholder="用户名">
            </div>
            <div class="form-group">
                <input class="form-control" required="required" type="password" name="password" placeholder="密码" />
                <input type="hidden" name="md5password" value="" />
            </div>
            <div class="form-group">
                <input id="input_submit" class="btn btn-primary btn-block" type="submit" value="登陆" />
            </div>
            <div class="form-group">
                <!-- php帐号密码匹配判断与错误信息输出 -->
                <?php
                  error_reporting(7);
                  if (isset($_POST['username']) && isset($_POST['md5password'])) {
                      $username = $_POST['username'];
                      $password = $_POST['md5password'];
                      if ($username == 'root') {
                          header('Location:manager.php');
                      } else {
                          echo '<p class="text-danger text-center">用户名或密码错误</p>';
                      }
                  }
                ?>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        var form_login = document.getElementById("form_login");
        form_login.onsubmit = function() {
            if (form_login.password.value != '') {
                form_login.mdh1_title5password.value = md5(form_login.md5password.value);
                from_login.password.value = "";
            }
        };
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Online</title>

  <!-- Use cdn bootstrap -->
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-theme.min.css" />

  <link rel="stylesheet" href="./css/style.css">


  <link rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>


  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <!--alert message-->
  <?php if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
  }
  ?>
  <!--alert message end-->

</head>

<body>
  <?php
  include_once 'dbConnection.php';
  ?>

  <body>
    <div class="header head">
      <div class="row">
        <div class="col-lg-6">
          <span class="logo">Trắc Nghiệm Online</span>
        </div>
        <div class="col-md-4 col-md-offset-2">
          <?php
// ket noi den csdl
          include_once 'dbConnection.php';

          session_start();
          if (!(isset($_SESSION['email']))) {
            header("location:index.php");
          } else {

            $name = $_SESSION['name'];
            $email = $_SESSION['email'];

            include_once 'dbConnection.php';
// right icon
            echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Hello,</span> <a href="account.php?q=1" class="log log1">' . $name . '</a> | <a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</button></a></span>';
          } ?>
        </div>
      </div>
    </div>
    <div class="bg">

      <!--navigation menu-->
      <nav class="navbar navbar-default title1">
        <div class="container-fluid">
          <!-- toggle -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>Sinh Viên</b></a>
          </div>

          <!-- Collect the nav-->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Trang Chủ<span class="sr-only">(current)</span></a></li>
              <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Lịch Sử</a></li>
              <li <?php if (@$_GET['q'] == 3) echo 'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Xếp Hạng</a></li>
              <li class="pull-right"> <a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Đăng Xuất</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Nhập tag ">
              </div>
              <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Tìm Kiếm</button>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
      <!--navigation menu closed-->

      <!--container start-->
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <!--home start-->
            <?php if (@$_GET['q'] == 1) {

              $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
              echo  '<div class="panel"><div class="table-responsive"><table style="text-align: center;" class="table table-striped title1">
        <tr>
            <td><b>TT</b></td>
            <td><b>Chủ Đề</b></td>
            <td><b>Câu Hỏi</b></td>
            <td><b></b></td>
            <td><b>Thời Gian</b></td>
            <td></td>
        </tr>';
              $c = 1;
              while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $total = $row['total'];
                // $sahi = $row['sahi'];
                $time = $row['time'];
                $eid = $row['eid'];
                $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
                $rowcount = mysqli_num_rows($q12);
                if ($rowcount == 0) {
                  echo '<tr><td>' . $c++ . '</td>
                            <td>' . $title . '</td>
                            <td>' . $total . '</td>
                            <td>' . '</td>
                            <td>' . $time . ' min</td>
	                          <td><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td>
                        </tr>';
                } else {
                  echo '<tr style="color:#99cc32">
                          <td>' . $c++ . '</td>
                          <td>' . $title . ' <span title="ban da lam roi" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                          <td>' . $total . '</td><td>' . '</td>
                          <td>' . $time . '&nbsp;min</td>
	                        <td><b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
                        }
              }

              $c = 0;
              echo '</table></div></div>';
            } ?>

            <!--home closed-->

            <!--quiz start-->
            <?php
            if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
              $eid = @$_GET['eid'];
              $sn = @$_GET['n'];
              $total = @$_GET['t'];
              $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");
              echo '<div class="panel" style="margin:5%">';
              while ($row = mysqli_fetch_array($q)) {
                $qns = $row['qns'];
                $qid = $row['qid'];
                echo '<b>Question &nbsp;' . $sn . '&nbsp;::<br />' . $qns . '</b><br /><br />';
              }
              $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ");
              echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
<br />';

              while ($row = mysqli_fetch_array($q)) {
                $option = $row['option'];
                $optionid = $row['optionid'];
                echo '<input type="radio" name="ans" value="' . $optionid . '">' . $option . '<br /><br />';
              }
              echo '<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Submit</button></form></div>';
              //header("location:dash.php?q=4&step=2&eid=$id&n=$total");
            }
            //result display
            if (@$_GET['q'] == 'result' && @$_GET['eid']) {
              $eid = @$_GET['eid'];
              $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
              echo  '<div class="panel">
                      <center>
                      <h1 class="title" style="color:#660033">Kết quả thi</h1>
                      <center><br/>
                      <table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';
              while ($row = mysqli_fetch_array($q)) {
                $s = $row['score'];
                $w = $row['wrong'];
                $r = $row['sahi'];
                $qa = $row['level'];
                echo '<tr style="color:#66CCFF">
                        <td>Tổng câu hỏi</td><td>' . $qa . '</td>
                      </tr>
                      <tr style="color:#99cc32">
                        <td>Đáp án đúng <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
                        <td>' . $r . '</td>
                      </tr> 
	                    <tr style="color:red">
                        <td>Đáp án sai <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td>
                        <td>' . $w . '</td>
                      </tr>
	                    <tr style="color:#66CCFF">
                        <td>Điểm thi <span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
                        <td>' . $s . '</td>
                      </tr>';
              }
              $q = mysqli_query($con, "SELECT * FROM rank WHERE  email='$email' ") or die('Error157');
              while ($row = mysqli_fetch_array($q)) {
                $s = $row['score'];
                echo '<tr style="color:#990000">
                      <td>Tổng điểm <span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td>
                      <td>' . $s . '</td></tr>';
              }
              echo '</table></div>';
            }
            ?>
            <!--quiz end-->

            <?php
            //history start
            if (@$_GET['q'] == 2) {
              // quẻry database 
              $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
              echo  '<div class="panel title">
                      <table class="table table-striped title1" >
                        <tr style="color:red">
                          <th>T.T</th>
                          <th>Chủ Đề</th>
                          <th>Số Câu Hỏi</th>
                          <th>Đúng</th>
                          <th>Sai</td>
                          <th>Điểm</th>';
              // using while loop fetch data from database as array
              $c = 0;
              while ($row = mysqli_fetch_array($q)) {
                $eid = $row['eid'];
                $s = $row['score'];
                $w = $row['wrong'];
                $r = $row['sahi'];
                $qa = $row['level'];
                $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE  eid='$eid' ") or die('Error208');
                while ($row = mysqli_fetch_array($q23)) {
                  $title = $row['title'];
                }
                $c++;
                echo '<tr>
                        <td>' . $c . '</td>
                        <td>' . $title . '</td>
                        <td>' . $qa . '</td>
                        <td>' . $r . '</td>
                        <td>' . $w . '</td>
                        <td>' . $s . '</td>
                      </tr>';
              }
              echo '</table></div>';
            }

            //ranking start
            if (@$_GET['q'] == 3) {
              $q = mysqli_query($con, "SELECT * FROM rank  ORDER BY score DESC ") or die('Error223');
              echo  '<div class="panel title">
              <div class="table-responsive">
                <table class="table table-striped title1" >
                <tr style="color:red">
                  <th>Rank</th>
                  <th>Họ Tên</th>
                  <th>Giới Tính</th>
                  <th>Trường Học</th>
                  <th>Điểm</th>
                  <th></th>
                </tr>';
                // fetch data from dtbase using ưhile loop
              $c = 0;
              while ($row = mysqli_fetch_array($q)) {
                $e = $row['email'];
                $s = $row['score'];
                $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e' ") or die('Error231');
                while ($row = mysqli_fetch_array($q12)) {
                  $name = $row['name'];
                  $gender = $row['gender'];
                  $college = $row['college'];
                }
                $c++;
                echo '<tr>
                <td style="color:#99cc32"><b>' . $c . '</b></td>
                      <td>' . $name . '</td>
                      <td>' . $gender . '</td>
                      <td>' . $college . '</td>
                      <td>' . $s . '</td><td>';
              }
              echo '</table></div></div>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!--Footer start-->
    <!--Footer start-->
    <div class="row footer">
      <div class="col-md-3 box">
        <a href="#">About us</a>
      </div>
      <div class="col-md-3 box">
        <a href="#" data-toggle="modal" data-target="#login">Admin Login</a>
      </div>
      <div class="col-md-3 box">
        <a href="#" data-toggle="modal" data-target="#developers">Developers</a>
      </div>
      <div class="col-md-3 box">
        <a href="#">Contact Me</a>
      </div>
    </div>
    <!-- Modal For Developers-->
    <div class="modal fade title1" id="developers">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Developers</span>
            </h4>
          </div>

          <div class="modal-body">
            <p>
            <div class="row">
              <div class="col-md-4">
                <img src="./img/JNorm.jpg" width=100 height=100 alt="JNormDev" class="img-rounded">
              </div>
              <div class="col-md-5">
                <a href="#" style="color:#202020; font-family:'typo' ; font-size:18px" title="Find on Facebook">Sisattanak Chanthanom</a>
                <h4 style="font-family:'typo' ">K60K1 CNTT</h4>
                <h4 style="color:#202020; font-family:'typo' ;font-size:16px" class="title1">0568955021
                </h4>
                <h4 style="font-family:'typo' ">Normmaster72@gmail.com</h4>
                <h4 style="font-family:'typo' ">Vinh University
                </h4>
              </div>
            </div>
            </p>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Modal for admin login-->
    <div class="modal fade" id="login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
          </div>
          <div class="modal-body title1">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <form role="form" method="post" action="admin.php?q=index.php">
                  <div class="form-group">
                    <input type="text" name="uname" maxlength="20" placeholder="Admin user id" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" maxlength="15" placeholder="Password" class="form-control" />
                  </div>
                  <div class="form-group" align="center">
                    <input type="submit" name="login" value="Login" class="btn btn-primary" />
                  </div>
                </form>
              </div>
              <div class="col-md-3"></div>
            </div>
          </div>
          <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--footer end-->

  </body>

</html>
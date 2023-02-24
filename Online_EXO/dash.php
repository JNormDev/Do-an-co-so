<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Online</title>
    
    <!-- Use Bootstrap CDN -->
   
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

    <script>
    $(function() {
        $(document).on('scroll', function() {
            console.log('scroll top : ' + $(window).scrollTop());
            if ($(window).scrollTop() >= $(".logo").height()) {
                $(".navbar").addClass("navbar-fixed-top");
            }

            if ($(window).scrollTop() < $(".logo").height()) {
                $(".navbar").removeClass("navbar-fixed-top");
            }
        });
    });
    </script>
</head>

<body>
    <div class="header head">
        <div class="row">
            <div class="col-lg-6">
                <span class="logo">Trắc Nghiệm Online</span>
            </div>
            <?php
      include_once 'dbConnection.php';
      session_start();
      $email = $_SESSION['email'];
      if (!(isset($_SESSION['email']))) {
        header("location:index.php");
      } else {
        $name = $_SESSION['name'];;

        include_once 'dbConnection.php';
        
        echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php" class="log log1">' . $name . '</a>|&nbsp;&nbsp;&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log Out</button></a></span>';
      } ?>

        </div>
    </div>
    <!-- admin start-->

    <!--navigation menu-->
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dash.php?q=0"><b>Giảng Viên</b></a>
               
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php if (@$_GET['q'] == 0) echo 'class="active"'; ?>><a href="dash.php?q=0"><span class="glyphicon glyphicon-home"></span> Trang Chủ<span
                                class="sr-only">(current)</span></a></li>
                    <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="dash.php?q=1"><span class="glyphicon glyphicon-user"></span> User</a></li>
                                
                    <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="dash.php?q=2"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Ranking</a></li>
                    <li class="dropdown <?php if (@$_GET['q'] == 4 || @$_GET['q'] == 5) echo 'active"'; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"><span class="glyphicon glyphicon-briefcase"></span> Quản lý Đề Thi<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="dash.php?q=4">Thêm Đề Thi</a></li>
                            <li><a href="dash.php?q=5">Xóa Đề Thi </a></li>

                        </ul>
                    </li>
                    <li class="pull-right"> <a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out"
                                aria-hidden="true"></span> Đăng Xuất</a></li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--navigation menu closed-->
    <div class="container">
        <!--container start-->
        <div class="row">
            <div class="col-md-12">

                <!--home start-->
                <?php if (@$_GET['q'] == 0) {

          $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
          echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
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
                        <td>' . '</td><td>' . $time . ' min</td>
                        <td><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> <span class="title1"><b>Start</b></span></a></b></td>
                      </tr>';
            } else {
              echo '<tr style="color:#99cc32">
                      <td>' . $c++ . '</td>
                      <td>' . $title . ' <span title="Cau hoi nay douc ban xu ly roi" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                      <td>' . $total . '</td>
                      <td>' . '</td><td>' . $time . ' min</td>
                      <td><b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> <span class="title1"><b>Restart</b></span></a></b></td>
                    </tr>';
            }
          }
          $c = 0;
          echo '</table></div></div>';
        }

        //Rank start
        if (@$_GET['q'] == 2) {
          $q = mysqli_query($con, "SELECT * FROM rank  ORDER BY score DESC ") or die('Error223');
          echo  '<div class="panel title"><div class="table-responsive">
        <table class="table table-striped title1" >
        <tr style="color:red">
          <td><b>Rank</b></td>
          <td><b>Họ Tên</b></td>
          <td><b>Giới Tính</b></td>
          <td><b>Trường Học</b></td>
          <td><b>Điểm Thi</b></td>
          <td></td>
        </tr>';
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
            echo '<tr><td style="color:#99cc32"><b>' . $c . '</b></td>
                      <td>' . $name . '</td>
                      <td>' . $gender . '</td>
                      <td>' . $college . '</td>
                      <td>' . $s . '</td><td>';
          }
          echo '</table></div></div>';
        }

        ?>
                <!--home closed-->

                <!--users start-->
                <?php if (@$_GET['q'] == 1) {
          $result = mysqli_query($con, "SELECT * FROM user") or die('Error');
          echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
        <tr>
          <td><b>T.T</b></td>
          <td><b>Họ Tên</b></td>
          <td><b>Giới Tính</b></td>
          <td><b>Trường Học</b></td>
          <td><b>Email</b></td>
          <td><b>SDT</b></td>
          <td></td>
        </tr>';
          $c = 1;
          while ($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $mob = $row['mob'];
            $gender = $row['gender'];
            $email = $row['email'];
            $college = $row['college'];

            echo '<tr><td>' . $c++ . '</td><td>' . $name . '</td><td>' . $gender . '</td><td>' . $college . '</td><td>' . $email . '</td><td>' . $mob . '</td>
            <td><a title="Delete User" href="update.php?demail=' . $email . '"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
          }
          $c = 0;
          echo '</table></div></div>';
        } ?>
        <!--user end-->

        <!--add quiz start-->
        <?php
        if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
          echo ' 
        <div class="row">
        <span class="title1" style="margin-left:35%;font-size:30px;"><b>Thêm Thông Tin Môn Thi</b></span><br /><br />
         <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
        <fieldset>
        
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="name"></label>  
          <div class="col-md-12">
          <input id="name" name="name" placeholder="Chù Đề" class="form-control input-md" type="text">
            
          </div>
        </div>
      
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="total"></label>  
          <div class="col-md-12">
          <input id="total" name="total" placeholder="Số Câu Hỏi" class="form-control input-md" type="number">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="right"></label>  
          <div class="col-md-12">
          <input id="right" name="right" placeholder="Số Đáp Án Đúng" class="form-control input-md" min="0" type="number">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="wrong"></label>  
          <div class="col-md-12">
          <input id="wrong" name="wrong" placeholder="Thông số trừ điểm khi làm sai" class="form-control input-md" min="0" type="number">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="time"></label>  
          <div class="col-md-12">
          <input id="time" name="time" placeholder="Thời Gian Làm Bài" class="form-control input-md" min="1" type="number">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="tag"></label>  
          <div class="col-md-12">
          <input id="tag" name="tag" placeholder="Tag # Thông tin chi tiết" class="form-control input-md" type="text">
            
          </div>
        </div>
        
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="desc"></label>  
          <div class="col-md-12">
          <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Mo tả"></textarea>  
          </div>
        </div>
        
        
        <div class="form-group">
          <label class="col-md-12 control-label" for=""></label>
          <div class="col-md-12"> 
            <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
          </div>
        </div>
        
        </fieldset>
        </form></div>';
        }
        ?>
        <!--add quiz so 1 end-->

    <!--add Quiz so 2 start-->
        <?php
        if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {
          echo ' 
        <div class="row">
        <span class="title1" style="margin-left:40%;font-size:30px;"><b>Nhập Thông Tin Câu Hỏi</b></span><br /><br />
         <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=4 "  method="POST">
        <fieldset>
        ';

          for ($i = 1; $i <= @$_GET['n']; $i++) {
            echo '<b>Câu Hỏi Số :' . $i . '</><br /><!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
          <div class="col-md-12">
          <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Câu hỏi Số' . $i . ' "></textarea>  
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="' . $i . '1"></label>  
          <div class="col-md-12">
          <input id="' . $i . '1" name="' . $i . '1" placeholder="a" class="form-control input-md" type="text">
            
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="' . $i . '2"></label>  
          <div class="col-md-12">
          <input id="' . $i . '2" name="' . $i . '2" placeholder="b" class="form-control input-md" type="text">
            
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="' . $i . '3"></label>  
          <div class="col-md-12">
          <input id="' . $i . '3" name="' . $i . '3" placeholder="c" class="form-control input-md" type="text">
            
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-12 control-label" for="' . $i . '4"></label>  
          <div class="col-md-12">
          <input id="' . $i . '4" name="' . $i . '4" placeholder="d" class="form-control input-md" type="text">
            
          </div>
        </div>
        <br />
        <b>Đáp Án Đúng</b>:<br />
        <br>
        <select id="ans' . $i . '" name="ans' . $i . '" placeholder="Chọn Đáp Án Đúng " class="form-control input-md" >
           <option value="a">chọn đáp án đúng của câu hỏi :' . $i . '</option>
          <option value="a">option a</option>
          <option value="b">option b</option>
          <option value="c">option c</option>
          <option value="d">option d</option> </select><br /><br />';
          }

          echo '<div class="form-group">
          <label class="col-md-12 control-label" for=""></label>
          <div class="col-md-12"> 
            <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
          </div>
        </div>
        
        </fieldset>
        </form></div>';
        }?>
        <!--add quiz step 2 end-->

    <!--Xoa quiz-->
          <?php if (@$_GET['q'] == 5) {
          $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
          echo '<div class="panel">
                  <div class="table-responsive">
                    <table class="table table-striped title1">
                    <tr>
                      <td><b>TT</b></td>
                      <td><b>Chủ Đề</b></td>
                      <td><b>Câu Hỏi</b></td>
                      <td><b>Thời Gian</b></td>
                      <td></td>
                    </tr>';
          $c = 1;
          while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $total = $row['total'];
            $time = $row['time'];
            $eid = $row['eid'];
            echo '<tr>
              <td>' . $c++ . '</td>
              <td>' . $title . '</td>
              <td>' . $total . '</td>
              <td>' . $time . ' min</td>
              <td><b><a href="update.php?q=rmquiz&eid=' . $eid . '" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> <span class="title1"><b>Xóa</b></span></a></b></td></tr>';
          }
          $c = 0;
          echo '</table></div></div>';
        }
        ?>
            </div>
            <!--container closed-->
        </div>
    </div>
</body>

</html>
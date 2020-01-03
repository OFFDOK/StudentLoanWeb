
<!DOCTYPE html>
<html>
<head>
	<!-- <?php include 'layout.php';?> -->
  <meta charset="utf-8">
  <title>Student Loan@SUT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--  <link rel="shortcut icon" href="http://localhost/search-mati/favicon.png" type="image/x-icon" /> -->
	<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style type="text/css">


			 	@font-face {
    				font-family: ff; /*a name to be used later*/
    				src: url(font/Kanit-Light.ttf); /*URL to font*/
					}
				body {
					
					background-color:#ffb347
         
				}
				.card{
			 		
			 		margin-top: 1.25rem;
			 		width: 400px;
			 		height: 250px;
			 	}
			</style>
</head>
<body>
	<center>
		<div style="margin-top: 65px">
					<label for="psw">
					<img src="./img/slfLogo.png" height="120" width="120" style="border-radius: 10px;margin-bottom:20px;">
					<br>
              			<font style="font-family: ff;font-size: 30px;color:#000080;">ระบบกองทุนกู้ยืมเพื่อการศึกษา 
						  (Student Loan@SUT)</font>
              		</label>
              	</div>
	<div class="card"> 
            <br>
            <div class="card-body" style="background-image:url(/img/card2.png);border-radius: 10px;">
				        <p style="visibility: hidden;">s</p>			

         <form name="form1" method="post" action="login.php">
          			<form role="form">
            		<div class="form-group" align="left" style="margin-left: 50px">
              			<label for="usrname"><span class="glyphicon glyphicon-user"></span>
              				<font style="font-family: ff;">Username</font></label>  
              			<input style ="width: 300px" type="username" class="form-control" name="txtUsername" id="txtUsername" placeholder="Username " required autofocus>
          			</div>
        	   <div class="form-group" align="left" style="margin-left: 50px">
              		<label for="psw">
              			<span class="glyphicon glyphicon-eye-close"></span><font style="font-family: ff;"> Password</font>
              		</label>
        				<input style ="width: 300px" type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Password" required autofocus>
      		   </div>
      		<br>
        	<div class="form-group" align="center">
          		<button style="width: 120px;height:40px;border-radius: 40px" type="submit" name="Submit" class="btn btn-success">
          			<font style="font-family: ff;">เข้าสู่ระบบ</font>
          		</button>
        	</div>
		</form>
                 <p style="visibility: hidden;">s</p>
            </center>
</body>
</html>
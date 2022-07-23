<?php
include("config/database.php");
$successful = "false";
session_start();
$error = "";
if(isset($_POST['login'])){
	$error = "none";
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	 $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(empty($username) || empty($password)){
		sleep(1);
        $error = "Username Or password is empty";
    }
    else{
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1){
			sleep(1);
          $error = "User does not exist";
        }else{
            if($row = mysqli_fetch_assoc($result)){
                if(!($password == $row['password'])){
					sleep(1);
                    $error = "Password is incorrect";
                }else if($password == $row['password']){
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];

						$successful = "done";
						$error = "none";
						sleep(7);
						if($row['type']=="sadmin"){
                            header("Location: modules/sadmin/");
                            exit(0);
						}
						if($row['type']=="admin"){
							header("Location: modules/admin/");
                            exit(0);
						}
						if($row['type']=="teacher"){
							header("Location: modules/teacher/");
                            exit(0);
						}
						if($row['type']=="student"){
							header("Location: modules/student/");
                            exit(0);
						}
						if($row['type']=="parent"){
						    header("Location: modules/parent/");
                            exit(0);
                        }
                }
            }
        }
    }
}
if(isset($_SESSION['id'])){
    $username1 = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username1'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if($row['type']=="sadmin"){
        header("Location: modules/sadmin/");
        exit(0);
    }
    if($row['type']=="admin"){
        header("Location: modules/admin/");
        exit(0);
    }
    if($row['type']=="teacher"){
        header("Location: modules/teacher/");
        exit(0);
    }
    if($row['type']=="student"){
        header("Location: modules/student/");
        exit(0);
    }
    
}else{
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>UWS Academy</title>


        <link rel='stylesheet prefetch'
              href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>

        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/ss.css">

    </head>
	
	 <body>
	<img align='right' height='82px' src='images/uws.jpg'>
	
	<marquee direction='up' bgcolor='#35394a' height='82px' width='1331px' scrollamount='2'> <pre><font color='white' size='80px'>
කැම්පස් යන්න ළඟම පාර  #UWS Academy#  GCE Advanced Level
Combined Maths 		08.A.M.-12.P.M.		Monday
Biology			08.A.M.-12.P.M.		Monday
Physics			08.A.M.-12.P.M.		Tuesday
Chemistry		08.A.M.-12.P.M.		Wednesday
Science for Tech.	08.A.M.-12.P.M.		Monday
Engineering Tech.	08.A.M.-12.P.M.		Thursday
ICT			08.A.M.-12.P.M.		Saturday
English O/Level		03.P.M.-06.P.M.		Monday
English A/Level		01.P.M.-05.P.M.		Tuesday
</font> <pre> 
	</marquee>
	
	
    
    
    
     <img src="images/cover1.jpeg" class="slide" width="1000" height="560" />
     

    

    
    <?php if ($successful == "false") {
        ?>
		<div align="center">
        <div class='login'>
		
            <div class='login_title'>
			
                <span>Login to your account</span><br>
                <span style="color:red"><?php echo $error; ?></span>
		
            </div>
			
            <div class='login_fields'>
                <form action="index.php" method="post">
                    <div class='login_fields__user'>
                        <div class='icon'>
                            <img src='images/user_icon_copy.png'>
                        </div>
                        <input placeholder='EID/SID' type='text' name="username">
                        <div class='validation'>
                            <img src='images/tick.png'>
                        </div>
                        </input>
                    </div>
                    <div class='login_fields__password'>
                        <div class='icon'>
                            <img src='images/lock_icon_copy.png'>
                        </div>
                        <input placeholder='Password' type='password' name="password">
                        <div class='validation'>
                            <img src='images/tick.png'>
                        </div>
                    </div>
                    <div class='login_fields__submit'>
                        <input type='submit' value='Log In' name="login">
                        
                    </div>
                </form>
				
            </div>
                
        </div>
    <?php } ?>
    
	
	<marquee  bgcolor='#35394a' height='82px'  scrollamount='2'> <pre><font color='white' size='80px'>UWS Academy,Upper Flow,Hiru Graphics,Preman Mawatha,Anuradhapura		admin@uwsacademy.com 		025-4319653		0764895740</font> <pre> </marquee>
	</p>
    
    


    </body>

    </html>

<?php } ?>

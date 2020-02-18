<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($db,$_POST['myusername']);
        $mypassword = mysqli_real_escape_string($db,$_POST['mypassword']);

	$sql = "select * from members where username = '".$myusername."'";
	$rs = mysqli_query($db,$sql);
	$numRows = mysqli_num_rows($rs);

	if($numRows  == 1){
		$row = mysqli_fetch_assoc($rs);
		if(password_verify($mypassword,$row['password'])){
      $_SESSION['login_user'] = $myusername;
      header("location: frontpage.php");
		}
		else{
      $error = "Dit brugernavn eller password er ikke korrekt";
		}
	}
	else{
    $error = "Din bruger kunne ikke findes";
	}
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="signin.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115740420-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-115740420-2');
    </script>



<title>SKAT - Beslutningsprocess</title>
  </head>
<body class="text-center">


  <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="form-signin" style="width:300px;">
    <a href="index.php"> <img src="skat-logo.png" alt="SKAT" style="height:63px;"> </a> <br/><br/><br/>
  	<input type="text" name="myusername" value="" placeholder="Username" class = "form-control">
  	<input type="password" name="mypassword" value="" placeholder="Password" class = "form-control">
  	<button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Log ind</button>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
    <br />

    <a href="createproject.php" style="text-decoration:none;"> <type="button" class="btn btn-sm btn-block btn-outline-primary">Tilføj et nyt projekt</a>

  </form>


                <br />


            </div>

         </div>

      </div>

   </body>
</html>
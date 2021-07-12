<?php
 error_reporting(0);
 ini_set('display_errors', 0);
 
require_once('includexa/membersite_config.php');
    if(isset($_POST['logged'])){
    	$excode = $_POST['examcode'];
    	if($fgmembersite->examLogin()){
    		if($_SESSION['examcode'] == "$excode"){
    	//	$fgmembersite->RedirectToURL("examindex.php");
    	}
    	else{
    		echo"";
    	}
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title></title>
  	<link rel="stylesheet" href="css/font-awesome_4.7.0.css">
  	<link rel="stylesheet" href="css/bootstrap_4.5.2.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>
@import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);


body{
    margin: 0;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    text-align: left;
    background-color: #f5f8fa;
}

.navbar-laravel
{
    box-shadow: 0 2px 4px rgba(0,0,0,.04);
}

.navbar-brand , .nav-link, .my-form, .login-form
{
    font-family: Raleway, sans-serif;
}

.my-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.my-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.login-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.login-form .row
{
    margin-left: 0;
    margin-right: 0;
}
.fntsize{
	font-size: x-large;
}
.brdth{
	border-width: thick;
	border-radius: 1.25rem;
}
.brdrdus{
	border-radius: calc(1.25rem - 5px) calc(1.25rem - 5px) 0 0;
	background-color: silver;
	padding: .75rem 1.25rem;
}
.brbtm{
	border-radius: 0 0 calc(1.25rem - 5px) calc(1.25rem - 5px);
	background-color: #0000000f;
}
</style>
</head>
<body class="bg-light">
<main class="login-form">
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card brdth">
                	<div style="padding: 3px">
                    <div class=" text-center fntsize font-weight-bolder brdrdus">Login</div>
                    <div class="card-body brbtm">
                        <form action="<?php echo $fgmembersite->GetSelfScript();?>" method="post">
    					  <input type="hidden" name="logged" value="1" />
        <div>
         <span class='error' style="color: red;"><?php echo $fgmembersite->GetErrorMessage();?></span>
        </div>
                            <div class="form-group row">
                                <label for="examcode" class="col-md-4 col-form-label text-md-right font-weight-bold">Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="examcode" class="form-control" name="examcode" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="fullScreen('examindex.php');">
                                    Submit
                                </button>
                                
                            </div>
                    </div>
                    </form>
                </div>
            	</div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
</html>
<script type="text/javascript">
    function fullScreen(theURL) {
 var popup = window.open(theURL, "popup", "fullscreen");
  if (popup.outerWidth < screen.width || popup.outerHeight < screen.height)
  {
    popup.moveTo(0,0);
    popup.resizeTo(screen.width, screen.height);
  }
}

</script> 
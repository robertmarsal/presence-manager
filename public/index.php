<?php 
    session_start();
   
    // if user is logged in do not show login screen
    if (isset($_SESSION['role'])){
        switch($_SESSION['role']){
            case 'admin':
                header('Location: app/admin.php');
                break;
            case 'user':
                header('Location: app/user.php');
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home | Presence</title>
	<link rel="stylesheet" href="../lib/twitter-bootstrap/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/screen.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
    <!-- Topbar
    ================================================== -->
    <div class="topbar" data-scrollspy="scrollspy" >
      <div class="topbar-inner">
        <div class="container">
            <a class="brand" href="index.php">Presence</a>
            <ul class="nav">
                <li class="active"><a href="index.php">Login</a></li>
                <li><a href="app/help.php">Help</a></li>
            </ul>
     
        </div>
      </div>
    </div>
    
	<div class="container">
		<section id="login">
			<div class="row">
				<div class="span6">
                    <h2>Users</h2>
                    <p>Log in to ...</p>
                    <h2>Admins</h2>
                    <p>Log in to manage users, check system status,...</p>
                </div>
				<div class="span10">
					<form class="form-stacked" action="app/login.php" method="post">
						<fieldset>
                            <div class="clearfix">
                                <label for="email">Email</label>
                                <div class="input">
                                    <input class="xlarge" id="email" name="email" size="30" type="text" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="password">Password</label>
                                <div class="input">
                                    <input class="xlarge" id="password" name="password" size="30" type="password" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <input type="submit" class="btn primary" value="&nbsp;Login&nbsp;">&nbsp;
                                <button type="reset" class="btn">Cancel</button>
                            </div>
    					</fieldset>
					</form>

			</div>
		</section>
        <footer class="footer">
            <div class="container">
                <p>Developed by <a href="http://twitter.com/robertboloc" target="_blank">@robertboloc</a><br/>
                Licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>
                </p>
            </div>
        </footer>
	</div>

</body>
</html>
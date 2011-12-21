<?php
    session_start();
    
    // check to avoid direct url access
    if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin'){
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin | Presence</title>
	<link rel="stylesheet" href="../lib/twitter-bootstrap/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/screen.css" type="text/css">
    <link rel="shortcut icon" href="../favicon.ico">
</head>
<body>
    <!-- Topbar
    ================================================== -->
    <div class="topbar" data-scrollspy="scrollspy" >
      <div class="topbar-inner">
        <div class="container">
            <a class="brand" href="../index.php">Presence</a>

        <ul class="nav">
            <li class="active"><a href="#overview">Home</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Help</a></li>
        </ul>

		<ul class="nav secondary-nav">
            <li><a href="logout.php">Log Out</a></li>
        </ul>

        </div>
      </div>
    </div>
</body>
</html>
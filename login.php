<?php
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index2.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index2.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: index3.php");
		        exit();
            }else{
				header("Location: sign-in.html?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: sign-in.html?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index3.php");
	exit();
}
































// $uname = $_POST['uname'];
// $pass = $_POST['password'];
// $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";

// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) === 1) {
//     $row = mysqli_fetch_assoc($result);
//     if ($row['username'] === $uname && $row['password'] === $pass) {
//         $_SESSION['username'] = $row['username'];
//         // $_SESSION['name'] = $row['name'];
//         // $_SESSION['id'] = $row['id'];
//         header("Location: index.html");
//         exit();
//     }else{
//         header("Location: index.html  ?error=Incorect User name or password");
//         exit();
//     }
// }
?>
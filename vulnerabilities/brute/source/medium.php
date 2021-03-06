<?php

if( isset( $_GET[ 'Login' ] ) ) {
	// Sanitise username input
	$user = $_GET[ 'username' ];
	$user = mysqli_real_escape_string($con, $user );

	// Sanitise password input
	$pass = $_GET[ 'password' ];
	$pass = mysqli_real_escape_string($con, $pass );
	$pass = md5( $pass );

	// Check the database
	$query  = "SELECT * FROM `users` WHERE user = '$user' AND password = '$pass';";
	$result = mysqli_query($con, $query ) or die( '<pre>' . mysqli_error($con) . '</pre>' );

	if( $result && mysqli_num_rows( $result ) == 1 ) {
		// Get users details
		$avatar = mysqli_result( $result, 0, "avatar" );

		// Login successful
		$html .= "<p>Welcome to the password protected area {$user}</p>";
		$html .= "<img src=\"{$avatar}\" />";
	}
	else {
		// Login failed
		sleep( 2 );
		$html .= "<pre><br />Username and/or password incorrect.</pre>";
	}

	mysqli_close();
}

?>

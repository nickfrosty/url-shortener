<?php
require_once('./config.php');

// verify the url data has been posted to this script
if (isset($_POST['url']) && $_POST['url'] != '')
	$url = sanitize($_POST['url']);
else
	$url = '';

// verify that a url was provided and that it is a valid url
if ($url != '' && strlen($url) > 0) {
	if (validate_url($url) == true) {

		// create a connection to the database
		$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

		$code = generate_code();

		// ensure the 'code' is not already taken in the database. if so, generate another
		$query = mysqli_query($conn, "SELECT * FROM short_links WHERE code='{$code}'");
		while (mysqli_num_rows($query) != 0) {
			$code = generate_code();
			$query = mysqli_query($conn, "SELECT * FROM short_links WHERE code='{$code}'");
		}

		// create all the variables to save in the database
		$id = '';
		$timestamp = time();
		$count = 0;

		// add the new code into the database
		mysqli_query($conn, "INSERT INTO short_links VALUES ('$id', '$code', '$url', '$count', '$timestamp')");

		// verify that the new record was created
		$query = mysqli_query($conn, "SELECT * FROM short_links WHERE timestamp='$timestamp' AND code='$code'");
		if ($data = mysqli_fetch_assoc($query)) {
			/* SUCCESS POINT */

			echo SITE_ADDR . '/' . $code;
		} else
			echo 'unable to shorten your url';
	} else
		echo 'please enter a valid url';
} else
	echo 'hmm... no url was found';

<?php

	include("include/init.php");

	loadlib("browserid");
	loadlib("api");
	loadlib("api_output");

	# TO DO: require local crumb?

	$assertion = post_str("assertion");

	if (! $assertion){
		api_output_error(999, "Missing assertion");
	}

	$rsp = browserid_verify($assertion);

	if (! $rsp['ok']){
		api_output_error(999, $rsp['error']);
	}

	# TO DO: login stuff here and redirect...
	# TO DO: redirect parameter

	# api_output_ok($rsp['user']);
	exit();
?>

<?php

	loadlib("http");

	$GLOBALS['browserid_endpoint'] = 'https://browserid.org/';

	#################################################################

	function browserid_verify($assertion){

		$params = array(
			'assertion' => $assertion,
			'audience' => $GLOBALS['cfg']['abs_root_url'],
		);

		$query = http_build_query($params);

		$headers = array(
			'Content-type' => 'application/x-www-form-urlencoded',
		);

		# TO DO: check to see if this is set in $GLOBALS['cfg']

		$url = $GLOBALS['browserid_endpoint'] . "verify";

		$rsp = http_post($url, $query, $headers);

		if (! $rsp['ok']){
			return $rsp;
		}

		$data = json_decode($rsp['body'], "as hash");

		if (! $data){
			return not_okay("failed to parse response");
		}

		return okay(array('user' => $data));
	}

	#################################################################

?>

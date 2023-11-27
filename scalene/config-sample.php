<?php

$config["router"]["default_controller"] = "welcome";
$config["router"]["override"]["welcome/about"] = "welcome/page/about";

$config["load"]["core"][] = "database";
$config["load"]["core"][] = "email";

$config["database"]["server"] = "localhost";
$config["database"]["database"] = "database";
$config["database"]["user"] = "user";
$config["database"]["pass"] = "password";

$config["email"]["server"] = "mail.example.com";	// SMTP server
$config["email"]["port"] = 465;		// SMTP SSL port
$config["email"]["user"] = "tim@example.com";	// SMTP User
$config["email"]["pass"] = "thisisforeveryone";		// SMTP password
$config["email"]["from"] = array("email"=>"tim@example.com", "name"=>"Tim BL"); // Where the emails come from

$config["pushover"]["appID"] = "";	// Pushover api app ID
$config["pushover"]["userID"] = "";	// Pushover user ID

$config["twitter"]["oauth_access_token"] = "";			// These are self-explanatory
$config["twitter"]["oauth_access_token_secret"] = "";
$config["twitter"]["consumer_key"] = "";
$config["twitter"]["consumer_secret"] = "";

$config["users"]["dbtable"] = "users";	// Database table used by core/Users_core.php. Expects a structure of at 
										// least: (username, email, password)

$config["googlelocation"]["googlekey"] = "";
<?php

/************************************************************ Database Functions ******************************************************************************************************************************************************************/

function create_messenger_user($name, $sender_id, $last_message, $profile_pic_url, $locale, $timezone, $gender, $sign_up_timestamp,
	$last_message_timestamp, $db){
	//Check to see if the user is in the Database. If not add them to the db. 
	$query = "SELECT name FROM messenger_users WHERE facebook_id= '" . $sender_id . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$name = pg_fetch_result($result, 0, 0);
	}else{
		$query = "INSERT INTO messenger_users (id, name, facebook_id, profile_pic_url, locale, timezone, gender, last_message, sign_up_timestamp,
			last_message_timestamp) VALUES (DEFAULT, '" . $name . "','" . $sender_id . "', '" . $profile_pic_url . "', '" . $locale . "', '" . $timezone . "'
			, '" . $gender . "', '" . $last_message . "', '" . $sign_up_timestamp . "', '" . $sign_up_timestamp . "')";
		$result = pg_query($db, $query);
	}

}

function create_messenger_message_log($message, $log_timestamp, $description, $type, $db){
	$query = "INSERT INTO messenger_message_log (id, message, log_timestamp, description, type) 
	VALUES (DEFAULT, '" . $message . "', '" . $log_timestamp . "', '" . $description . "', '" . $type . "')";
	$result = pg_query($db, $query);
}

function create_messenger_error_log($message, $timestamp, $description, $type, $db){
	$query = "INSERT INTO messenger_error_log (id, message, timestamp, description, type) 
	VALUES ('" . $message . "', '" . $timestamp . "', '" . $description . "', 
	'" . $type . "')";
	$result = pg_query($db, $query);
}

function create_admin_user($name, $password, $permissions, $last_login, $sign_up_timestamp){
	//Check to see if the user is in the Database. If not add them to the db. 
	$query = "SELECT name FROM admin_users WHERE id= '" . $admin_id . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$name = pg_fetch_result($result, 0, 0);
	}else{
		$query = "INSERT INTO admin_users (name, password, permissions, last_login) 
		VALUES ('" . $name . "','" . $password . "', '" . $permissions . "',
		'" . $last_login . "', '" . $sign_up_timestamp . "')";
		$result = pg_query($db, $query);
	}
}

function retrieve_admin_users(){
	// $query = "SELECT * FROM admin_users";
	// $result = pg_query($db, $query);
	// if (pg_num_rows($result) > 0){
	// 	$name = pg_fetch_assoc($result);
	// }else {
	// 	$name = "No Results";
	// }
	echo "Hey wassup";

}

function create_admin_user_log($admin_id, $admin_name, $admin_action, $permissions_level, $admin_action_timestamp, $db){
	if ($admin_id && $admin_name && $admin_action && $permissions_level && $admin_action_timestamp && $db)
	{
		$query = "INSERT INTO admin_action_log (admin_id, admin_name, admin_action, permissions_level, 
		admin_action_timestamp) 
		VALUES ('" . $admin_id . "','" . $admin_name . "', '" . $admin_action . "', '" . $permissions_level . "', 
		'" . $admin_action_timestamp . "')";
		$result = pg_query($db, $query);
	}
}

function retrieve_name($sender, $db){
	//Check to see if the user is in the Database. If so retrieve No. of failed allempts. If not add them to it the db and retrive No. of failed attempts 
	$query = "SELECT name FROM users WHERE id= '" . $sender . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$name = pg_fetch_result($result, 0, 0);
	}
	return $name;
}

function retrieve_last_message($sender, $db){
	//Check to see if the user is in the Database. If so retrieve No. of failed allempts. If not add them to it the db and retrive No. of failed attempts 
	$query = "SELECT last_message FROM users WHERE id= '" . $sender . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$last_message = pg_fetch_result($result, 0, 0);
	}else{
		update_last_message($sender, "0", $db);
		$last_message = "0";
	}
	return $last_message;
}

function update_name($sender, $name, $db){
	$query = "UPDATE users SET name = '". $name ."' WHERE id = '". $sender ."'";
	$result = pg_query($db, $query);
}

function update_last_message($sender, $last_message, $db){
	$query = "UPDATE users SET last_message = '". $last_message ."' WHERE id = '". $sender ."'";
	$result = pg_query($db, $query);
}

function update_state($sender, $state, $db){
		$query = "UPDATE users SET state = '". $state ."' WHERE id = '". $sender ."'";
		$result = pg_query($db, $query);
}

/************************************************************* End of Database Functions *****************************************************************************************************************************************************************/

?>
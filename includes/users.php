<?php

// A self-contained file thst holds all the functions we need for user authentication

function user_create($db, $email, $password) {
	$hashed_password = get_hashed_password ($password);

	$sql = $db->prepare('
		INSERT INTO users (email, password)
		VALUES (:email, :password)
	');
	$sql->bindValue(':email', $email, PDO::PARAM_STR);
	$sql->bindValue(':password', $hashed_password, PDO::PARAM_STR);
	$sql->execute();
}

function get_hashed_password ($password) {
	// Generates a random salt to be stored with the password
	$rand = substr(strtr(base64_encode(openssl_random_pseudo_bytes(16)), '+', '.'), 0, 22);
	$salt = '$2a$12$' . $rand;

	return crypt($password, $salt);
}
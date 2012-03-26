<?php

// A small utility file for us to create an admin user
// THIS FILE SHOULD NEVER BE PUBLICLY ACCESSIBLE!

require_once 'includes/db.php';
require_once 'includes/users.php';

$email = 'wadd0032@algonquinlive.com';

$password = 'vandal07';

user_create($db, $email, $password);
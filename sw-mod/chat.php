<?php
$email = epm_encode($row_user['employees_email']);
$password = epm_encode($row_user['employees_code']);

if (isset($email) && isset($password)) {
  header("Location: https://chat-sisterskominda.eagleye.id?email=$email&password=$password");
  exit;
}

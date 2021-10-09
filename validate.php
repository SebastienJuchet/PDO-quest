<?php
require '_connec.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	die('Page non accessible');
}
var_dump($_POST);
foreach ($_POST as &$post) {
	if (is_string($post)) {
		$post = trim(htmlspecialchars($post));
	}
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$errors = [];
if (
	empty($firstname) ||
	empty($lastname) ||
	strlen($lastname) > 45 ||
	strlen($firstname) > 45
) {
	$errors['error-empty'] = 'Les champs sont vides ou trop long';
	header('Location: /?' . http_build_query($errors));
} else {
	$pdo = new \PDO(DSN, USER, PASS);
	$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
	$statement = $pdo->prepare($query);

	$statement->bindParam('firstname', $firstname);
	$statement->bindParam('lastname', $lastname);
	$statement->execute();

	header('Location: /');
}




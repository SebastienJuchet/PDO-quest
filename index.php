<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
$query = 'SELECT * FROM friend';
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>FRIENDS</title>
</head>
<body>
	<ul>
		<?php foreach ($friends as $friend): ?>
			<li><?= $friend['firstname'] ?> <?= $friend['lastname'] ?></li>
		<?php endforeach ?>
	</ul>
    <?php if($_GET): ?>
        <p><?= $_GET['error-empty'] ?></p>
    <?php endif; ?>
    <form action="validate.php" method="post">
        <h2>Entre un nouvel ami</h2>
        <p><label for="first-name">Prénom</label></p>
        <p><input type="text" name="firstname" id="first-name"></p>

        <p><label for="last-name">Nom</label></p>
        <p><input type="text" name="lastname" id="last-name"></p>

        <p><button>Envoyer</button></p>
    </form>
</body>
</html>


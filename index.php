<?php
    if(isset($_POST['submit'])){
        echo 'form submitted';
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation Class - OOP</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="new-user">
        <h2>Create new user</h2>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="username">Name</label>
            <input type="text" name="username">
            <label for="email">E-mail</label>
            <input type="email" name="email">
            <input type="submit" value="submit" name="submit">
        </form>
    </div>
</body>
</html>

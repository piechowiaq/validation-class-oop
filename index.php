<?php

require 'Validator.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $data = [
          'firstname' => $_POST['firstname'],
          'email' => $_POST['email']
        ];

        $rules = [
            'firstname' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email']
        ];

        $validator = new Validator($data, $rules);
        $errors = $validator->validate();
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
   <main>
       <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
           <label for="firstname">Firstname</label>
           <input type="text" id="firstname" name="firstname" placeholder="Firstname ..." value="<?= $_POST['firstname'] ?? ''?>">
           <?php if (isset($errors['firstname'])) : ?>
                <p><?= $errors['firstname']?></p>
           <?php endif;?>

           <label for="email">Email</label>
           <input type="text" id="email" name="email" placeholder="Email ..." value="<?= $_POST['email'] ?? ''?>">
           <?php if (isset($errors['email'])) : ?>
               <p><?= $errors['email']?></p>
           <?php endif;?>

           <label for="password">Password</label>
           <input type="password" id="password" name="password" placeholder="Password ..." value="<?= $_POST['password'] ?? ''?>">
           <?php if (isset($errors['password'])) : ?>
               <p><?= $errors['password']?></p>
           <?php endif;?>

           <label for="password-repeat">Password repeat</label>
           <input type="password" id="password-repeat" name="password-repeat" placeholder="Password repeat ..." value="<?= $_POST['password-repeat'] ?? ''?>">
           <?php if (isset($errors['password-repeat'])) : ?>
               <p><?= $errors['password-repeat']?></p>
           <?php endif;?>
           <button type="submit">Submit</button>
       </form>
   </main>
</body>
</html>

<?php

require 'Validator.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $errors = [];

        if (! Validator::string($_POST['firstname'], 1, 255)){
            $errors['firstname'] = "Firstname not more th 255 characters is required";
        }


        if (! Validator::email($_POST['email']) ){
            $errors['email'] = "Valid email is required";
        }

        if(empty($errors)){
            echo "Data have been submitted";
        }



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
           <label for="firstname">Firstname?</label>
           <input type="text" id="firstname" name="firstname" placeholder="Firstname ..." value="<?= $_POST['firstname'] ?? ''?>">
           <?php if (isset($errors['firstname'])) : ?>
                <p><?= $errors['firstname']?></p>
           <?php endif;?>

           <label for="email">Lastname</label>
           <input type="text" id="email" name="email" placeholder="Email ..." value="<?= $_POST['email'] ?? ''?>">
           <?php if (isset($errors['email'])) : ?>
               <p><?= $errors['email']?></p>
           <?php endif;?>

           <button type="submit">Submit</button>
       </form>
   </main>
</body>
</html>

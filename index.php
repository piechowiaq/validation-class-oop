<?php
    require('UserValidator.php');

    if(isset($_POST['submit'])){

        $validation = new UserValidator($_POST);
        $errors = $validation->validateForm();

        // Save data to database


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
       <form action="includes/formhandler.php">
           <label for="firstname">Firstname?</label>
           <input type="text" id="firstname" name="firstname" placeholder="Firstname ...">

           <label for="lastname">Lastname></label>
           <input type="text" id="lastname" name="lastname" placeholder="Lastname ...">

           <label for="favouritepet"></label>
           <select name="favouritepet" id="favouritepet">
               <option value="none">None</option>
               <option value="dog">Dog</option>
               <option value="cat">Cat</option>
           </select>
       </form>
   </main>
</body>
</html>

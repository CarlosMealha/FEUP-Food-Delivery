<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/address.class.php');

  $db = getDatabaseConnection();



    $fname = htmlentities($_POST['fname']);
    $lname = htmlentities($_POST['lname']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['confirm_password'];
    $street = htmlentities($_POST['street']);
    $city = htmlentities($_POST['city']);
    $postalCode = htmlentities($_POST['postalCode']);
    $phone = $_POST['phone'];  

    if($password != $password2 ){
        $session->addMessage('Error','Passwords do not match');
        header('Location: /../register.php');
    }

    Address::save_newAddress($db, $city, $postalCode, $street);
    $id_Address = $db -> lastInsertId();
    User::save_newUser($db, $email, $password, $fname, $lname, (int)$phone, (int)$id_Address);
    $id_User = $db -> lastInsertId();

    $newUser = User:: getUser($db, (int)$id_User);

    if ($newUser) {
        $session->setId_User($newUser->id_User);
        $session->setName($newUser->fullName());
        $session->addMessage('Success', 'Account Created');
        header('Location: /../profile.php');
      } 

?>
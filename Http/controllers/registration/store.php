<?php

use Core\Validator;
use Core\App;
use Core\Database;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

 
// validate the form inputs
if (!Validator::email($email)) {

    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {

    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if(! empty($errors)){

    return  view("/registration/create.view.php", [

        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// check if the account already exists
$user = $db->query('select * from users where email = :email', [

    'email' => $email
])->find();

if($user){

    // if yes, redirects to a login page
    header('location: /');
    exit();

}else{

    // if not, save one to the database, and then log the user in, and redirect
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [

        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark that user has logged in.
    (new Authenticator())->login(['email' => $email]); 

    header('location: /');
    exit();
}   


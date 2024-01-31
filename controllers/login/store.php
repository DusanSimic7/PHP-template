<?php

use Core\Validator;
use Core\App;
use Core\Database;


$email = $_POST['email'];
$password = $_POST['password'];

$db = App::resolve(Database::class);



// validate the form inputs
if (!Validator::email($email)) {

    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {

    $errors['password'] = 'Please provide a valid password';
}



if(! empty($errors)){

    return  view("/login/create.view.php", [

        'errors' => $errors
    ]);
}



$user = $db->query('select * from users where email = :email', [

    'email' => $email
])->find();

if($user) {

    if(password_verify($password, $user['password'])){

        login(['email' => $email]);
    
        header('location: /');
        exit();
    }
    
}






return  view("/login/create.view.php", [

    'errors' => [

        'email' => 'No matching account found for that email address and password.'
    
    ] 
]);
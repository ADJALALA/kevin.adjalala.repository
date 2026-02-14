<?php
function my_password_change(PDO $bdd, string $email, string $new_password){
    if(empty($new_password)){
        throw new Exception();
    }
    $stmt = $bdd->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if(!$stmt->fetch()){
        throw new Exception();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $bdd->prepare("UPDATE users SET password = :password WHERE email = :email");
    $stmt->execute([
        'password' => $hashed_password,
        'email' => $email
    ]);

    //vérification du mot de passe
        //recupere le hash de la bdd

    // $stmt = $bdd->prepare("SELECT password FROM  users WHERE email = :email");
    // $stmt->execute(['email' => $email]);
    // $user = $stmt>fetch();

    //   //verifions si le mot de passe est correct
    // if(password_verify($password_saisi, $user['password'])){
    //     echo "mot de passe correct";
    // }else{
    //     echo "mot de passe incorrect";
    // }
}
?>
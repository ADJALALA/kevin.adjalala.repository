<?php 
$error = "";
$success = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = trim($_POST['name']??'');
    $email = trim($_POST['email']??'');
    $password = $_POST['password']??'';
    $password_confirmation = $_POST['password_confirmation']??'';

    $valid = true;

    if(strlen($name) < 3 || strlen($name) > 10){
        $error = "Invalid name";
        $valid = false;
    }
    if($valid && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email";
        $valid = false;
    }
    if($valid){
            if($password !== $password_confirmation){
            $error = "Invalid password or password confirmation";
            $valid = false;
        }elseif(strlen($password) < 3 || strlen($password) > 10){
            $error = "Invalid password or password confirmation";
            $valid = false;
        }
    }
    //si tout est valide , sauvegarder

    if($valid){
        $user = array(
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "created_at" => date('Y-m-d H:i:s')

        );
        // CHARGER LES UTILISATEURS EXISTANTS
        $users = array();
        if(file_exists('users.json')){
            $json = file_get_contents('users.json');
            $users = json_decode($json, true)?:array();
        }
        //ajouter le nouvel utilisateurs
        $users[] = $user;
        //sauvegarder dans le fivhier JSON
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        $success = 'User created';
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php if($error): ?>
        <p style="color: red;"><?php echo $error ?></p>
    <?php endif ?>

    <?php if($success): ?>
        <p style="color: green;"><?php echo $success ?></p>
    <?php endif ?>

    <form action="" method="POST">
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name"  placeholder="entrez votre nom" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email"  placeholder="exemple@gmail.com" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password"  placeholder="votre mot de passe" required>
        </div>
        <div>
            <label for="password">Confirmer mot de passe</label>
            <input type="password" name="password_confirmation"  placeholder="confirmer mot de passe" required>
        </div>
        <div>
            <button type="submit">Soumettre</button>
        </div>

    </form>
    
</body>
</html>
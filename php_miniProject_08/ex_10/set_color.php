<?php 
$error = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $color = $_POST['background'];
    $valid_colors = array('white', 'black', 'red', 'blue');

    if(in_array($color, $valid_colors)){
        setcookie('background_color', $color, time() +(30*24*3600), '/');
        header('Location: show_color.php', true, 302);
        exit();
    }else{
        $error = "invalid color";
        if(isset($_COOKIE['background_color'])){
            setcookie('background_color', $color, time() -3600, '/');
            unset($_COOKIE['background_color']);
            
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="set_color.php" method="POST">
        <label for="color"> choisir une couleur (white, black, red, blue)</label>
        <input type="text" name="background" required>
        <button type="submit">soumettre</button>
    </form>
    
    
</body>
</html>
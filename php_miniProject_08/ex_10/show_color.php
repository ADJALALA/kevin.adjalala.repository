<?php 

if(!isset($_COOKIE['background_color'])){
    header('Location: set_color.php', true, 302);
    exit();
}
$color = $_COOKIE['background_color'];
$valid_colors = array('white', 'black', 'red', 'blue');

if(!in_array($color, $valid_colors)){
    header('Location: set_color.php', true, 302);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: <?php echo htmlspecialchars($color); ?>;">
    <h1>La couleur su fond esy : <?php echo htmlspecialchars($color); ?> </h1>
    <a href="set_color.php">changer la couleur</a>
    
    
</body>
</html>
<?php 
if(!empty($_POST['name'])){
    echo "Hello " .htmlspecialchars($_POST['name']);
}else{
    ?>
    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="Entrez votre nom" required>
        <button type="submit">Soumettre</button>
    </form>
    <?php 
}
?>
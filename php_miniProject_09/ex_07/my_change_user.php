<?php
function my_change_user(PDO $bdd, ...$names){
    try{
        foreach($names as $name){
            $stmt = $bdd->prepare("SELECT id FROM users WHERE name = :name");
            $stmt->execute(['name' => $name]);

            if(!$stmt->fetch()){
                throw new PDOException("User not found");
            }
            $new_name = ucfirst(strtolower($name));

            $stmt = $bdd->prepare("UPDATE users SET name = :new_name WHERE name = :old_name");
            $stmt->execute([
                'new_name' => $new_name,
                'old_name' => $name
            ]);
        }
    }catch(PDOException $e){
        throw $e;
    }finally{
        echo "Good luck with the user DB!\n";
    }

}
?>
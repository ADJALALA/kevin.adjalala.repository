<?php 
function my_print_users(PDO $bdd, ... $ids){
    if(empty($ids)){
        return false;
    }
    $found = false;
    foreach($ids as $id){
        if(is_int($id)){
            throw new Exception("Invalid id given");
        }
        $stmt = $bdd->prepare("SELECT name FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        if($result){
            echo $result['name'] . "\n";
            $found = true;
        }
    }
    return $found;
    

}
?>
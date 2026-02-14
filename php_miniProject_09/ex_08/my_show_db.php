<?php
function my_show_db (PDO $bdd , string $table){
    try{
        $stmt = $bdd->query("SELECT * FROM $table");
        if(!$stmt){
            yield null;
            return;
        }
        while($row = $stmt->fetch()){
            $output = "";

            foreach($row as $key => $value ){
                $output .= "[$key]=>[$value], ";
            }
        }
    }
}
?>
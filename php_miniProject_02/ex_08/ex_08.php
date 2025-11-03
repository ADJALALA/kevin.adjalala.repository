<?php
function my_order_class_name(...$obj){
    $types =array();
    foreach($obj as $element){
        if(is_object($element)){
            $typeName = get_class($element);
        }else{
            $typeName = gettype($element);
        }
        if(!in_array($typeName, $types)){
            $types[] = $typeName;
        }

    }
    $typeWithLength = array();
    foreach($types as $type){
        $typesWithLength[] = array(
            'name' => $type,
            'length' => strlen($type)
        );
    }
    usort($typesWithLength, function($a,$b){
        if($a['length'] != $b['length']){
            return $a['length'] - $b['length'];
        }
        return strcasecmp($a['name'], $b['name']);
    });
    $result = array();
    $currentLength = -1;
    $currentGroup = array();

    foreach($typesWithLength as $typeInfo){
        if($typeInfo['length'] != $currentLength){
            if(!empty($currentGroup)){
                $result = $currentGroup;
            }
            $currentGroup = array($typeInfo['name']);
            $currentLength = $typeInfo['length'];
        }else{
            $currentGroup[] = $typeInfo['name'];
        }
    }
    if(!empty($currentGroup)){
        $result = $currentGroup;
    }
    return $result;
}
class MyClass
{
}
$args = [
true,
76,
false,
12.5,
"Coucou !",
[1, 2, 3],
new MyClass(),
NULL
];
print_r(my_order_class_name(...$args));


?>
<?php
function simplify_polynomial_expression(string $expression){
    $expanded = expandExpression($expression);
    $terms = parseTerms($expanded);
    $grouped = groupByDegree($terms);

    return formatOutput($grouped);
}
function expandExpression($expr){
    preg_match_all('/\(([^)]+)\)/', $expr, $matches);
    if(count($matches[0]) < 2){
        return $expr;
    }
    $poly1 = parseTerms($matches[1][0]);
    $poly2 = parseTerms($matches[1][1]);

    $result = array();
    foreach($poly1 as $term1){
        foreach($poly2 as $term2){
            $coef = $term1['coef']*$term2['coef'];
            $degree = $term1['degree'] + $term2['degree'];

            if(!isset($result[$degree])){
                $result[$degree] = 0;
            }
            $result[$degree] += $coef;
        }
    }
    return $result;
}
function parseTerms($str){
    $terms = array();
    preg_match_all('/([+-]?\d*)([a-z]?)(\^(\d+))?/', $str, $matches, PREG_SET_ORDER);

    foreach($matches as $match){
        if(empty($match[0]))continue;
        $coef = empty($match[1])?1:(int)$match[1];
        if($match[1] === '-')$coef = -1;
        if($match[1] === '+')$coef = 1;

        $hasVar = !empty($match[2]);
        $degree = 0;
        if($hasVar){
            $degree = empty($match[4])?1:(int)$match[4];
        }
        $terms[] = array(
            'coef' => $coef,
            'degree' => $degree,
            'var' => $match[2]
        );
    }
    return $terms;
}
function groupByDegree($terms){
    $grouped = array();

    foreach($terms as $term){
        $deg = $term['degree'];
        if(!isset($grouped[$deg])){
            $grouped[$deg] = 0;
        }
        $grouped[$deg] += $term['coef'];
    }
    $grouped = array_filter($grouped, function($coef){
        return $coef != 0;
    });
    return $grouped;
}
function formatOutput($grouped){
    krsort($grouped);

    $result = '';
    $first = true;

    foreach($grouped as $degree => $coef){
        if(!$first && $coef>0){
            $result .= '+'; 
        }
        $first = false;
        if($coef != 1 || $degree == 0){
            $result = $coef;
        }
        if($degree > 0){
            $result .= 'x';
            if($degree > 1){
                $result = '^'.$degree;
            }
        }
    }
    return $result;
}
echo simplify_polynomial_expression("(2xˆ2+4)(6xˆ3+3)");
?>
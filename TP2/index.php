<?php
/*
function add(int|float $a, int|float $b) : int|float
{
    return ($a > $b) ? $a : $b;
    //return max($a, $b);
}
print add("5", 2.5) . "\n";
*/

/*
function decrement (int $max, int $div = 2) : void
{
    while ($max >= 0)
    {
        echo ($max);
        if ($max % $div === 0)
            echo " divisible par $div";
        echo "\n";
        $max --;
    }
}
//decrement(10);
*/

//Correction :
function ex2(int $max, int $div = 2) : void
{
    for ( $i = ($max > 0) ? $max : -$max ; $i >= 0 ; $i --) {
        print ($i % $div) === 0 ? "$i divisible par $div\n" : "$i\n";
    }
}

//ex2(10);

//---

function puissance (int|float $a, int|float $b) : int|float
{
    $i = 0;
    while ($i < $b)
        $a *= $a;
    return $a;
}

//Correction :
function power (int|float $x, int $n) : int|float
{
    $i = 1;
    $power = 1;
    while ($i++ <= $n) $power *= $x;
    return $power;
}


//Correction partielle :
function select (int $selecteur)
{
    switch ($selecteur)
    {
        case 1:
            print "max :" . exercice1($a1, $a2) . "\n";
            break;
        case 2 :
            if (is_int($a1) && is_int($a2))
                exercice2($a1,$a2);
            else
                print("mauvais usage");
        default:
            print "pas compris";
    }
}
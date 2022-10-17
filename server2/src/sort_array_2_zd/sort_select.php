<?php

function sort_select($arr)
{
    $n=count($arr);
    $nextSwap=null;
    $cont=null;
    for($i=0; $i<$n-1; $i++)
    {
        $nextSwap=$i;
        for($j=$i+1; $j<$n; $j++)
        {
            if( $arr[$j]<$arr[$nextSwap] )
            {
                $nextSwap=$j;
            }
        }
        $cont=$arr[$i];
        $arr[$i]=$arr[$nextSwap];
        $arr[$nextSwap]=$cont;
    }
    return $arr;
}
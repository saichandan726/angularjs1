<?php

$sort=array('2','4','8','5','1','7','6','9','10','3');

echo "Unsorted array is: ";
echo "<br />";
print_r($sort);


for($j = 0; $j < count($sort); $j ++) {
    for($i = 0; $i < count($sort)-1; $i ++){

        if($sort[$i] > $sort[$i+1]) {
            $temp = $sort[$i+1];
            $sort[$i+1]=$sort[$i];
            $sort[$i]=$temp;
        }       
    }
}
echo "<br />";
echo "Sorted Array is: ";
echo "<br />";
print_r($sort);

?>
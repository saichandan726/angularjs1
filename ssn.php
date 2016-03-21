<?php
 $pnr = get_magic_quotes_gpc() ? $_POST['personnr'] 
 
if (checkPnr($pnr)) {
   echo 'RÄTT!';
} else {
   echo 'FEL!';
}
 
function checkPnr($pnr) {
    if ( !preg_match("/^\d{6}\-\d{4}$/", $pnr) ) {
        return false;
    }
    $pnr = str_replace("-", "", $pnr);
    $n = 2;
    for ($i=0; $i<9; $i++) {
        $tmp = $pnr[$i] * $n;
        ($tmp > 9) ? $sum += 1 + ($tmp % 10) : $sum += $tmp; ($n == 2) ? $n = 1 : $n = 2;
    }
 
    return !( ($sum + $pnr[9]) % 10);
}?>
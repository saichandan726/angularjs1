<?php
$ssn = "1234567890";
echo "<p>Before: ";
echo $ssn;
echo "</p>\n";

echo "<p>After: ";
print formatSSN($ssn);
echo "</p>\n";

function formatSSN($ssn) 
{


        if (preg_match("#^\d{3}-?\d{3}-?\d{4}$#", $ssn)) {
                return preg_replace("#^(\d{3})-?(\d{3})-?(\d{4})$#", "$1-$2-$3", $ssn);

        }
        else {
                die("Input cannot be formatted as a social security number.");
        }
}
/*changed.value = new Array(account.value.length-3).join('*') 	+  
		account.value.substr(account.value.length-4, 4);\n"; */
?>
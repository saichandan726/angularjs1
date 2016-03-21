<?php
echo "<input id=\"account\", value=\"1234567890\" />\n"; 
echo "<input id=\"account_changed\" />\n"; 

echo " <script>\n"; 

echo "var account = document.getElementById('account');\n"; 
echo "var changed = document.getElementById('account_changed');\n"; 

echo "changed.value = new Array(account.value.length-3).join('*') 	+  
		account.value.substr(account.value.length-4, 4);\n"; 
function changed($value){
	if (preg_match("/^[\dX]{3}-?[\dX]{3}-?[\dX]{4}$/", $value)) {
                return preg_replace("/^([\dX]{3})-?([\dX]{3})-?([\dX]{4})$/", "$1-$2-$3", $value);

        }
}

		
echo "</script>\n"; 

/*function fnValidateSocialSecurityCode($ssb)
{
    #eg. 531-63-5334
    return preg_match('/^[\d]{3}-[\d]{2}-[\d]{4}$/',$ssn);
}*/
?>
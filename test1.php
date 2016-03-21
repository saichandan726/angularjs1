<?php
    $goodSSN = "220177-1234";
    $badSSN = "220A77-1234";

    $regex = "/[0-9]{6}-[0-9]{4}/";

    if (preg_match($regex, $goodSSN)) {
        echo "Good: You should see this message because this was a good SSN.\n";
    } else {
        echo "Good: You won't see this message.\n";
    }

    if (preg_match($regex, $badSSN)) {
        echo "Bad: You won't see this message.\n";
    } else {
        echo "Bad: You should see this message because this was a bad SSN.\n";
    }
?>
<?php

function calculate($num1, $operator, $num2) {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return "Invalid input. Please enter numbers.";
    }

    switch ($operator) {
        case '+':
            return htmlspecialchars($num1 + $num2);
        case '-':
            return htmlspecialchars($num1 - $num2);
        case '*':
            return htmlspecialchars($num1 * $num2);
        case '/':
            if ($num2 == 0) {
                return "Error: Division by zero.";
            }
            return htmlspecialchars($num1 / $num2);
        default:
            return "Invalid operator. Please use +, -, *, or /.";
    }
}

if (isset($_GET['num1']) && isset($_GET['operator']) && isset($_GET['num2'])) {
    $result = calculate($_GET['num1'], $_GET['operator'], $_GET['num2']);
    echo $result;
} else {
    echo "Please provide num1, operator, and num2 as GET parameters.";
}

?>

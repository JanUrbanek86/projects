<?php
// Calculator Advanced PHP

function calculateBasic($num1, $num2, $operator) {
    switch ($operator) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2;
        case '/':
            return $num1 / $num2;
        case 'pow':
            return pow($num1, $num2);
        case 'sqrt':
            return sqrt($num1);
        case 'modulo':
            return fmod($num1, $num2);
        case 'percent':
            return ($num1 * $num2) / 100;
    }
}

function calculateScientific($x, $func) {
    switch ($func) {
        case 'log':
            return log($x);
        case 'ln':
            return log($x) / log(M_E);
        case 'sin':
            return sin($x);
        case 'cos':
            return cos($x);
        case 'tan':
            return tan($x);
        case 'abs':
            return abs($x);
        case 'roundUp':
            return ceil($x);
        case 'roundDown':
            return floor($x);
        case 'round':
            return round($x);
    }
}

session_start();
$history = array();
if (isset($_SESSION['history'])) {
    $history = $_SESSION['history'];
}

function saveHistory($func, $num1, $num2, $operator) {
    global $history;
    $history[] = [
        'func' => $func,
        'num1' => $num1,
        'num2' => $num2,
        'operator' => $operator
    ];
    $_SESSION['history'] = $history;
}

function exportHistoryToCSV() {
    global $history;
    // Code for exporting history to CSV
}

function deleteHistoryEntry($index) {
    global $history;
    if (isset($history[$index])) {
        unset($history[$index]);
        $_SESSION['history'] = $history;
    }
}

$theme = 'light';
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];
}

function toggleTheme() {
    global $theme;
    if ($theme == 'light') {
        $theme = 'dark';
    } else {
        $theme = 'light';
    }
    $_GET['theme'] = $theme;
}

// Error handling and logging
function handleError($errorMessage) {
    // Code for error handling and logging
}

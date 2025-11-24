<!DOCTYPE html>
<html>
<head>
    <title>Kalkulaèka</title>
</head>
<body>
    <h1>Kalkulaèka</h1>
    
    <form method="POST">
        <input type="text" name="num1" placeholder="Èíslo 1" required>
        <select name="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="text" name="num2" placeholder="Èíslo 2" required>
        <button type="submit">Vypoèítat</button>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        
        // CHYBA #1: Chybí validace vstupu
        
        if ($operator == '+') {
            $result = $num1 + $num2;
        } elseif ($operator = '-') {  // CHYBA #2: = místo ==
            $result = $num1 - $num2;
        } elseif ($operator == '*') {
            $result = $num1 * $num2;
        } elseif ($operator == '/') {
            $result = $num1 / $num2;  // CHYBA #3: Dìlení nulou
        }
        
        echo "<h2>Výsledek: $result</h2>";  // CHYBA #4: Nezabezpeèený výstup
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Kalkulačka</title>
</head>
<body>
    <h1>Kalkulačka</h1>
    
    <form method="POST">
        <input type="text" name="num1" placeholder="Číslo 1" required>
        <select name="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="**">^</option>
            <option value="sqrt">√</option>
        </select>
        <input type="text" name="num2" placeholder="Číslo 2" required>
        <button type="submit">Vypočítat</button>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        
        // Validace vstupu
        if (!is_numeric($num1) || !is_numeric($num2)) {
            echo "<p style='color:red'>Chyba: Zadejte platná čísla!</p>";
        } else {
            $result = null;
            
            // Výpočet s opraveným operátorem
            if ($operator == '+') {
                $result = $num1 + $num2;
            } elseif ($operator == '-') {
                $result = $num1 - $num2;
            } elseif ($operator == '*') {
                $result = $num1 * $num2;
            } elseif ($operator == '/') {
                if ($num2 == 0) {
                    echo "<p style='color:red'>Chyba: Nelze dělit nulou!</p>";
                } else {
                    $result = $num1 / $num2;
                }
            } elseif ($operator == '**') {
                $result = pow($num1, $num2);
            } elseif ($operator == 'sqrt') {
                if ($num1 < 0) {
                    echo "<p style='color:red'>Chyba: Nelze vypočítat odmocninu z negativního čísla!</p>";
                } else {
                    $result = sqrt($num1);
                }
            }
            
            // Zabezpečený výstup
            if ($result !== null) {
                echo "<h2>Výsledek: " . htmlspecialchars($result) . "</h2>";
            }
        }
    }
    ?>
</body>
</html>

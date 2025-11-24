<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Kalkulačka</h1>
    <form action="" method="post">
        <input type="number" name="num1" placeholder="Číslo 1"><br><br>
        <input type="number" name="num2" placeholder="Číslo 2"><br><br>
        <select name="operator" id="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br><br>
        <button type="submit" name="action" value="calculate">Vypočítat</button>
    </form>
    <?php
    if (isset($_POST['action']) && $_POST['action'] === 'calculate') {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        
        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                $result = $num1 / $num2;
                break;
        }
        
        echo "<h2>Výsledek: " . $result . "</h2>";
    }
    ?>
</body>
</html>

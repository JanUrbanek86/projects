<?php
echo "<h1>Informace o PHP</h1>";
echo "<p>Verze: " . phpversion() . "</p>";
echo "<h2>Nainstalované moduly:</h2>";
$modules = get_loaded_extensions();
foreach ($modules as $module) {
    echo "<p>" . htmlspecialchars($module) . "</p>";
}
?>

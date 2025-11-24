<?php
// Zobrazí informace o PHP: verzi a nainstalovaných modulech

echo "<h1>PHP Informace</h1>";
echo "<p>Verze: " . phpversion() . "</p>";

$extensions = get_loaded_extensions();
sort($extensions);

echo "<h2>Nainstalované moduly:</h2><ul>";
foreach ($extensions as $ext) {
    echo "<li>" . htmlspecialchars($ext) . "</li>";
}
echo "</ul>";
?>

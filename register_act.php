<?php
declare(strict_types=1);

/**
 * Registrace účastníka na erotický veletrh.
 *
 * Připojení k databázi pomocí PDO (host: localhost, uživatel: root, heslo: '', db: cert).
 * Tabulka `participants` by měla mít následující strukturu:
 *
 * CREATE TABLE participants (
 *     id INT AUTO_INCREMENT PRIMARY KEY,
 *     name VARCHAR(255) NOT NULL,
 *     email VARCHAR(255) NOT NULL UNIQUE,
 *     password_hash CHAR(60) NOT NULL,   -- hash z password_hash()
 *     phone VARCHAR(20),
 *     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 * );
 *
 * V tomto souboru se provádí:
 * 1. Zpracování POST požadavku – validace vstupů,
 * 2. Hashování hesla pomocí password_hash(),
 * 3. Uložení záznamu do tabulky participants,
 * 4. Výpis jednoduchého potvrzení nebo chybové hlášky.
 */

function getPdo(): PDO
{
    $dsn = 'mysql:host=localhost;dbname=cert;charset=utf8mb4';
    $user = 'root';
    $pass = '';
    try {
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        // V produkčním prostředí by se zde logovala chyba a zobrazila by se uživatelsky přívětivá hláška
        die('Chyba při připojování k databázi.');
    }
}

$pdo = getPdo();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Získání a ošetření vstupů
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $phone    = trim($_POST['phone'] ?? '');

    // Jednoduchá validace
    if ($name === '' || $email === '' || $password === '') {
        $message = 'Prosím vyplňte všechna povinná pole.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Neplatná e‑mailová adresa.';
    } else {
        // Hashování hesla
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare(
                'INSERT INTO participants (name, email, password_hash, phone) VALUES (:name, :email, :hash, :phone)'
            );
            $stmt->execute([
                ':name'  => $name,
                ':email' => $email,
                ':hash'  => $hash,
                ':phone' => $phone !== '' ? $phone : null,
            ]);
            $message = 'Registrace úspěšná! Těšíme se na vás.';
        } catch (PDOException $e) {
            // Pokud je chyba unikátní klíč (email již existuje)
            if ($e->errorInfo[1] === 1062) {
                $message = 'E‑mail je už registrovaná.';
            } else {
                $message = 'Došlo k neočekávané chybě. Zkuste to prosím znovu.';
            }
        }
    }
}
?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>Registrace na erotický veletrh</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{display:flex;align-items:center;height:100vh;background:#f8f9fa;}
.container{max-width:500px;}
</style>
</head>
<body>
<div class="container">
  <?php if ($message !== '') : ?>
    <div class="alert alert-info text-center" role="alert"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>

  <h2 class="text-center mb-4">Registrace účastníka</h2>
  <form action="" method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Jméno a příjmení *</label>
      <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E‑mail *</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Heslo *</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Telefon (volitelné)</label>
      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
    </div>
    <button type="submit" class="btn btn-primary w-100">Registrovat</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

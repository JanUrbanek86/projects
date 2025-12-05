<?php
declare(strict_types=1);

$dsn = 'mysql:host=localhost;dbname=cert;charset=utf8mb4';
try {
    $pdo = new PDO($dsn, 'root', '');
} catch (PDOException $e) {
    die('Neboda se připojit k databázi.');
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login   = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Heslo je uložené v MD5
    $hashedPassword = md5($password);

    $stmt = $pdo->prepare('SELECT 1 FROM uzivatele WHERE login = :login AND heslo = :heslo');
    $stmt->execute(['login' => $login, 'heslo' => $hashedPassword]);

    if ($stmt->fetch()) {
        $message = 'Vítej, jsi ověřen.';
    } else {
        $message = 'Nick neexistuje.';
    }
}
?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>Přihlášení</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{display:flex;align-items:center;height:100vh;background:#f8f9fa;}</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <?php if ($message !== '') : ?>
        <div class="alert alert-info text-center" role="alert"><?php echo htmlspecialchars($message); ?></div>
      <?php endif; ?>
      <h2 class="text-center mb-4">Přihlášení</h2>
      <form action="" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Heslo</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Přihlásit</button>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

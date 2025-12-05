<?php
session_start();

require_once 'db_connect.php'; // Soubor s připojením k databázi (PDO instance $pdo)

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        try {
            // Načteme uživatele podle e‑mailu
            $stmt = $pdo->prepare('SELECT id, name, email, password FROM users WHERE email = :email');
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Ověříme heslo (hashované v databázi)
            if ($user && password_verify($password, $user['password'])) {
                // Přihlášení úspěšné – uložíme data do session
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Přesměrujeme na chráněnou stránku (např. dashboard)
                header('Location: dashboard.php');
                exit;
            } else {
                $message = 'Neplatný e‑mail nebo heslo.';
            }
        } catch (PDOException $e) {
            // V případě chyby v dotazu
            $message = 'Došlo k neočekávané chybě. Zkuste to prosím znovu.';
        }
    } else {
        $message = 'Vyplňte oba pole.';
    }
}
?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>Přihlášení na erotický veletrh</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{display:flex;align-items:center;height:100vh;background:#f8f9fa;}
.container{max-width:500px;}
</style>
</head>
<body>
<div class="container">
  <?php if ($message !== '') : ?>
    <div class="alert alert-danger text-center" role="alert"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>

  <h2 class="text-center mb-4">Přihlášení</h2>
  <form action="" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">E‑mail *</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Heslo *</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Přihlásit se</button>
  </form>
  <p class="text-center mt-3"><a href="register.php">Zaregistrovat se</a></p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

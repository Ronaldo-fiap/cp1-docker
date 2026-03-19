<?php
require_once 'db.php';

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS acessos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mensagem VARCHAR(255) NOT NULL,
            data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $pdo->exec("INSERT INTO acessos (mensagem) VALUES ('Acesso realizado com sucesso!')");

    $stmt = $pdo->query("SELECT * FROM acessos ORDER BY id DESC LIMIT 5");
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao executar operação no banco: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LAB 2 - PHP com MySQL</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef2f7;
      padding: 40px;
    }
    .box {
      background: white;
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: #0a6de6;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }
    th {
      background: #0a6de6;
      color: white;
    }
  </style>
</head>
<body>
  <div class="box">
    <h1>LAB 2 - Aplicação PHP com MySQL</h1>
    <p>Conexão com banco realizada com sucesso.</p>
    <p>Últimos registros inseridos:</p>

    <table>
      <tr>
        <th>ID</th>
        <th>Mensagem</th>
        <th>Data/Hora</th>
      </tr>
      <?php foreach ($registros as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['mensagem'] ?></td>
        <td><?= $row['data_hora'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
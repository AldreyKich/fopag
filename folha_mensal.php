<?php
require_once("conexao.php");

$pdo = conectar();

$msg_sucesso = "";
$msg_erro = "";

// Exclusão de folha mensal
if (isset($_GET['excluir'])) {
    $id_mes = $_GET['excluir'];
    $id_ano = $_GET['ano'] ?? '';

    if (preg_match('/^(0[1-9]|1[0-2])$/', $id_mes) && preg_match('/^\d{4}$/', $id_ano)) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Folha_Mensal WHERE Id_Mes = ? AND Id_Ano = ?");
            $stmt->execute([$id_mes, $id_ano]);
            $msg_sucesso = "Folha mensal $id_mes/$id_ano excluída com sucesso.";
        } catch (PDOException $e) {
            $msg_erro = "Erro ao excluir folha: " . $e->getMessage();
        }
    } else {
        $msg_erro = "Parâmetros inválidos para exclusão.";
    }
}

// Cadastro de nova folha mensal
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mes = trim($_POST["mes"] ?? "");
    $ano = trim($_POST["ano"] ?? "");

    if (empty($mes) || empty($ano)) {
        $msg_erro = "Preencha o Mês e o Ano.";
    } elseif (!preg_match('/^(0[1-9]|1[0-2])$/', $mes)) {
        $msg_erro = "Mês inválido. Use formato MM (01 a 12).";
    } elseif (!preg_match('/^\d{4}$/', $ano)) {
        $msg_erro = "Ano inválido. Use formato AAAA.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Folha_Mensal WHERE Id_Mes = ? AND Id_Ano = ?");
            $stmt->execute([$mes, $ano]);
            $existe = $stmt->fetchColumn();

            if ($existe > 0) {
                $msg_erro = "Já existe folha para $mes/$ano.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO Folha_Mensal (Id_Mes, Id_Ano) VALUES (?, ?)");
                $stmt->execute([$mes, $ano]);
                $msg_sucesso = "Folha mensal criada com sucesso.";
                $mes = $ano = "";
            }
        } catch (PDOException $e) {
            $msg_erro = "Erro ao criar folha: " . $e->getMessage();
        }
    }
} else {
    $mes = $ano = "";
}

// Buscar todas as folhas mensais para listagem
$stmt = $pdo->query("SELECT Id_Mes, Id_Ano FROM Folha_Mensal ORDER BY Id_Ano ASC, Id_Mes ASC");
$folhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Folha Mensal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script>
        function confirmarExclusao(mes, ano) {
            return confirm(`Confirma a exclusão da folha mensal ${mes}/${ano}?`);
        }
    </script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Cadastro de Folha Mensal</h4>
      <a href="index.php" class="btn btn-light btn-sm">Menu Principal</a>
    </div>
    <div class="card-body">

      <?php if ($msg_sucesso): ?>
          <div class="alert alert-success"><?= htmlspecialchars($msg_sucesso) ?></div>
      <?php endif; ?>
      <?php if ($msg_erro): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($msg_erro) ?></div>
      <?php endif; ?>

      <form method="POST" class="row g-3 mb-4">
        <div class="col-md-2">
          <label for="mes" class="form-label">Mês (MM):</label>
          <input type="text" name="mes" id="mes" class="form-control" maxlength="2" value="<?= htmlspecialchars($mes) ?>" required pattern="(0[1-9]|1[0-2])" title="Informe o mês no formato MM (01 a 12)">
        </div>
        <div class="col-md-3">
          <label for="ano" class="form-label">Ano (AAAA):</label>
          <input type="text" name="ano" id="ano" class="form-control" maxlength="4" value="<?= htmlspecialchars($ano) ?>" required pattern="\d{4}" title="Informe o ano no formato AAAA">
        </div>
        <div class="col-md-7 d-flex align-items-end gap-2">
          <button type="submit" class="btn btn-success">Salvar</button>
          </div>
      </form>

      <h5>Folhas Mensais Cadastradas</h5>
      <?php if (count($folhas) > 0): ?>
          <table class="table table-bordered table-striped">
              <thead class="table-dark">
                  <tr>
                      <th>Mês</th>
                      <th>Ano</th>
                      <th>Ações</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($folhas as $folha): ?>
                      <tr>
                          <td><?= htmlspecialchars($folha['Id_Mes']) ?></td>
                          <td><?= htmlspecialchars($folha['Id_Ano']) ?></td>
                          <td>
                            <a href="?excluir=<?= urlencode($folha['Id_Mes']) ?>&ano=<?= urlencode($folha['Id_Ano']) ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirmarExclusao('<?= htmlspecialchars($folha['Id_Mes']) ?>', '<?= htmlspecialchars($folha['Id_Ano']) ?>')"
                            >Excluir</a>
                          </td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
      <?php else: ?>
          <p>Nenhuma folha mensal cadastrada.</p>
      <?php endif; ?>

    </div>
  </div>
</div>

</body>
</html>

<?php
session_start();
require_once 'conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if (!empty($usuario) && !empty($senha)) {
        $senha_hash = hash('sha256', $senha);
        try {
            $pdo = conectar();
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE Login = ? AND Senha = ?");
            $stmt->execute([$usuario, $senha_hash]);
            $user = $stmt->fetch();

            if ($user) {
                $_SESSION['usuario'] = $usuario;
                header("Location: index.php");
                exit();
            } else {
                $erro = "Usuário ou senha inválidos.";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao conectar ao banco de dados.";
        }
    } else {
        $erro = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Folha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
    <div class="d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card shadow p-4" style="width: 350px;">
            <h4 class="text-center mb-4 text-primary">Acesso ao Sistema</h4>
            
            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <h4 class="text-center mb-4 text-primary"><i>utilizar usuário e senha = aks</i></h4>
                </div>
            </form>
        </div>
    </div>

    <!-- Rodapé fixo ao final da página -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <small>
                © <?= date('Y') ?> Sistema de Folha de Pagamento | Desenvolvido por Aldrey Kich com apoio do ChatGPT e Google Gemini, porém todos os direitos reservados.<br>
                Este projeto é de caráter educacional, a reprodução parcial ou total sem autorização está sujeita às normas de copyright.
            </small>
        </div>
    </footer>
</body>

</html>

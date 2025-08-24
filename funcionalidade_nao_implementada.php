<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Funcionalidade em Desenvolvimento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<div class="container my-5">
  <div class="card shadow">
    <div class="card-header bg-warning text-dark text-center">
      <h4 class="mb-0"><i class="bi bi-tools"></i> Funcionalidade em Desenvolvimento</h4>
    </div>
    <div class="card-body">
      <p class="fs-5 text-center text-danger">
        Esta funcionalidade ainda <strong>não está disponível</strong> nesta versão do sistema.
      </p>

      <p class="text-center">Estou trabalhando para incluir este recurso nas próximas atualizações.</p>

      <hr>

      <div class="row">
        <div class="col-md-6">
          <h5>🧾 Sobre o sistema</h5>
          <p>
            O <strong>AKS® - FOPAG</strong> é um sistema de folha de pagamento desenvolvido para fins educacionais, utilizando tecnologias como <b>PHP</b>, <b>Bootstrap</b> e <b>MySQL</b>.
          </p>
          <p>
            Ainda em construção, novas funcionalidades estão sendo implementadas gradualmente para cobrir todos os aspectos do controle de folha.
          </p>
        </div>
        <div class="col-md-6">
          <h5>📞 Contato</h5>
          <ul class="list-unstyled">
            <li><strong>Email pessoal:</strong> <a href="mailto:aldrey.kich@gmail.com">aldrey.kich@gmail.com</a></li>
            <li><strong>Email institucional:</strong> <a href="mailto:aldrey.kich@escola.pr.gov.br">aldrey.kich@escola.pr.gov.br</a></li>
            <li><strong>Telefone:</strong> <a href="tel:+5545999449138">(45) 9 9944‑9138</a></li>
          </ul>
        </div>
      </div>

      <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left-circle"></i> Menu Principal
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Msg de rodapé -->
<footer class="bg-dark text-white text-center py-3">
  <div class="container">
    <small>
      © <?= date('Y') ?> Sistema de Folha de Pagamento | Desenvolvido por Aldrey Kich com apoio do ChatGPT e Google Gemini, porem todos os direitos reservados.<br>
      Este projeto é de caráter educacional, a reprodução parcial ou total sem autorização está sujeita às normas de copyright.
    </small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
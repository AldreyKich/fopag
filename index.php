<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>AKS® - FOPAG- Sistema de Folha de Pagamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<!-- 1) flex-column  2) min-vh-100 garante 100% da altura  -->
<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AKS® - FOPAG</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <!-- Cadastro -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuCadastro" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i> Cadastro   
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Pessoas</h6></li>
            <li><a class="dropdown-item" href="pessoa/pessoa.php"><i class="bi bi-person"></i> Pessoa</a></li>
                      

            <li><hr class="dropdown-divider"></li>

            <li><h6 class="dropdown-header">Organização</h6></li>
            <li><a class="dropdown-item" href="cargo/cargo.php"><i class="bi bi-briefcase"></i> Cargo</a></li>
            <li><a class="dropdown-item" href="funcionario/funcionario.php"><i class="bi bi-people"></i> Funcionário</a></li>
            <li><a class="dropdown-item" href="dependente/dependente.php"><i class="bi bi-person"></i> Dependente</a></li>

            <li><hr class="dropdown-divider"></li>

            <li><h6 class="dropdown-header">Tabelas</h6></li>
            <li><a class="dropdown-item" href="tributos/inss.php"><i class="bi bi-percent"></i> INSS</a></li>
            <li><a class="dropdown-item" href="tributos/irrf.php"><i class="bi bi-currency-dollar"></i> IRRF</a></li>
            
          </ul>
        </li>

        <!-- Eventos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuEventos" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-flag"></i> Eventos   
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Cadastro</h6></li>
            <li><a class="dropdown-item" href="evento/evento_cadastro.php"><i class="bi bi-flag"></i> Evento</a></li>

            <li><hr class="dropdown-divider"></li>

            <li><h6 class="dropdown-header">Folha</h6></li>
            <li><a class="dropdown-item" href="folha_mensal.php"><i class="bi bi-file-earmark-text"></i> Folha Mensal</a></li>

            <li><hr class="dropdown-divider"></li>
            
            <li><h6 class="dropdown-header">Movimentos</h6></li>
            <li><a class="dropdown-item" href="evento/evento_fixo.php"><i class="bi bi-calendar-check"></i> Eventos Fixos</a></li>
            <li><a class="dropdown-item" href="evento/evento_variavel.php"><i class="bi bi-calendar-plus"></i> Eventos Variáveis</a></li>

            <li><hr class="dropdown-divider"></li>
            
            <li><h6 class="dropdown-header">Automação</h6></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-cloud-arrow-down"></i> Exportar Cadastros</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-cloud-arrow-up"></i> Importar Eventos</a></li>

          </ul>
        </li>

        <!-- Folha -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuFolha" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-database-fill-gear"></i> Processamento   
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Calcular</h6></li>
            <li><a class="dropdown-item" href="processamento_status/calcular_folhamensal.php"><i class="bi bi-calculator"></i> Folha Mensal - Normal</a></li>
            <li><a class="dropdown-item" href="processamento_matrix/calcular_folhamensal.php"><i class="bi bi-calculator"></i> Folha Mensal - Matrix</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Férias</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Décimo Terceiro</a></li>
          </ul>
        </li>

        <!-- Consultas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuFolha" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-search"></i> Consultas   
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Consultar</h6></li>
            <li><a class="dropdown-item" href="consultas/consultar_folhamensal.php"><i class="bi bi-calculator"></i> Folha Mensal</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Férias</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Décimo Terceiro</a></li>
          </ul>
        </li>

        <!-- Consultas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuFolha" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-clipboard-data-fill"></i> Relatórios   
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Relatórios</h6></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Folha Mensal</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Férias</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-calculator"></i> Décimo Terceiro</a></li>
          </ul>
        </li>

        <!-- Sair -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuFolha" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-diagram-2"></i> Administração
          </a>
          <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Acessos</h6></li>
            <li><a class="dropdown-item" href="usuario/usuario.php"><i class="bi bi-person-badge"></i> Usuários</a></li>
            <li><a class="dropdown-item" href="funcionalidade_nao_implementada.php"><i class="bi bi-kanban"></i> Permissões</a></li>
            
            <li><hr class="dropdown-divider"></li>     
          
            <li><h6 class="dropdown-header">Sistema</h6></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- Msg de Boas Vindas -->
<div class="flex-grow-1">
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Bem-vindo ao AKS® - FOPAG - Folha de Pagamento</h4>
      </div>
      <div class="card-body">
        <p>Este sistema está em desenvolvimento como parte de um projeto de estudo prático em <b>PHP</b>, <b>HTML</b> integrado ao banco de dados <b>MySQL</b>.</p>
        <p>Utilize o menu acima para acessar os módulos disponíveis. Funcionalidades ainda não implementadas irão redirecionar você de volta à tela inicial.</p>
        <p>Seu feedback é muito importante! Envie dúvidas, sugestões ou contribuições para aprimorar este projeto:</p>
        <ul>
          <li><strong>Email pessoal:</strong> <a href="mailto:aldrey.kich@gmail.com">aldrey.kich@gmail.com</a></li>
          <li><strong>Email institucional:</strong> <a href="mailto:aldrey.kich@escola.pr.gov.br">aldrey.kich@escola.pr.gov.br</a></li>
          <li><strong>Telefone:</strong> <a href="tel:+5545999449138">(45) 9 9944‑9138</a></li>
        </ul>
        <p class="text-muted"><b>Obrigado por visitar e colaborar com este projeto de aprendizado.</b></p>
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
<?php
require_once '../includes/settings/config.php';
require_once '../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=BASE_URL?>assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Fira+Code:wght@300..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Governança Corporativa</title>
</head>
<body>
  <?php include '../includes/header.php'?>
  <main class="gov-page">
    <section class="gov-hero-section">
        <div class="gov-hero-overlay"></div>
        
        <div class="gov-brand-curves"></div>

        <div class="gov-hero-container">
            <h1 class="gov-title">Governança<br>Corporativa</h1>
        </div>
    </section>
    <section class="integridade-section">
    <div class="integridade-container">
        
        <div class="integridade-header">
            <h2>Compromisso com a Integridade</h2>
            <p>Nossas políticas estabelecem as diretrizes que norteiam as decisões, relacionamentos e condutas profissionais da Ondacom,</p>
        </div>

        <div class="integridade-grid">
    
    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-eye-slash"></i> </div>
        <h3>Política de Privacidade</h3>
        <a href="<?=BASE_URL?>assets/docs/politica-de-privacidade.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-lock"></i> </div>
        <h3>Governança e Proteção de Dados</h3>
        <a href="<?=BASE_URL?>assets/docs/governanca-e-protecao-de-dados.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-shield-alt"></i> </div>
        <h3>Segurança da Informação</h3>
        <a href="<?=BASE_URL?>assets/docs/seguranca-da-informacao.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-balance-scale"></i> </div>
        <h3>Código de Ética e Conduta</h3>
        <a href="<?=BASE_URL?>assets/docs/codigo-de-etica.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-hand-holding-usd"></i> </div>
        <h3>Combate à Corrupção</h3>
        <a href="<?=BASE_URL?>assets/docs/combate-a-corrupcao.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-hand-paper"></i> </div>
        <h3>Combate ao Assédio</h3>
        <a href="<?=BASE_URL?>assets/docs/combate-ao-assedio.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

    <div class="politica-card">
        <div class="politica-icon">
            <i class="fas fa-leaf"></i> </div>
        <h3>Política de Sustentabilidade</h3>
        <a href="<?=BASE_URL?>assets/docs/politica-de-sustentabilidade.pdf" target="_blank" class="btn-acessar-pdf">ACESSAR</a>
    </div>

</div>
</section>
  <?php include '../includes/footer.php'?>
</main>
</body>
</html>
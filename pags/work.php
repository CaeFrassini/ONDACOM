<?php
require_once '../includes/settings/config.php';
require_once '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=BASE_URL?>assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Fira+Code:wght@300..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Trabalhe conosco</title>
</head>
<body>
  <?php include '../includes/header.php'?>
<main class="work-page">
    <section class="work-hero-section">
        <div class="work-hero-overlay"></div>
        
        <div class="work-brand-curves"></div>

        <div class="work-hero-container">
            <h1 class="work-title">Trabalhe<br>Conosco</h1>
        </div>
    </section>

    <section class="work-content-section">
        <div class="container">
            </div>
    </section>
</main>

<section class="work-form-section">
    <div class="work-form-container">
        
        <div class="work-form-textos">
            <p class="text-destaque">Na Ondacom, acreditamos que as pessoas são fundamentais para o nosso crescimento e para a construção de soluções que conectam o Brasil.</p>
            
            <p>Buscamos profissionais comprometidos, que valorizem a inovação, a colaboração e o desenvolvimento contínuo.</p>
            
            <div class="text-carreira">
                <h3>Está começando sua carreira?</h3>
                <p>Temos oportunidades que desenvolvem o seu potencial na prática!</p>
            </div>
        </div>

        <div class="work-form-card-wrapper">
            <div class="work-curriculo-card">
                <h2>Envie o seu currículo!</h2>
                
                <form action="enviar-curriculo.php" method="POST" enctype="multipart/form-data" class="form-curriculo">
                    <div class="work-input-group">
                        <input type="text" name="nome" placeholder="Nome e Sobrenome" required>
                    </div>
                    <div class="work-input-group">
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="work-input-group">
                        <input type="text" name="cargo" placeholder="Cargo Desejado" required>
                    </div>
                    <div class="work-input-group">
                        <input type="text" name="localidade" placeholder="Localidade de interesse (Município/UF)" required>
                    </div>
                    
                    <div class="work-file-group">
                        <label for="curriculo-file" class="btn-upload">
                            <i class="fa-solid fa-paperclip"></i> Anexar currículo (PDF, DOC ou DOCX)
                        </label>
                        <input type="file" id="curriculo-file" name="curriculo" accept=".pdf,.doc,.docx" required>
                        <span id="file-name-display"></span>
                    </div>
                    
                    <button type="submit" class="btn-enviar-work">ENVIAR</button>
                </form>
            </div>
        </div>

    </div>
</section>
<section class="diversidade-section">
    <div class="diversidade-container">
        
        <div class="diversidade-header">
            <h2>Diversidade, respeito e inclusão</h2>
            <p>Na Ondacom, não toleramos qualquer forma de discriminação, assédio, intimidação ou desrespeito.</p>
        </div>

        <div class="diversidade-grid">
            <div class="diversidade-col">
                <p>Prezamos por um ambiente de trabalho pautado pela <strong>ética, pelo respeito e pela valorização das diferenças.</strong>
                <br>Acreditamos que a diversidade fortalece as equipes, amplia perspectivas e contribui para resultados mais inovadores e sustentáveis.</p>
            </div>
            
            <div class="diversidade-col">
                <p>Temos o compromisso de garantir que todas as pessoas sejam tratadas com <strong>dignidade, respeito e igualdade de oportunidades</strong>, independentemente de gênero, raça, cor, religião, orientação sexual, idade, deficiência ou qualquer outra característica individual.</p>
            </div>
        </div>

        <div class="diversidade-ilustracao">
            <img src="<?=BASE_URL?>assets/img/diversidade-Ondacom.png" alt="Ilustração de inclusão e diversidade de mãos dadas">
        </div>
    </div>
</section>
<?php include '../includes/footer.php'?>
<script src="<?=BASE_URL?>assets/js/script.js"></script>
</body>
</html>
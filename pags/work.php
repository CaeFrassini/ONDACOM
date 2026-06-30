<?php
require_once '../includes/settings/config.php'; // Ajuste o caminho se necessário (ex: '../includes...')
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensagem_status = $_GET['status'] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Captura e limpa os campos de texto
    $nome      = trim($_POST['nome'] ?? '');
    $email     = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $cargo     = trim($_POST['cargo'] ?? '');
    $municipio = trim($_POST['municipio'] ?? '');
    $uf        = trim($_POST['uf'] ?? '');

    // 2. Validação básica dos campos de texto e do arquivo
    if (empty($nome) || empty($email) || empty($cargo) || empty($municipio) || empty($uf) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem_status = "Erro_Campos";
    } 
    // Verifica se o arquivo do currículo foi enviado sem erros
    elseif (!isset($_FILES['curriculo']) || $_FILES['curriculo']['error'] !== UPLOAD_ERR_OK) {
        $mensagem_status = "Erro_Arquivo";
    } 
    else {
        $mail = new PHPMailer(true);

        try {
            // 3. Configurações de Servidor (idênticas ao seu outro form)
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST']; 
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // 4. Remetente e Destinatário
            $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($_ENV['MAIL_FROM']); // Envia para o e-mail da própria Ondacom
            $mail->addReplyTo($email, $nome);     // Se responder o e-mail, vai para o candidato

            // 5. TRATAMENTO DO ANEXO (Pega o arquivo temporário do PHP e anexa com o nome original)
            $arquivo_caminho = $_FILES['curriculo']['tmp_name'];
            $arquivo_nome    = $_FILES['curriculo']['name'];
            $mail->addAttachment($arquivo_caminho, $arquivo_nome);

            // 6. Conteúdo do E-mail
            $mail->isHTML(true);
            $mail->Subject = "Novo Currículo Recebido: $cargo - $nome";
            
            $mail->Body = "
            <h3>Novo candidato pelo Trabalhe Conosco:</h3>
            <p><b>Nome:</b> $nome</p>
            <p><b>Email:</b> $email</p>
            <p><b>Cargo Desejado:</b> $cargo</p>
            <p><b>Localidade de Interesse:</b> $municipio - $uf</p>
            <p><i>O currículo foi anexado com sucesso a este e-mail.</i></p>
            ";

            $mail->AltBody = "Novo currículo recebido de $nome.\nCargo: $cargo\nLocalidade: $municipio-$uf\nEmail: $email";

            $mail->send();
            $mensagem_status = "Sucesso";
        } catch (Exception $e) {
            $mensagem_status = "Erro";
        }
    }
    
    // Redireciona de volta para a página onde está o formulário (mude para index.php se o form estiver na home)
    header("Location: work.php?status=$mensagem_status#curriculo");
    exit;
}
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
    <div class="work-curriculo-card" id="curriculo">
        <h2>Envie o seu currículo!</h2>
        
        <form action="work.php" method="POST" enctype="multipart/form-data" class="form-curriculo">
            <div class="work-input-group">
                <input type="text" name="nome" placeholder="Nome e Sobrenome" required>
            </div>
            <div class="work-input-group">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="work-input-group">
                <input type="text" name="cargo" placeholder="Cargo Desejado" required>
            </div>
            
            <div class="work-input-group-row" style="display: flex; gap: 10px;">
                <div class="work-input-group" style="flex: 3;">
                    <input type="text" name="municipio" placeholder="Município de interesse" required>
                </div>
                <div class="work-input-group" style="flex: 1;">
                    <select name="uf" required style="width: 100%; height: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; color: #666;">
                        <option value="" disabled selected>UF</option>
                        <option value="AC">AC</option>
                        <option value="AM">AM</option>
                        <option value="AP">AP</option>
                        <option value="BA">BA</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MG">MG</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="PR">PR</option>
                        <option value="RJ">RJ</option>
                        <option value="RO">RO</option>
                        <option value="RS">RS</option>
                        <option value="SC">SC</option>
                        <option value="SE">SE</option>
                        <option value="SP">SP</option>
                        <option value="TO">TO</option>
                    </select>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const status = "<?= $_GET['status'] ?? '' ?>";
if (status === "Sucesso") {
    Swal.fire({
        icon: "success",
        title: "Currículo enviado!",
        text: "Seu currículo foi recebido com sucesso. Boa sorte!",
        confirmButtonText: "Fechar",
        confirmButtonColor: "#0d6efd"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "work.php";
        }
    });
}
if (status === "Erro") {
    Swal.fire({
        icon: "error",
        title: "Erro no envio",
        text: "Não foi possível enviar seu currículo neste momento.",
        confirmButtonText: "Tentar novamente",
        confirmButtonColor: "#dc3545"
    }).then((result) => {
        if (result.isConfirmed) {
           window.location.href = "work.php";
        }
    });
}
if (status === "Erro_Campos") {
    Swal.fire({
        icon: "warning",
        title: "Campos incompletos",
        text: "Por favor, preencha todos os dados corretamente.",
        confirmButtonText: "OK",
        confirmButtonColor: "#ffc107"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "work.php";
        }
    });
}
if (status === "Erro_Arquivo") {
    Swal.fire({
        icon: "error",
        title: "Falha no arquivo",
        text: "Selecione um arquivo de currículo válido (PDF, DOC ou DOCX).",
        confirmButtonText: "Entendido",
        confirmButtonColor: "#dc3545"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "work.php";
        }
    });
}
</script>
</body>
</html>
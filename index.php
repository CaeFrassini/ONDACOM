<?php
require_once 'includes/settings/config.php';
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensagem_status = $_GET['status'] ?? "";
$mensagem_texto = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $nome = trim($_POST['nome'] ?? '');
    $email_user = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    
    if(empty($nome) || empty($email_user) || empty($assunto) || empty($mensagem) || !filter_var($email_user, FILTER_VALIDATE_EMAIL)){
        $mensagem_status = "Erro_Campos";
    } else{
        $mail = new PHPMailer(true);

        try{
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($_ENV['MAIL_FROM']);

            if(filter_var($email_user, FILTER_VALIDATE_EMAIL)){
                $mail->addReplyto($email_user, $nome);
            }

            $mail->isHTML(true);
            $mail->Subject = "Novo contato: $assunto";
            $mail->Body="
            <h3>Nova Mensagem do Site Ondacom:</h3>
            <p><b>Nome:</b> $nome</p>
            <p><b>Email:</b> $email_user</p>
            <p><b>Mensagem:</b><br>" . nl2br(htmlspecialchars($mensagem)) . "</p>
            ";

            $mail->AltBody = "Nome: $nome\nEmail: $email_user\nMensagem: $mensagem";

            $mail->send();
            $mensagem_status = "Sucesso";
            $mensagem_texto = "Sua mensagem foi enviada com sucesso.";
        } catch (Exception $e){
            $mensagem_status = "Erro";
            $mensagem_texto = "Não foi possivel enviar sua mensagem. Tente novamente.";
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?status=$mensagem_status");
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
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <title>Ondacom</title>
</head>
<body>
  <?php include 'includes/header.php'?> 
  
  <main class="hero-section">
    <div class="hero-content">
      <h1>Criando<br>Conectividade<br>com pessoas e<br>negócios</h1>
      <button class="btn-saiba-mais"><a href="#section1">SAIBA MAIS</a></button>
    </div>
  </main>

  <section class="numeros-ondacom" id="section1">
    <div class="numeros-titulo">
        <h2>
            Capacidade operacional para entregar soluções em
            telecomunicações com eficiência, escala e confiabilidade.
        </h2>
    </div>
    <div class="numeros-grid">
        <div class="numero-item">
            <span class="numero">+15</span>
            <p>anos de<br>experiência</p>
        </div>
        <div class="numero-item">
            <span class="numero">+90</span>
            <p>veículos<br>na frota</p>
        </div>
        <div class="numero-item">
            <span class="numero">+30</span>
            <p>equipes<br>em campo</p>
        </div>
    </div>
  </section>

  <section class="quem-somos-section" id="quemsomos">
    <div class="quem-somos-header">
        <h2>
            Referência em telecomunicações, a Ondacom alia
            experiência a uma cultura voltada a resultados.
        </h2>
    </div>
    <div class="quem-somos-content">
        <h3>
            A Ondacom nasceu com o propósito de contribuir para a expansão da conectividade no Brasil, apoiando o desenvolvimento da infraestrutura de telecomunicações que conecta pessoas, negócios e oportunidades.
        </h3>
        <div class="texto-e-imagem">
            <div class="textos">
                <p>
                    Ao longo de seus 15 anos, ampliou sua atuação de forma estratégica em diferentes regiões do país, fortaleceu sua capacidade operacional e consolidou sua presença no setor.
                </p>
                <p>
                    Especializada na implantação, manutenção e suporte técnico em telecomunicações, a Ondacom tem o compromisso de atuar com foco em qualidade, eficiência e segurança em cada projeto, firmando relações sólidas com grandes players do mercado.
                </p>
            </div>
            <div class="quem-somos-imagem">
                <img src="assets/img/tecnico.png" alt="Equipe Ondacom">
            </div>
        </div>
    </div>
    <div class="cards-valores">
        <div class="card-info">
            <h3>MISSÃO</h3>
            <p>
                Oferecer serviços confiáveis e inovadores, conectando pessoas e negócios com excelência operacional e foco na satisfação do cliente.
            </p>
        </div>
        <div class="card-info">
            <h3>VISÃO</h3>
            <p>
                Ser reconhecida pela excelência na prestação de serviços em telecomunicações, participando ativamente da expansão da conectividade no Brasil e no mundo.

            </p>
        </div>
        <div class="card-info">
            <h3>VALORES</h3>
            <p>
                Confiabilidade<br>
                Integridade<br>
                Excelência operacional<br>
                Compromisso com o cliente
            </p>
        </div>
    </div>
  </section>

  <section class="solucoes-section" id="solucoes">
    <div class="solucoes-header">
        <h2>Soluções de Telecomunicações</h2>
        <p>Atuamos de ponta a ponta em projetos de telecomunicações, oferecendo soluções completas alinhadas às necessidades de cada operação.</p>
    </div>

    <div class="solucoes-grid">
        <div class="solucao-card">
            <h3>PROJETOS E IMPLANTAÇÕES</h3>
            <p>Desenvolvimento e expansão de infraestrutura de fibra óptica, redes GPON e backbone para operadoras, empresas e projetos estratégicos.</p>
        </div>

        <div class="solucao-card">
            <h3>REDE DE FIBRA ÓPTICA (GPON)</h3>
            <p>Operação, monitoramento e manutenção de redes de fibra óptica com foco em desempenho, estabilidade e continuidade operacional.</p>
        </div>

        <div class="solucao-card">
            <h3>REDE MÓVEL</h3>
            <p>Manutenção de sites, centrais e infraestrutura de redes móveis, incluindo suporte elétrico, climatização e operação técnica.</p>
        </div>

        <div class="solucao-card">
            <h3>REDE METÁLICA</h3>
            <p>Monitoramento e manutenção de redes metálicas para atendimento técnico, estabilidade operacional e redução de falhas.</p>
        </div>

        <div class="solucao-card">
            <h3>BACKBONE</h3>
            <p>Atuação em redes de transporte nacional e regional, garantindo conectividade, manutenção preventiva e expansão de infraestrutura.</p>
        </div>

        <div class="solucao-card">
            <h3>CASA CLIENTE</h3>
            <p>Instalação e suporte técnico de fibra óptica no cliente final, com agilidade, qualidade e excelência no atendimento.</p>
        </div>
    </div>
  </section>

  <section class="presenca-section" id="presenca">
    <div class="presenca-container">
        <div class="presenca-conteudo">
            <h2>Presença Estratégica</h2>
            <p>A capilaridade nacional da Ondacom garante agilidade no atendimento das demandas diárias e suporte eficiente às operações.</p>
            
            <div class="presenca-metricas">
                <div class="metrica-item">
                    <span class="metrica-numero">+14</span>
                    <span class="metrica-texto">estados</span>
                </div>
                <div class="metrica-item">
                    <span class="metrica-numero">+25</span>
                    <span class="metrica-texto">bases</span>
                </div>
            </div>
        </div>

        <div class="presenca-mapa-wrapper">
            <div id="map"></div>
        </div>
    </div>
  </section>

  <section class="parcerias-section" id="parceiros">
    <div class="parcerias-container">
        <div class="parcerias-header">
            <h2>Parcerias que ampliam a conectividade</h2>
            <p>A Ondacom conta com a confiança de grandes operadoras, provedores de infraestrutura e conectividade digital, participando de projetos de Telecom com soluções inteligentes e inovadoras.</p>
        </div>
        
        <div class="parcerias-logos">
            <div class="logo-item">
                <img src="assets/img/vivo.png" alt="Vivo">
            </div>
            <div class="logo-item">
                <img src="assets/img/tim.jpg" alt="logo-tim">
            </div>
            <div class="logo-item">
                <img src="assets/img/ligga.jpg" alt="logo-ligga">
            </div>
            <div class="logo-item">
                <img src="assets/img/ihs-logo.png" alt="logo-I-Systems">
            </div>
            <div class="logo-item">
                <img src="assets/img/vtal.png" alt="logo-V.tal">
            </div>
        </div>
    </div>
</section>
<section class="infra-section" id="infra-section">
    <div class="infra-container">
        <div class="infra-header">
            <h2>A infraestrutura por trás de cada conexão</h2>
            <p>Do processamento de dados à entrega da conectividade, cada etapa da rede desempenha um papel essencial para garantir desempenho e disponibilidade.</p>
        </div>

        <div class="infra-grid">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front card-escuro">
                        <div class="card-content">
                            <img src="assets/img/data-center_icone.png" alt="Data Centers" class="infra-icon">
                            <h3>Data Centers</h3>
                            <button class="btn-flip"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div class="flip-card-back back-escuro">
                        <div class="card-content">
                            <p>Infraestrutura responsável pelo armazenamento, processamento e distribuição dos dados que suportam toda a operação da rede.</p>
                            <button class="btn-flip-back"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front card-escuro">
                        <div class="card-content">
                            <img src="assets/img/backbone_icone.png" alt="Backbone" class="infra-icon">
                            <h3>Backbone</h3>
                            <button class="btn-flip"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div class="flip-card-back back-escuro">
                        <div class="card-content">
                            <p>Rede de alta capacidade que transporta grandes volumes de dados entre os Data Centers e os demais pontos da infraestrutura, formando a espinha dorsal das telecomunicações.</p>
                            <button class="btn-flip-back"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front card-escuro">
                        <div class="card-content">
                            <img src="assets/img/rede-central_icone.png" alt="Rede Central" class="infra-icon">
                            <h3>Rede Central</h3>
                            <button class="btn-flip"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div class="flip-card-back back-escuro">
                        <div class="card-content">
                            <p>Camada que concentra e distribui as conexões, direcionando o tráfego de dados para diferentes regiões, serviços e tipos de acesso.</p>
                            <button class="btn-flip-back"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front card-claro">
                        <div class="card-content">
                            <img src="assets/img/rede-movel_icone.png" alt="Rede Móvel" class="infra-icon">
                            <h3>Rede Móvel</h3>
                            <button class="btn-flip"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div class="flip-card-back back-claro">
                        <div class="card-content">
                            <p>Infraestrutura dedicada à transmissão de dados e serviços de comunicação sem fio, conectando usuários por meio de redes móveis e tecnologias de mobilidade.</p>
                            <button class="btn-flip-back"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front card-claro">
                        <div class="card-content">
                            <img src="assets/img/conectividade-icon.png" alt="Conectividade" class="infra-icon">
                            <h3>Conectividade</h3>
                            <button class="btn-flip"><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </div>
                    <div class="flip-card-back back-claro">
                        <div class="card-content">
                            <p>Ponto final da rede onde a conectividade é entregue a clientes residenciais e corporativos por meio da infraestrutura instalada no local de acesso.</p>
                            <button class="btn-flip-back"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="contato-section" id="contato">
    <div class="contato-container">
        <div class="contato-conteudo">
            <h2>Grandes conexões geram grandes oportunidades</h2>
            <p>A Ondacom está pronta para colaborar com seus projetos de telecomunicações.</p>
            <div class="contato-imagem-wrapper">
                <img src="<?=BASE_URL?>assets/img/fale-com-ondacom.png" alt="Pessoa da Ondacom apontando para o celular" class="contato-personagem">
            </div>
        </div>

        <div class="contato-form-wrapper">
            <div class="contato-card">
                <h3>Fale Conosco</h3>
                <form action="#contato" method="POST" class="form-ondacom">
                    <div class="input-group">
                        <input type="text" name="nome" placeholder="Nome e Sobrenome" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="assunto" placeholder="Assunto" required>
                    </div>
                    <div class="input-group">
                        <textarea name="mensagem" placeholder="Digite sua mensagem" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-enviar">ENVIAR</button>
                </form>
            </div>
        </div>
    </div>
</section>
 <?php include 'includes/footer.php'?> 
 <script src="<?= BASE_URL ?>/assets/js/script.js"></script>
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
            window.location.href = "#contato";
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
            window.location.href = "#contato";
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
            window.location.href = "#contato";
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
            window.location.href = "#contato";
        }
    });
}
</script>
</body>
</html>
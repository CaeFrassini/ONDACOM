document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById('menuToggle');
    const header = document.getElementById('header');

    if (menuToggle && header) {
        menuToggle.addEventListener('click', () => {
            header.classList.toggle('active');
            const icon = menuToggle.querySelector('i');

            if (header.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    var limitesBrasil = [
        [-45.5, -90.0],
        [10.5, -31.0]
    ];

    var map = L.map('map', {
        center: [-14.235, -51.925],
        zoom: 4,
        minZoom: 2,
        attributionControl: false
    });

    L.tileLayer(`https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png=?${token}`, {
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    var pulsingIcon = L.divIcon({
        className: 'leaflet-pulsing-icon',
        iconSize: [12, 12],
        iconAnchor: [6, 6],
        html: '<div class="pulse-core"></div><div class="pulse-ring"></div>'
    });

    const basesOndacom = [
        { nome: "Base São Paulo", endereco: "Rua Sara de Souza, 174 - Água Branca - São Paulo/SP", lat: -23.5163153, lng: -46.6883257, info: "Logística e Campo" },
        { nome: "Base Cajamar - SP", endereco: "Avenida Bento da Silva Bueno, 806 - Loja 6 - Paraíso (Polvilho) - Cajamar/SP", lat: -23.4156705, lng: -46.8216952, info: "Unidade Operacional" },
        { nome: "Base Barra Funda - SP", endereco: "Rua Rubens Meireles, 7 - Escritório de Serviço - Várzea da Barra Funda - São Paulo/SP", lat: -23.5215635, lng: -46.6660438, info: "Escritório de Serviço" },
        { nome: "Base São José do Rio Preto - SP", endereco: "Rua Doutor Waldemar Buchala, 250 - Distrito Industrial Waldemar de Oliveira Verdi - São José do Rio Preto/SP", lat: -20.8203118, lng: -49.4181871, info: "Unidade Operacional" },
        { nome: "Base Campinas - SP", endereco: "Região de Campinas (Entroncamento Anhanguera)", lat: -22.9130969, lng: -47.0999924, info: "Unidade Operacional" },
        { nome: "Base São José dos Campos - SP", endereco: "Região Industrial (São José dos Campos)", lat: -23.2303365, lng: -45.9063457, info: "Logística e Campo" },
        { nome: "Base Uberlândia - MG", endereco: "Avenida Sacadura Cabral, 710 - Aclimação - Uberlândia/MG", lat: -18.8851368, lng: -48.2306763, info: "Regional Minas" },
        { nome: "Base Betim - MG", endereco: "Rua Vereador Jurandino Andrade, 725 - Distrito Industrial Jardim Piemont Norte - Betim/MG", lat: -19.9519981, lng: -44.0692242, info: "Regional Minas" },
        { nome: "Base Montes Claros - MG", endereco: "Rua Rubi, 257 - Edgar Pereira - Montes Claros/MG", lat: -16.7135717, lng: -43.8627463, info: "Regional Minas" },
        { nome: "Base Manaus - AM", endereco: "Rua Doutor Brestislau de Castro, 55 - Coroado - Manaus/AM", lat: -3.0954243, lng: -59.9532957, info: "Unidade Norte" },
        { nome: "Base Simões Filho - BA", endereco: "Rua da Independência, 263 - CIA I - Simões Filho/BA", lat: -12.8125755, lng: -38.3936213, info: "Operações Nordeste" },
        { nome: "Base Salvador - BA", endereco: "Rua Álvaro Gomes de Castro, 525 - Porto Seco - Pirajá - Salvador/BA", lat: -12.9090489, lng: -38.4527082, info: "Operações Nordeste" },
        { nome: "Base Joinville - SC", endereco: "Rua Pedro Castro Breis, 164 - Floresta - Joinville/SC", lat: -26.3430790, lng: -48.8553492, info: "Unidade Sul" },
        { nome: "Base Blumenau - SC", endereco: "Rua Nova Friburgo, 154 - Centro - Blumenau/SC", lat: -26.9170767, lng: -49.0762086, info: "Unidade Sul" },
        { nome: "Base São José - SC", endereco: "Travessa Nelson Miguel da Silva, 12 - Serraria - São José/SC", lat: -27.5420835, lng: -48.6309284, info: "Unidade Sul" },
        { nome: "Base Porto Alegre - RS", endereco: "Avenida Sertório, 5950 - Depósito 12 - São Sebastião - Porto Alegre/RS", lat: -29.9952834, lng: -51.1453541, info: "Regional Sul" },
        { nome: "Base Santa Maria - RS", endereco: "Rua Três de Outubro, 13 - Nonoai - Santa Maria/RS", lat: -29.7041223, lng: -53.8151616, info: "Unidade Sul" },
        { nome: "Base Passo Fundo - RS", endereco: "Rua Otávio Rocha, 1586 - Petrópolis - Passo Fundo/RS", lat: -28.2441790, lng: -52.3771924, info: "Unidade Sul" },
        { nome: "Base Pelotas - RS", endereco: "Avenida Cidade de Lisboa, 1259 - Fragata - Pelotas/RS", lat: -31.7412558, lng: -52.3995291, info: "Unidade Sul" },
        { nome: "Base Santa Cruz do Sul - RS", endereco: "Rua Borges de Medeiros, 707 - Centro - Santa Cruz do Sul/RS", lat: -29.7143881, lng: -52.4301349, info: "Unidade Sul" },
        { nome: "Base Tramandaí - RS", endereco: "Rua Otávio Rodolfo dos Santos, 481 - Indianópolis - Tramandaí/RS", lat: -30.0076979, lng: -50.1717599, info: "Unidade Sul" },
        { nome: "Base Curitiba - PR", endereco: "Rua Inajá, 698 - Emiliano Perneta - Pinhais/PR", lat: -25.4234313, lng: -49.1880956, info: "Operações Sul" },
        { nome: "Base Cascavel - PR", endereco: "Rua Maria Dolores da Motta, 534 - Cancelli - Cascavel/PR", lat: -24.9386015, lng: -53.4693460, info: "Operações Sul" },
        { nome: "Base Maringá - PR", endereco: "Avenida Doutor Luiz Teixeira Mendes, 3108 - Conjunto Residencial Itamaraty - Maringá/PR", lat: -23.4311138, lng: -51.9712726, info: "Operações Sul" },
        { nome: "Base Ponta Grossa - PR", endereco: "Rua Thomaz Gonzaga, 8 - Nova Rússia - Ponta Grossa/PR", lat: -25.0741361, lng: -50.1821261, info: "Operações Sul" },
        { nome: "Base Macapá - AP", endereco: "Rua Doutor Alberto Lima, 271 - Congós - Macapá/AP", lat: 0.0090511, lng: -51.0897964, info: "Unidade Norte" },
        { nome: "Base São Luís - MA", endereco: "Rua Paulo Frontin, 368 - Fátima - São Luís/MA", lat: -2.5442169, lng: -44.2833508, info: "Unidade Maranhão" },
        { nome: "Base Ananindeua - PA", endereco: "Alameda Moça Bonita, 5 - Guanabara - Ananindeua/PA", lat: -1.4001334, lng: -48.4244610, info: "Unidade Norte" },
        { nome: "Base Santarém - PA", endereco: "Rua Santa Cruz, 2330 - Fátima - Santarém/PA", lat: -2.4206863, lng: -54.7312799, info: "Unidade Norte" },
        { nome: "Base Serra - ES", endereco: "Rua Castelo, 163 - Jardim Limoeiro - Serra/ES", lat: -20.2105894, lng: -40.2638425, info: "Unidade Sudeste" },
        { nome: "Base Brasília - DF", endereco: "SCIA Quadra 14 Conjunto 4 - Lote 10 - Zona Industrial (Guará) - Brasília/DF", lat: -15.7836244, lng: -47.9855925, info: "Regional Centro-Oeste" },
        { nome: "Base Aparecida de Goiânia - GO", endereco: "Via Acesso 8 - Quadra B Lote 05 - Chácaras Marivânia - Aparecida de Goiânia/GO", lat: -16.7888543, lng: -49.2350121, info: "Regional Centro-Oeste" },
        { nome: "Base Rio Verde - GO", endereco: "Rua 11 - Residencial Recanto do Bosque - Rio Verde/GO", lat: -17.8162511, lng: -50.9344945, info: "Regional Centro-Oeste" },
        { nome: "Base Caldas Novas - GO", endereco: "Avenida Marginal Leste - Setor Bela Vista - Caldas Novas/GO", lat: -17.7305744, lng: -48.5975207, info: "Regional Centro-Oeste" },
        { nome: "Base Campo Grande - MS", endereco: "Avenida Tiradentes, 445 - Vila Taveirópolis - Campo Grande/MS", lat: -20.4702141, lng: -54.6388397, info: "Unidade Mato Grosso do Sul" },
        { nome: "Base Três Lagoas - MS", endereco: "Rua Waldemar Marques de Queiroz, 232 - SETSUL - Três Lagoas/MS", lat: -20.8012355, lng: -51.6672642, info: "Unidade Mato Grosso do Sul" },
        { nome: "Base Dourados - MS", endereco: "Rua Fernando Ferrari, 1050 - Vila Industrial - Dourados/MS", lat: -22.2309888, lng: -54.7748420, info: "Unidade Mato Grosso do Sul" },
        { nome: "Base Rondonópolis - MT", endereco: "Alameda das Papoulas, 109 - Vila Adriana - Rondonópolis/MT", lat: -16.4497229, lng: -54.6567990, info: "Regional Centro-Oeste" },
        { nome: "Base Lucas do Rio Verde - MT", endereco: "Avenida Porto Alegre, 698 - Industrial - Lucas do Rio Verde/MT", lat: -13.0774192, lng: -55.9107208, info: "Regional Centro-Oeste" },
        { nome: "Base Cuiabá - MT", endereco: "Rua Três, 4639 - Altos do Coxipó - Cuiabá/MT", lat: -15.6319567, lng: -56.0230207, info: "Regional Centro-Oeste" },
        { nome: "Base Palmas - TO", endereco: "Quadra ASR SE 95 Alameda 9, 3 - Plano Diretor Sul - Palmas/TO", lat: -10.2754725, lng: -48.3213705, info: "Unidade Norte" },
        { nome: "Base Porto Velho - RO", endereco: "Rua Cascavel, 3100 - Lagoinha - Porto Velho/RO", lat: -8.7617325, lng: -63.8557684, info: "Unidade Norte" },
        { nome: "Base Rio Branco - AC", endereco: "Rua Camburiú, 398 - Village Wilde Maciel - Rio Branco/AC", lat: -9.9574838, lng: -67.8193381, info: "Unidade Norte" }
    ];

    basesOndacom.forEach(base => {
        L.marker([base.lat, base.lng], { icon: pulsingIcon })
            .addTo(map)
            .bindPopup(`
            <div style="font-family: 'Poppins', sans-serif; color: #333;">
                <strong style="color: #00a6ff; font-size: 1.1rem;">Ondacom</strong><br>
                <strong style="font-size: 0.95rem;">${base.nome}</strong><br>
                <span style="display:block; margin: 4px 0; color: #666; font-size: 0.85rem;">${base.endereco}</span>
                <i style="color: #1751bc; font-size: 0.85rem;">${base.info}</i>
            </div>
        `);
    });

    const flipButtons = document.querySelectorAll('.btn-flip, .btn-flip-back');

    flipButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const card = this.closest('.flip-card');

            if (card) {
                card.classList.toggle('flipped');
            }
        });
    });
});
document.getElementById('curriculo-file').addEventListener('change', function () {
    var fileName = this.files[0] ? this.files[0].name : '';
    document.getElementById('file-name-display').textContent = fileName ? 'Arquivo selecionado: ' + fileName : '';
});

document.addEventListener("DOMContentLoaded", function() {
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
    var map = L.map('map').setView([-14.235, -51.925], 4);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
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
        { nome: "Base São Paulo", endereco: "Rua Sara de Souza, 174 - Água Branca", lat: -23.5164, lng: -46.6882, info: "Logística e Campo" },
        { nome: "Base Cajamar - SP", endereco: "Av. Bento da Silva Bueno, 806 - Polvilho", lat: -23.4117, lng: -46.8407, info: "Unidade Operacional" },
        { nome: "Base Campinas - SP", endereco: "Região de Campinas (Entroncamento Anhanguera)", lat: -22.9056, lng: -47.0608, info: "Unidade Operacional" },
        { nome: "Base São José dos Campos - SP", endereco: "Região Industrial (SJC)", lat: -23.1791, lng: -45.8872, info: "Logística e Campo" },
        { nome: "Base Belo Horizonte - MG", endereco: "Região de Betim/Contagem (Hub Logístico)", lat: -19.9667, lng: -44.0333, info: "Regional Minas" },
        { nome: "Base Curitiba - PR", endereco: "Av. Sen. Salgado Filho, 5914 - Uberaba", lat: -25.4965, lng: -49.2155, info: "Operações Sul" },
        { nome: "Base Porto Alegre - RS", endereco: "Av. Sertório, 5950 - Sarandi", lat: -29.9954, lng: -51.1517, info: "Regional Sul" },
        { nome: "Base Salvador - BA", endereco: "Rua da Independência, 263 - Simões Filho (Grande SSA)", lat: -12.7931, lng: -38.3972, info: "Operações Nordeste" },
        { nome: "Base Manaus - AM", endereco: "Região Industrial (Distrito Industrial)", lat: -3.1325, lng: -59.9822, info: "Unidade Norte" },
        { nome: "Base Brasília - DF", endereco: "Setor de Indústria e Abastecimento (SIA)", lat: -15.7950, lng: -47.9510, info: "Regional Centro-Oeste" },
        { nome: "Base Belém - PA", endereco: "Região de Ananindeua (Grande Belém)", lat: -1.4558, lng: -48.4902, info: "Unidade Norte" },
        { nome: "Base Simões Filho - BA", endereco: "Rua da Independência, 263, Quadra 2 – Cia I, Simões Filho - BA", lat: -12.8122, lng: -38.4014, info: "Unidade Nordeste" },
        { nome: "Base São José - SC", endereco: "Travessa Nelson Miguel da Silva, 12 – Serraria, São José - SC", lat: -27.5758, lng: -48.6342, info: "Unidade Sul" },
        { nome: "Base São Luís - MA", endereco: "Rua Paulo Frontin, 368 – Retiro Natal, São Luís - MA", lat: -2.5522, lng: -44.2767, info: "Unidade Maranhão" },
        { nome: "Base Campo Grande - MS", endereco: "Av. Tiradentes, 445, Quadra 005 – Vila Taveirópolis, Campo Grande - MS", lat: -20.4744, lng: -54.6475, info: "Unidade Mato Grosso do Sul" }
    ]
    basesOndacom.forEach(base => {
        L.marker([base.lat, base.lng], { icon: pulsingIcon }) 
            .addTo(map)
            .bindPopup(`
                <div style="font-family: 'Poppins', sans-serif; color: #333;">
                    <strong style="color: #1b84bd; font-size: 1.1rem;">Ondacom</strong><br>
                    <strong style="font-size: 0.95rem;">${base.nome}</strong><br>
                    <span style="display:block; margin: 4px 0; color: #666; font-size: 0.85rem;">${base.endereco}</span>
                    <i style="color: #1786bc; font-size: 0.85rem;">${base.info}</i>
                </div>
            `);
    });

    const flipButtons = document.querySelectorAll('.btn-flip, .btn-flip-back');

    flipButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const card = this.closest('.flip-card');
            
            if (card) {
                card.classList.toggle('flipped');
            }
        });
    });
});
    document.getElementById('curriculo-file').addEventListener('change', function() {
    var fileName = this.files[0] ? this.files[0].name : '';
    document.getElementById('file-name-display').textContent = fileName ? 'Arquivo selecionado: ' + fileName : '';
});
    const status = '<?= $mensagem_status ?? "" ?>';

    switch (status) {
        case 'sucesso':
            Swal.fire({
                title: 'Sucesso!',
                text: 'Mensagem enviada com sucesso!',
                icon: 'success'
            });
            break;

        case 'erro':
            Swal.fire({
                title: 'Erro!',
                text: 'Erro ao enviar mensagem.',
                icon: 'error'
            });
            break;

        case 'erro_campos':
            Swal.fire({
                title: 'Erro!',
                text: 'Preencha todos os campos corretamente.',
                icon: 'error'
            });
            break;
    }
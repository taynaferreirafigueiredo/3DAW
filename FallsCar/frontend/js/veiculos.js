async function carregarVeiculos() {
    const grid = document.querySelector(".grid");

    try {
        const res = await fetch("../backend/api/index.php?rota=veiculos");
        const veiculos = await res.json();

        grid.innerHTML = "";

        veiculos.forEach(v => {
            grid.innerHTML += `
                <div class="card">
                    <h3>${v.nome}</h3>
                    <p>${v.descricao ?? ''}</p>
                    <span>R$ ${v.preco}/dia</span>
                    <button onclick="irReserva(${v.id}, '${v.nome}', ${v.preco})">
                        Reservar
                    </button>
                </div>
            `;
        });

    } catch (error) {
        grid.innerHTML = "<p>Erro ao carregar veículos</p>";
    }
}

function irReserva(id, nome, preco) {
    localStorage.setItem("veiculoSelecionado", JSON.stringify({
        id,
        nome,
        preco
    }));

    window.location.href = "reserva.html";
}

carregarVeiculos();
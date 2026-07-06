async function carregarReservas() {
    const cliente = JSON.parse(localStorage.getItem("cliente"));

    try {
        const res = await fetch("../api/api.php?rota=reservas&cliente=" + cliente.id);
        const data = await res.json();

        console.log("Reservas:", data);

    } catch (error) {
        console.log("Erro ao carregar reservas");
    }
}

carregarReservas();
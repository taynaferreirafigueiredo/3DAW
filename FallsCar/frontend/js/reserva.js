const veiculo = JSON.parse(localStorage.getItem("veiculoSelecionado"));
const veiculoInput = document.getElementById("veiculo");

if (veiculo) {
    veiculoInput.value = veiculo.nome;
    document.getElementById("valor").value = veiculo.preco;
}

const inicio = document.getElementById("inicio");
const fim = document.getElementById("fim");
const valor = document.getElementById("valor");
const total = document.getElementById("total");
const form = document.getElementById("reservaForm");
const msg = document.getElementById("msg");

function calcularTotal() {
    const d1 = new Date(inicio.value);
    const d2 = new Date(fim.value);
    const valorDia = parseFloat(valor.value);

    const dias = (d2 - d1) / (1000 * 60 * 60 * 24);

    if (dias > 0) {
        total.textContent = "R$ " + (dias * valorDia).toFixed(2);
    } else {
        total.textContent = "R$ 0";
    }
}

inicio.addEventListener("change", calcularTotal);
fim.addEventListener("change", calcularTotal);
valor.addEventListener("input", calcularTotal);

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const cliente = JSON.parse(localStorage.getItem("cliente"));
    const veiculoSelecionado = JSON.parse(localStorage.getItem("veiculoSelecionado"));

    const formData = new FormData();
    formData.append("cliente_id", cliente.id);
    formData.append("veiculo_id", veiculoSelecionado.id);
    formData.append("inicio", inicio.value);
    formData.append("fim", fim.value);
    formData.append("valor", valor.value);

    try {
        const res = await fetch("../backend/api/index.php?rota=reservar", {
            method: "POST",
            body: formData
        });

        const data = await res.json();

        if (data.success || data.status) {
            msg.style.color = "green";
            msg.textContent = "Reserva realizada com sucesso!";

            setTimeout(() => {
                window.location.href = "home.html";
            }, 1200);

        } else {
            msg.style.color = "red";
            msg.textContent = "Erro ao realizar reserva";
        }

    } catch (error) {
        msg.style.color = "red";
        msg.textContent = "Erro no servidor";
    }
});
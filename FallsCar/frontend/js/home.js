document.querySelectorAll(".card button").forEach(btn => {
    btn.addEventListener("click", () => {
        alert("Indo para reserva do veículo...");
        window.location.href = "reserva.html";
    });
});

document.getElementById("logoutBtn").addEventListener("click", () => {
    alert("Saindo do sistema...");
    window.location.href = "login.html";
});
document.getElementById("cadastroForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const msg = document.getElementById("msg");

    try {
        const res = fetch("../backend/api/index.php?rota=cadastro"), {
            method: "POST";
            body: formData
        });

        const data = await res.json();

        if (data.success || data.status) {
            msg.style.color = "green";
            msg.textContent = "Conta criada com sucesso!";

            setTimeout(() => {
                window.location.href = "login.html";
            }, 1000);

        } else {
            msg.style.color = "red";
            msg.textContent = "Erro ao cadastrar usuário";
        }

    } catch (error) {
        msg.style.color = "red";
        msg.textContent = "Erro no servidor";
    }
});
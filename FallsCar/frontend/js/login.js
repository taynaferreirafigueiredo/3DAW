document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const senha = document.getElementById("password").value;
    const msg = document.getElementById("msg");

    const formData = new FormData();
    formData.append("email", email);
    formData.append("senha", senha);

    try {
            const res = await fetch("http://localhost/FallsCar/backend/api/index.php?rota=login", {
            method: "POST",
            body: formData
        });

        const data = await res.json();

        if (data.success || data.status) {
            msg.style.color = "green";
            msg.textContent = "Login realizado com sucesso!";

            localStorage.setItem("cliente", JSON.stringify(data));

            setTimeout(() => {
                window.location.href = "home.html";
            }, 1000);

        } else {
            msg.style.color = "red";
            msg.textContent = "E-mail ou senha inválidos!";
        }

    } catch (error) {
        msg.style.color = "red";
        msg.textContent = "Erro ao conectar com servidor";
    }
});
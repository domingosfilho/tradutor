<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">

<!-- 🔥 ESSENCIAL PRA MOBILE -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Chat Agente Tradutor</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #0f172a;
    color: #fff;
    margin: 0;
}

/* Container */
.chat-container {
    max-width: 700px;
    margin: auto;
    padding: 10px;
}

/* Chat */
.chat-box {
    background: #1e293b;
    border-radius: 12px;
    padding: 15px;
    height: 65vh;
    overflow-y: auto;
}

/* Mensagens */
.msg {
    padding: 12px 16px;
    margin: 10px 0;
    border-radius: 10px;
    max-width: 80%;
    font-size: 16px;
}

.user {
    background: #2563eb;
    margin-left: auto;
    text-align: right;
}

.bot {
    background: #334155;
    margin-right: auto;
    text-align: left;
}

/* Input */
.input-area {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

input {
    flex: 1;
    padding: 14px;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 16px;
}

button {
    background: #2563eb;
    border: none;
    padding: 14px 20px;
    border-radius: 10px;
    color: white;
    font-size: 16px;
}

button:hover {
    background: #1d4ed8;
}

/* 🔥 MOBILE */
@media (max-width: 768px) {

    .chat-container {
        padding: 8px;
    }

    .chat-box {
        height: 70vh;
        padding: 10px;
    }

    .msg {
        max-width: 90%;
        font-size: 17px;
    }

    input {
        font-size: 18px;
        padding: 16px;
    }

    button {
        padding: 16px;
        font-size: 18px;
    }

    h3 {
        font-size: 20px;
    }
}
</style>

</head>
<body>

<div class="container chat-container">

<h3 class="text-center mb-3">💬 🤖 Chat Tradutor Português/Inglês</h3>

<p class="text-center text-small">
    ⚠️ Aviso: IA pode cometer erros. Confira informações importantes.
</p>

    <div id="chat" class="chat-box"></div>

    <div class="input-area">
        <input id="msg" placeholder="Digite em inglês...">
        <button onclick="enviar()">Enviar</button>
    </div>

</div>

<script>
async function enviar() {
    const input = document.getElementById("msg");
    const texto = input.value;

    if (!texto.trim()) return;

    adicionarMensagem(texto, "user");

    try {
        const res = await fetch("resposta.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "mensagem=" + encodeURIComponent(texto)
        });

        const data = await res.text();

        adicionarMensagem(data, "bot");

    } catch (erro) {
        adicionarMensagem("Erro ao conectar com o servidor.", "bot");
    }

    input.value = "";

    const chat = document.getElementById("chat");
    chat.scrollTop = chat.scrollHeight;
}

function adicionarMensagem(texto, tipo) {
    const chat = document.getElementById("chat");

    const div = document.createElement("div");
    div.className = "msg " + tipo;
    div.innerText = texto;

    chat.appendChild(div);
}

// ENTER pra enviar
document.getElementById("msg").addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        enviar();
    }
});
</script>

</body>
</html>


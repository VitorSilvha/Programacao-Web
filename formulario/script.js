
document.getElementById("formulario").addEventListener("submit", function(event) {
    event.preventDefault();

    const primeiroNome = document.getElementById("primeiroNome").value.trim();
    const ultimoNome = document.getElementById("ultimoNome").value.trim();
    const email = document.getElementById("email").value.trim();
    const generoMasculino = document.getElementById("masculino").checked;
    const generoFeminino = document.getElementById("feminino").checked;

    if (!primeiroNome || !ultimoNome || !email || (!generoMasculino && !generoFeminino)) {
        alert("Por favor, preencha todos os campos antes de enviar.");
        return;
    }

    // Se tudo estiver preenchido, envia para processa.php
    window.location.href = "processa.php";
});

document.getElementById("formulario").addEventListener("reset", function() {
    // Apenas garante que a redefinição ocorra completamente
    setTimeout(() => alert("Formulário redefinido."), 100);
});

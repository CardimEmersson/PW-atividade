$(document).ready(function () {
    $('.celular').mask('(00) 00000-0000');
});

var senha = document.getElementById("senha");
var confsenha = document.getElementById("confsenha");

function validarSenha() {
    if (senha.value != confsenha.value) {
        confsenha.setCustomValidity("Senhas diferentes!");
        return false;
    } else {
        confsenha.setCustomValidity('');
        return true;
    }
}

senha.onchange = validarSenha;
confsenha.onkeyup = validarSenha;
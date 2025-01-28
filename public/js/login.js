const mostrarPassword = () => {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; // Cambia el icono a "ojo cerrado"
    } else {
        passwordInput.type = "password";
        eyeIcon.innerHTML = '<i class="fa-regular fa-eye"></i>'; // Cambia el icono a "ojo"

    }
}

const validarLogin = (  ) => {
    alert('Validando')
}

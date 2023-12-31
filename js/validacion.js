function validarNombre(input) 
{
    const nombre = input.value;
    const errorInput = document.getElementById("nombre");
    const errorSpan = document.getElementById("nombre_error");

    if (nombre.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
        errorInput.style.borderColor="red";
    } 
    
    else if (/^\s|\s$|\d/.test(nombre)) 
    {
        errorSpan.textContent = "El nombre no puede contener números o espacios al inicio o al final.";
        errorSpan.style.color="red";
        errorInput.style.borderColor="red";
    } 
    
    else 
    {
        errorSpan.textContent = "";
        errorInput.style.borderColor="blue";
    }
}

function validarApellido(input) 
{
    const apellido = input.value;
    const errorInput = document.getElementById("apellido");
    const errorSpan = document.getElementById("apellido_error");

    if (apellido.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
        errorSpan.style.color="red";
        errorInput.style.borderColor="red";
    } 
    
    else if (/^\s|\s$|\d/.test(apellido)) 
    {
        errorSpan.textContent = "El apellido no puede contener números o espacios al inicio o al final.";
        errorSpan.style.color="red";
        errorInput.style.borderColor="red";
    } 
    
    else 
    {
        errorSpan.textContent = "";
        errorInput.style.borderColor="blue";
    }
}

function validarEmail(input) 
{
    const email = input.value;
    const errorSpan = document.getElementById("email_error");
    const errorInput = document.getElementById("email");
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const emailRegex2 = /^[a-zA-Z0-9._-]+@[contreras]+\.[com]{3}$/;

    if (email.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
        errorInput.style.borderColor="red";
    } 


    else if (!emailRegex.test(email)) 
    {
        errorSpan.textContent = "Ingresa un correo electronico valido del dominio @contreras.com.";
        errorSpan.style.color="red";
        errorInput.style.borderColor="red";
    } 

    else if (!emailRegex2.test(email)) {
        errorSpan.textContent = "Ingresa un correo que sea del dominio '@contreras.com'.";
        errorSpan.style.color="red";
        errorInput.style.borderColor="red";

    }
    
    else 
    {
        errorSpan.textContent = "";
        errorInput.style.borderColor="blue";
    }
}

function validarPwd(input) 
{
    const pwd = input.value;
    const errorInput = document.getElementById("pwd");
    const errorSpan = document.getElementById("pwd_error");
  
    if (pwd.trim() === "") 
    {
      errorSpan.textContent = "Este campo es obligatorio.";
      errorSpan.style.color="red";
      errorInput.style.borderColor="red";
    } 
    
    else if (pwd.length < 9) 
    {
      errorSpan.textContent = "La contraseña debe contener al menos 9 caracteres.";
      errorSpan.style.color="red";
      errorInput.style.borderColor="red";
    } 
    
    else 
    {
      errorSpan.textContent = "";
      errorInput.style.borderColor="blue";
    }
}

function validarCurso(input) {
    const id_curso = input.value;
    const errorInput = document.getElementById("curso");
    const errorSpan = document.getElementById("curso_error");

    if (id_curso === "") {
        errorSpan.textContent = "Has de seleccionar una opción";
        errorSpan.style.color = "red";
        errorInput.style.borderColor = "red";
    } else {
        errorInput.style.borderColor = "blue";
        errorSpan.textContent = ""; // Limpiar el mensaje de error si es válido
    }
}

// Agregar un evento de escucha al elemento 'curso' para activar la función de validación
const cursoSelect = document.getElementById("curso");
cursoSelect.addEventListener("change", validarCurso);


function validarTelefono(input) 
{
    const telefono = input.value;
    const errorInput = document.getElementById("telefono");
    const errorSpan = document.getElementById("telefono_error");
    const telefonoRegex = /^\d{9}$/;

    if (telefono.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
        errorSpan.style.color = "red";
        errorInput.style.borderColor = "red";
    } 

    else if (telefono.length !== 9 || !telefonoRegex.test(telefono)) 
    {
        errorSpan.textContent = "Ingresa un número de teléfono válido (9 dígitos).";
        errorSpan.style.color = "red";
        errorInput.style.borderColor = "red";
    } 
    
    else 
    {
        errorSpan.textContent = ""; // Limpiar el mensaje de error si es válido
        errorInput.style.borderColor = "blue";
    }
}





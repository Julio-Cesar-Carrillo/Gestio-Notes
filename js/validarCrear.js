function validarNombre(input) 
{
    const nombre = input.value;
    const errorSpan = document.getElementById("nombre_error");

    if (nombre.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
    } 
    
    else if (/^\s|\s$|\d/.test(nombre)) 
    {
        errorSpan.textContent = "El nombre no puede contener números o espacios al inicio o al final.";
    } 
    
    else 
    {
        errorSpan.textContent = "";
    }
}

function validarApellido(input) 
{
    const nombre = input.value;
    const errorSpan = document.getElementById("apellido_error");

    if (nombre.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
    } 
    
    else if (/^\s|\s$|\d/.test(nombre)) 
    {
        errorSpan.textContent = "El apellido no puede contener números o espacios al inicio o al final.";
    } 
    
    else 
    {
        errorSpan.textContent = "";
    }
}

function validarEmail(input) 
{
    const email = input.value;
    const errorSpan = document.getElementById("email_error");
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (email.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
    } 


    else if (!emailRegex.test(email)) 
    {
        errorSpan.textContent = "Ingresa un correo electronico valido.";
    } 
    
    else 
    {
        errorSpan.textContent = "";
    }
}

function validarPwd(input) 
{
    const pwd = input.value;
    const errorSpan = document.getElementById("pwd_error");
  
    if (pwd.trim() === "") 
    {
      errorSpan.textContent = "Este campo es obligatorio.";
    } 
    
    else if (pwd.length < 9) 
    {
      errorSpan.textContent = "La contraseña debe contener al menos 9 caracteres.";
    } 
    
    else 
    {
      errorSpan.textContent = "";
    }
}

function validarCurso() {
    const cursoSelect = document.getElementById("curso");
    const errorSpan = document.getElementById("curso_error");

    if (cursoSelect.value === "") {
        errorSpan.textContent = "Debes seleccionar un curso.";
    } else {
        errorSpan.textContent = "";
    }
}

// Agregar un evento de escucha al elemento 'curso' para activar la función de validación
const cursoSelect = document.getElementById("curso");
cursoSelect.addEventListener("change", validarCurso);


function validarTelefono(input) 
{
    const telefono = input.value;
    const errorSpan = document.getElementById("telefono_error");
    const telefonoRegex = /^\d{9}$/;

    if (telefono.trim() === "") 
    {
        errorSpan.textContent = "Este campo es obligatorio.";
    } 

    else if (!telefonoRegex.test(telefono)) 
    {
        errorSpan.textContent = "Ingresa un numero de telefono válido (9 dígitos).";
    } 
    
    else 
    {
        errorSpan.textContent = "";
    }
}





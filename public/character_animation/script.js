const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('input-password');

const character = document.getElementById('character');
const wing = document.getElementById('wing');
const btnViewPassword = document.getElementById("btn-verpassword")
const passwordGroup = document.getElementById("passwordGroup")

// Cuando el usuario pone el cursor en el input
emailInput.addEventListener('focus', () => {
    character.classList.add('look-at-input');
    character.classList.remove('cover-look');
});

// Cuando el usuario quita el cursor o deja de usar el input
emailInput.addEventListener('blur', () => {
    character.classList.remove('look-at-input');
});

// animacion ver password
btnViewPassword.addEventListener('click',()=>{
    character.classList.toggle('view-pass')
    character.classList.add('cover-look');
})

// animacion password
passwordInput.addEventListener('focus',()=>{
    if(!character.classList.contains('look-at-input')){
        setTimeout(function(){
            character.classList.add('cover-look');
        },500)
    }
    
})
passwordGroup.addEventListener('click',()=>{
    // character.classList.add('cover-look');
    setTimeout(function(){
        character.classList.add('cover-look');
    },500)
    passwordInput.focus()
})
document.addEventListener('mousedown', function(event) {
    if (!passwordGroup.contains(event.target) && !btnViewPassword.contains(event.target)) {
        character.classList.remove('cover-look'); // Quitar la clase si se hace clic fuera del div
    }
});



//medir letras
// Función para medir la longitud del texto en píxeles
function getTextWidth(text, font) {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    context.font = font;
    const metrics = context.measureText(text);
    return metrics.width;
}

// Función para verificar si la longitud del texto es mayor que la mitad del ancho del input
function checkTextLength() {
    const inputWidth = emailInput.getBoundingClientRect().width; // Obtener el ancho del input
    const font = window.getComputedStyle(emailInput).font; // Obtener el estilo de la fuente del input
    const text = emailInput.value; // Obtener el valor del input

    const textWidth = getTextWidth(text, font); // Medir el ancho del texto en píxeles

    if (textWidth > inputWidth / 2) {
        character.classList.add('look-mitad');
        console.log("La longitud del texto es mayor que la mitad del ancho del input.");
    } else {
        character.classList.remove('look-mitad');
        console.log("La longitud del texto es menor o igual a la mitad del ancho del input.");
    }
}

// Escuchar el evento 'input' para verificar cada vez que el usuario escriba
emailInput.addEventListener('input', checkTextLength);
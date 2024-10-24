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

//detectar autocompletado
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('animationstart', function(event) {
        if (event.animationName === 'autofill-detected') {
            console.log(`${input.placeholder} fue autocompletado.`);
            const thought = document.getElementById('thought');
            // Cambia la opacidad a 1 instantáneamente
            thought.style.opacity = '1'; 
            // Después de 1 segundo, vuelve a cambiar la opacidad a 0
            setTimeout(() => {
                thought.style.opacity = '0';
            }, 1000);
        }
    });
});

// pruebasa
const container = document.querySelector('.character');
const point = document.querySelector('.head');
const beak = document.querySelector('.my-beak');

document.addEventListener('mousemove', (event) => {
    // Obtener la posición del mouse dentro del contenedor
    const rect = container.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;
    // const mouseX = event.pageY + "px";
    // const mouseY = event.pageX + "px";

    // console.log(mouseX, mouseY);

    // Obtener el centro del contenedor
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    // Calcular la diferencia entre la posición del mouse y el centro del contenedor
    const deltaX = mouseX - centerX;
    const deltaY = mouseY - centerY;

    // Calcular la dirección (ángulo) hacia el mouse usando arctangente
    const angle = Math.atan2(deltaY, deltaX);

    // Mover el punto en la dirección del mouse, multiplicado por un factor de distancia
    const distance = 7; // Puedes ajustar esta distancia para ver cuánto se moverá el punto
    const moveX = Math.cos(angle) * distance;
    const moveY = Math.sin(angle) * distance;

    // Actualizar la posición del punto
    point.style.transform = `translate(${moveX}px, ${moveY - 2}px)`;
    // beak.style.transform = `translate(${moveX - 2}px, ${moveY - 2}px)`
});
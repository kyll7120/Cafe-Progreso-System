//! Se usa en la vista de registrar productos para el input de existencias y precio unitario
function n(e){var t=e.currentTarget,i=Math.sign(e.deltaY);i>0?t.stepDown():t.stepUp(),e.preventDefault()}document.getElementById("existencias").addEventListener("wheel",n);document.getElementById("precio_unitario").addEventListener("wheel",n);//! Se usa en la vista de registrar productos para el input de existencias
document.getElementById("existencias").addEventListener("input",function(e){var t=this.value;this.value=t.replace(/[-.]/g,"")});document.getElementById("existencias").addEventListener("keydown",function(e){(e.key==="-"||e.key===".")&&e.preventDefault()});//! Se usa en la vista de registrar productos para el input de precio unitario
document.getElementById("precio_unitario").addEventListener("keydown",function(e){e.key==="-"&&e.preventDefault()});

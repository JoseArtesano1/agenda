let cerrar=document.querySelectorAll(".close")[0],abrir=document.querySelectorAll("#mensaje-modal3")[0],modal=document.querySelectorAll(".modals")[0],modalC=document.querySelectorAll(".modal-container")[0];const correo=document.getElementById("email"),alerta=document.querySelector(".modal-textos");function activar(){abrir.addEventListener("click",(function(e){correo.value||(e.preventDefault(),alerta.classList.add("alerta","error"),alerta.textContent="Introduce un Correo",modalC.style.opacity="1",modalC.style.visibility="visible",modal.classList.toggle("modal-close"),setTimeout(()=>{modal.classList.toggle("modal-close"),modalC.style.opacity="0",modalC.style.visibility="hidden"},4e3))}))}document.addEventListener("DOMContentLoaded",()=>{activar()});
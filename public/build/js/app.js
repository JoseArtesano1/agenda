const mobileBtnMenu=document.querySelector("#mobile-menu"),sidebar=document.querySelector(".sidebar"),cerrarMenu=document.querySelector("#cerrar-menu");mobileBtnMenu&&mobileBtnMenu.addEventListener("click",(function(){sidebar.classList.add("mostrar")})),cerrarMenu&&cerrarMenu.addEventListener("click",(function(){sidebar.classList.add("ocultar"),setTimeout(()=>{sidebar.classList.remove("mostrar"),sidebar.classList.remove("ocultar")},1e3)}));const anchoPantalla=document.body.clientWidth;window.addEventListener("resize",(function(){document.body.clientWidth>=768&&sidebar.classList.remove("mostrar")}));
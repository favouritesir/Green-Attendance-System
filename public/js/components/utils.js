//--------------------------------------------------------------------------- ICONS
$mkComp("icon", (el = new HTMLElement()) => {
  el.innerHTML = `<span class="material-symbols-outlined">${el.innerHTML} </span>`;
});

//--------------------------------------------------------------------------- FLOATING CONTAINER
$mkComp("float", (el = new HTMLElement()) => {});
//--------------------------------------------------------------------------- ALERT
$mkComp("alert", (el = new HTMLElement()) => {
  el.show = el.$A("show") || false;
  el.style = `
  display:${el.show ? "block" : "none"};
  position:fixed;${el.$A("style") || ""}`;
  el.innerHTML = `
    <c-icon style="position:absolute;right:0;margin:5px;color:gray;cursor:pointer">cancel</c-icon>
    <c-float 
    style="padding-top:2rem; top:${el.$A("top") || "auto"};"
    >
      ${el.innerHTML}
    </c-float>
  `;
  el.$("c-icon").addEventListener("click", () => {
    el.style.display = "none";
  });
});

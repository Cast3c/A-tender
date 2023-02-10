const navButton = document.querySelector(".nav-btn");
const navbar = document.querySelector("aside");
const wrapper = document.querySelector(".page");
const profileBtn = document.querySelector(".btn-profile");
const dropdownProfile = document.querySelector(".dropdown-menu");
const dashboardBtn = document.getElementById("dashboard-btn");
const puntoVentaBtn = document.querySelector("#puntoVenta-btn");
const clientesBtn = document.querySelector("#clientes-btn");
const facturasBtn = document.querySelector("#facturas-btn");
const inventariosBtn = document.querySelector("#inventarios-btn");
const configBtn = document.querySelector("#config-btn");
const dashboardSection = document.querySelector(".dashboard");
const puntoVentaSection = document.querySelector(".punto-venta");
const clientesSection = document.querySelector(".clientes");
const facturacionSection = document.querySelector(".facturacion");
const inventariosSection = document.querySelector(".inventarios");
const configuracionSection = document.querySelector(".configuracion");

//================== show/hide sidebar ==================//
navButton.addEventListener("click", function () {
  if (navButton.style.transform === "rotate(0deg)") {
    navbar.style.width = "100%";
    wrapper.style.setProperty("grid-template-columns", "15rem 1fr");
    navButton.style.setProperty("transform", "rotate(90deg)");
  } else {
    wrapper.style.setProperty("grid-template-columns", "3.5rem 1fr");
    navButton.style.setProperty("transform", "rotate(0deg)");
  }
});

//================== show/hide profile menu ==================//
profileBtn.addEventListener("click", function () {
  dropdownProfile.style.display === "block" ? "none" : "block";
});

/* ================== sidebar-buttons-function ================== */
dashboardBtn.addEventListener("click", function () {
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "none";
  clientesSection.style.display = "none";
  facturacionSection.style.display = "none";
  inventariosSection.style.display = "none";
  configuracionSection.style.display =  "none";
});

puntoVentaBtn.addEventListener("click", function () {
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "grid";
  clientesSection.style.display = "none";
  facturacionSection.style.display = "none";
  inventariosSection.style.display = "none";
  configuracionSection.style.display =  "none";
});

clientesBtn.addEventListener("click", function () {
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "none";
  clientesSection.style.display = "grid";
  facturacionSection.style.display = "none";
  inventariosSection.style.display = "none";
  configuracionSection.style.display =  "none";
})

clientesBtn.addEventListener("click", function () {
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "none";
  clientesSection.style.display = "grid";
  facturacionSection.style.display = "none";
  inventariosSection.style.display = "none";
  configuracionSection.style.display =  "none";
})

facturasBtn.addEventListener("click", function(){
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "none";
  clientesSection.style.display = "none";
  facturacionSection.style.display = "grid";
  inventariosSection.style.display = "none";
  configuracionSection.style.display =  "none";
})

inventariosBtn.addEventListener("click", function(){
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "none";
  clientesSection.style.display = "none";
  facturacionSection.style.display = "none";
  inventariosSection.style.display = "grid";
  configuracionSection.style.display =  "none";
})

configBtn.addEventListener("click", function(){
  dashboardSection.style.display = "none";
  puntoVentaSection.style.display = "none";
  clientesSection.style.display = "none";
  facturacionSection.style.display = "none";
  inventariosSection.style.display = "none";
  configuracionSection.style.display =  "grid";
})

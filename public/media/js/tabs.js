function mostrarContenedor(idMostrar, botonActivo) {
  const contenedores = document.querySelectorAll('.contenedor');
  contenedores.forEach(c => c.classList.add('hidden'));

  const contenedorMostrar = document.getElementById(idMostrar);
  if (contenedorMostrar) {
    contenedorMostrar.classList.remove('hidden');
  }

  const botones = document.querySelectorAll('.tab-button');
  botones.forEach(b => b.classList.remove('active'));

  if (botonActivo) {
    botonActivo.classList.add('active');
  }
}


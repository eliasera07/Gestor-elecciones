javascript
function fetchElecciones() {
 // Fetch the data from the server using AJAX or Fetch API
 // For example, using Fetch API:
 fetch('/api/elecciones')
    .then(response => response.json())
    .then(data => {
      populateTable(data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function populateTable(data) {
 const table = document.getElementById('eleccionesTable');
 let tbody = '<tbody>';

 data.forEach(eleccion => {
    tbody += `<tr>
    
      <td>${eleccion.id}</td>
      <td>${eleccion.nombre}</td>
      <td>${eleccion.fecha_inicio}</td>
      <td>${eleccion.fecha_fin}</td>
      <td>${eleccion.estado}</td>
      <td>
        <button onclick="editarEleccion(${eleccion.id})">Editar</button>
        <button onclick="eliminarEleccion(${eleccion.id})">Eliminar</button>
      </td>
    </tr>`;
 });
}
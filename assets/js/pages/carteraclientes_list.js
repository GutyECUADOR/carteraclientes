$(function() {

    app = {
        showResults: function (arrayData) {
        
            $('#tableNuevosClientes').html('');
           
            arrayData.forEach(row => {
                
                let rowHTML = `
                    <tr>
                        <td>
                            ${ row.codigo }
                        </td>
                        <td>
                            ${ row.fecha }
                        </td>

                        <td>
                            ${ row.empresa }
                        </td>
                        <td>
                            ${ row.BodegaName }
                         </td>
                        <td>
                            ${ row.isfacturado == 1 ? '<p class="text-success">Facturado</p>' : 'No se le facturo'}
                        </td>
                       
                        <td>
                            ${ row.isNuevoCliente == 1 ? '<p class="text-success">Nuevo Cliente</p>' : 'No es nuevo cliente' }
                        </td>
                        <td>
                            ${ row.asesor }
                         </td>
                         <td>
                            ${ row.clienteCI }
                         </td>
                         <td>
                            ${ row.cliente }
                         </td>
                         <td>
                            ${ row.clienteTelefono }
                        </td>
                         <td>
                            ${ row.clienteFecha }
                         </td>
                         <td>
                            ${ row.clienteEmail }
                         </td>
                         <td>
                            ${ row.comentarios }
                         </td>
                        
                    </tr>


                   
                        `;
    
                $('#tableNuevosClientes').append(rowHTML);
    
            });
    
        },
        searchClientes: function (fechaINI, fechaFIN, dbcode) {
            $.ajax({
                url: 'getTopClientes',
                method: 'GET',
                data: {fechaINI: fechaINI, fechaFIN:fechaFIN, dbcode: dbcode},
               
                success: function(response) {
                    console.log(response);
                    let responseJSON = JSON.parse(response);
                    console.log(responseJSON);
                   
                    if (!responseJSON.ERROR) {
                        toastr.success('Busqueda finalizada', 'Realizado', {timeOut: 2000});
                        console.log(responseJSON);
                        app.showResults(responseJSON.data);
                    }else{
                        toastr.warning(responseJSON.message, 'Atencion', {timeOut: 2000});
                    }

                    
                },
                error: function(error) {
                    alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
                },
                complete: function(data) {
                    
                }
    
            });
        }
    }

   // Events and Actions
   
   let btnBuscar = $('#btnSearch');
   btnBuscar.click(function (event) {
       event.preventDefault();

       let fechaINI = $('#fechaINI').val();
       let fechaFIN = $('#fechaFIN').val();
       let dbcode = $('#codeEmpresa').val();
       console.log(fechaINI, fechaFIN, dbcode);
       
       app.searchClientes(fechaINI, fechaFIN, dbcode);

   })
    

});
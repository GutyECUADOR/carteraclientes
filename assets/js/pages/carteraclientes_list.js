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
                            ${ row.VendedorName }
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
        searchClientes: function (fechaINI, fechaFIN, dbcode, tipoInforme) {
            $.ajax({
                url: 'getTopClientes',
                method: 'GET',
                data: {fechaINI: fechaINI, fechaFIN:fechaFIN, dbcode: dbcode, tipoInforme: tipoInforme},
               
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
        },
        generaInformeExcel: function (fechaINI, fechaFIN, dbcode, tipoInforme) {
           if (fechaINI && fechaFIN && dbcode && tipoInforme) {
            let  inputs = $("#filtrosForm").serialize();
            let url = 'generaExcel?'+inputs;
            location.href = url; // nombre de la funcion en el controlador
            toastr.success('Generando archivo EXCEL', 'Espere', {timeOut: 2000});
           }else{
            toastr.warning('Filtros para informe incompletos.', 'Atencion', {timeOut: 2000});
           }
            
        }
    }

   // Events and Actions
   
   let btnBuscar = $('#btnSearch');
   btnBuscar.click(function (event) {
       event.preventDefault();

       let fechaINI = $('#fechaINI').val();
       let fechaFIN = $('#fechaFIN').val();
       let dbcode = $('#dbcode').val();
       let tipoInforme = $('#tipoInforme').val();
       console.log(fechaINI, fechaFIN, dbcode, tipoInforme);
       
       app.searchClientes(fechaINI, fechaFIN, dbcode, tipoInforme);

   })

   let btnGeneraExcel = $('#btnGeneraExcel');
   btnGeneraExcel.click(function (event) {
       event.preventDefault();

       let fechaINI = $('#fechaINI').val();
       let fechaFIN = $('#fechaFIN').val();
       let dbcode = $('#dbcode').val();
       let tipoInforme = $('#tipoInforme').val();
       console.log(fechaINI, fechaFIN, dbcode, tipoInforme);
       app.generaInformeExcel(fechaINI, fechaFIN, dbcode, tipoInforme);

   })
    

});
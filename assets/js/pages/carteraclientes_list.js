$(function() {

    app = {
        showResults: function (arrayData) {
        
            $('#tbodyresults').html('');
           
            arrayData.forEach(row => {
                
                let rowHTML = `
                    <tr>
                        <td>
                            ${ row.id  }
                        </td>
                  
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
                            ${ row.bodega }
                         </td>
                        <td>
                            ${ row.isFacturado }
                        </td>
                       
                        <td>
                            ${ row.nombreProducto }
                        
                        </td>
                        
                    </tr>


                   
                        `;
    
                $('#tableNuevosClientes').append(rowHTML);
    
            });
    
        },
        searchClientes: function (search, dbcode) {
            $.ajax({
                url: 'getTopClientes',
                method: 'GET',
                data: {search: search, dbcode: dbcode},
               
                success: function(response) {
                    console.log(response);
                    let responseJSON = JSON.parse(response);
                    console.log(responseJSON);
                   
                    if (!responseJSON.ERROR) {
                        toastr.success('Busqueda finalizada', 'Realizado', {timeOut: 2000});
                        console.log(responseJSON);
                        app.showResults(responseJSON.data);
                    }else{
                        toastr.error('No se pudo completar la busqueda', 'Error', {timeOut: 2000});
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

       let input = $('#txtSearch').val();
       let dbcode = '008'; //$('#hiddenEmpresaCode').val();
       console.log(input)
       

       if (input.length <= 0) {
           toastr.error('Indique parametros de busqueda', 'Atencion', {timeOut: 2000});
           return;
       }

       app.searchClientes(input, dbcode);

   })
    

});
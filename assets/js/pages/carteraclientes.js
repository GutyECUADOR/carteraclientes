$(function() {

    app = {
        showResults: function (arrayData) {
        
            $('#tbodyresults').html('');
           
            arrayData.forEach(row => {
                
                let rowHTML = `
                    <tr>
                        <td>
                            ${ row.idFactura  }
                        </td>
                  
                        <td>
                            ${ row.fechaVenta.slice(0,10) }
                        </td>
                        <td>
                            ${ row.rucCliente }
                        </td>

                        <td>
                            ${ row.nombreCliente }
                        </td>
                        <td>
                            ${ row.nombreBodega }
                         </td>
                        <td>
                            ${ row.codProducto }
                        </td>
                       
                        <td>
                            ${ row.nombreProducto }
                        
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a class="btn-xs btn_generarticketByID" data-codigo="${ row.idFactura  }"><i class="fa fa-ticket"></i> Crear ticket a la factura</a></li>
           
                                </ul>
                            </div>
                        </td>
                    </tr>


                   
                        `;
    
                $('#tbodyresults').append(rowHTML);
    
            });
    
        },
        validaCedula: function (cedula) {
           
            let cad = cedula.trim();
            let total = 0;
            let longitud = cad.length;
            let longcheck = longitud - 1;

            if (cedula.length >=13) {
                return {
                    validacion: true,
                    message: 'El RUC es valido'
                };
            }
    
            if (cad !== "" && longitud >=10 && longitud <=10){
                for(i = 0; i < longcheck; i++){
                if (i%2 === 0) {
                    var aux = cad.charAt(i) * 2;
                    if (aux > 9) aux -= 9;
                    total += aux;
                } else {
                    total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
                }
                }
    
                total = total % 10 ? 10 - total % 10 : 0;
    
                if (cad.charAt(longitud-1) == total) {
                    return {
                        validacion: true,
                        message: 'La cedula es valida'
                    };
                }else{
                    return {
                        validacion: false,
                        message: 'La cedula no es valida'
                    };
                }
            }else{
                return {
                    validacion: false,
                    message: 'Minimo 10 digitos'
                };
            }
            
        },
        validaCedulaRUC: function (cedula) {
           
            if (typeof(cedula) == 'string' && cedula.length == 10 && /^\d+$/.test(cedula)) {
                  var digitos = cedula.split('').map(Number);
                  var codigo_provincia = digitos[0] * 10 + digitos[1];
              
                  if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30) && digitos[2] < 6) {
              
                  if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30)) {
                    var digito_verificador = digitos.pop();
              
                    var digito_calculado = digitos.reduce(
                      function (valorPrevio, valorActual, indice) {
                        return valorPrevio - (valorActual * (2 - indice % 2)) % 9 - (valorActual == 9) * 9;
                      }, 1000) % 10;
                    return digito_calculado === digito_verificador;
                    }
                }
                    return false;
            }
              
        },
        validaCedulaRUCPROPIA: function (cedula) {

            if (cedula.length <= 13 && cedula.length >= 10){
                const digitos = cedula.split('').map(Number);

                if (digitos[2] > 6 || digitos[2] < 0 ) { //Validacion 3er digito
                    return {
                        validacion: false,
                        message: 'El 3er digito no es valido'
                    };
                }

                let suma = digitos.reduce((suma, NextNum)=>{
                    
                    return suma+NextNum;
                })

                console.log(suma);

                return  {
                    validacion: true,
                    message: 'Cedula Válida'
                };

            }else{
                return {
                    validacion: false,
                    message: 'Minimo 10 digitos y maximo 13'
                };
            }

            



        },
        validaCliente: function (RUC) {
          
            $.ajax({
                url: 'carteracliente/verificaCliente',
                method: 'GET',
                data: { RUC: RUC },
                
                success: function(response) {
                    console.log(response);
                    let responseJSON = JSON.parse(response);
                    console.log(responseJSON);
                    if (responseJSON) {
                        toastr.warning(`El cliente ${responseJSON.NOMBRE} con cedula ${responseJSON.RUC} ya existe`, 'Atencion', {timeOut: 5000});
                        cedulaCI.val('');
                       
                    }else{
                        toastr.success(`La cedula o RUC ${RUC}, aun no esta registrado`, 'Atencion', {timeOut: 5000});
                    }
            
                    
                },
                error: function(error) {
                    alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
                },
              
            });
           
        }
    }

    // Events and Actions

    let registerForm = $('#registerForm');
    registerForm.submit(function (event) {
        event.preventDefault();

        let data = registerForm.serializeArray();        
        console.log(data);

        $.ajax({
            url: 'carteracliente/register',
            method: 'POST',
            data: data,

            success: function(response) {
                console.log(response);
                let responseJSON = JSON.parse(response);
                console.log(responseJSON);
                console.log(data);
               
                if (responseJSON.error == false) {
                    
                    toastr.success(responseJSON.message + ' ID de registro: ' + responseJSON.nuevo_id, 'Realizado', {timeOut: 5000});
                    registerForm.trigger("reset");
                }else if (responseJSON.error == true){
                    toastr.error(responseJSON.message, 'Error', {timeOut: 5000});
                }
                
               
               
            },
            error: function(error) {
                alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
            },
            complete: function(data) {
                $('#modal_new_ticket').modal('hide');
            }

        });

    })


    let cedulaCI = $('#clienteCI');
    cedulaCI.change(function (event) {
        event.preventDefault();

        let cedula = $(this).val();
        console.log(cedula);

        let respuesta = app.validaCedula(cedula);
        console.log(respuesta);

        if (respuesta.validacion) {
            toastr.success(respuesta.message, 'Atencion', {timeOut: 2000});
            app.validaCliente(cedula);
           
        }else{
            toastr.warning(respuesta.message, 'Atencion', {timeOut: 4000});
            cedulaCI.val('');
        }

       
        
       
    })


    
    $('#tbodyresults').on("click", ".btn_generarticketByID", function(event) {
        event.preventDefault();
        let ID = $(this).data('codigo');
        let dbcode = $('#selectEmpresa').val();
        console.log(ID);
        $('#modal_new_ticket').modal('show');
        $('#facturaID').val(ID);
        app.searchFacturaByID(ID, dbcode);

    })

    

});
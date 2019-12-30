$(function() {

    app = {
        loadBodegas: function (db_code) {
          
            $.ajax({
                url: 'login/getLocales',
                method: 'GET',
                data: { db_code: db_code },
                
                success: function(response) {
                    let responseJSON = JSON.parse(response);
                    console.log(responseJSON);

                    let select = document.getElementById("bodega"); 
                   
                    responseJSON.forEach(item => {
                        var option = document.createElement("option");
                        option.textContent = item.NOMBRE;
                        option.value = item.CODIGO;
                        select.appendChild(option);
                    })
                   
                },
                error: function(error) {
                    alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
                },
              
            });
           
        }
    }

    $('#tipoinstitucion').on("change", function(event) {
        event.preventDefault();
        let dbcode = $(this).val();
        console.log(dbcode);

        app.loadBodegas(dbcode);

    })

    

});
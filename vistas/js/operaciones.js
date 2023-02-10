$(document).ready(function(){
    //===================================================================================//
    //============ ACCIONES DE LA APP ============//
    //===================================================================================//

    /*------ funcion busqueda inmediata producto ------*/ 
    $("#buscar_produc").keyup(function()
    {
        var textoBusqueda = document.getElementById("buscar_produc").value;
        if (textoBusqueda !="") {
            listarResultBusqueda(textoBusqueda);
        }
    });

    /*------ funcion agregar transaccion ------*/
    $("#add_transac").click(function()
    {
        var fechaTransac = document.getElementById("fechaTransac").value;
        var idproduct    = document.getElementById("id_product").value;
        var nomProduct   = document.getElementById("nom_product").value;
        var idUsuario    = document.getElementById("idUsu").value;
        var linVenta     = document.getElementById("lineaVenta").value
        var cantProduc   = document.getElementById("cant_product").value;
        var precioProduc = document.getElementById("#precio_product").value;
        asignarValoresTransac(idproduct,nomProduct,tipTransac,linVenta,fechaTransac,idUsuario, precioProduc, cantProduc)
    });     
    
    /*------ funcion guardar transacciones ------*/
    $("#save_transacs").click(function()
    {
        guardarTransacciones();
        $("$transacciones").html("");
    });

    /*------ funcion busqueda inmediata cliente ------*/
    $("#buscar_cliente").keyup(function(){

        var textoBusqueda = document.getElementById("buscar_cliente").value;
        if (textoBusqueda != "") {
            listarResultBusquedaClientes(textoBusqueda);
        }
    })

    /*------ funcion agregar producto a factura------*/
    $("#add_producto").click(function(){
        var idproduct    = document.getElementById("id_product").value;
        var nomProduct   = document.getElementById("nom_product").value;
        var idUsuario    = document.getElementById("idUsu").value;
        var linVenta     = document.getElementById("lineaVenta").value
        var precioProduc = document.getElementById("precio_product").value
        var cantProduc   = document.getElementById("cant_product").value;
        asignarProducsFact(idproduct, nomProduct, idUsuario, linVenta, precioProduc, cantProduc)
        sumaTotalPrecios();
    })

    $(".selected_prods")

});
//===================================================================================//
//============ funcion listar los resultados de la busqueda de clientes ============//
function listarResultBusquedaClientes(busqueda){
    $.ajax({
        url: 'http://localhost/tenderAppLocal/ajax/clienteAjax.php?value=3',
        type: 'POST',
        data: {
            busqueda: busqueda
        }
    }).done(function (resp) {
        var data = JSON.parse(resp);
        var result = "";
        if (data.length>=1) {
            for (var i = 0; i< data.length; i++) {
                result+= 
                        '<tr>'+
                            '<td id="nomClient">'  +data[i][1]+ '</td>'+
                            '<td id="apellClient">'+data[i][2]+ '</td>'+
                            '<td id="ccClient">'   +data[i][3]+ '</td>'+
                            '<td id="sedeClient">' +data[i][4]+ '</td>'+
                            '<td class="btn" onclick="capturaCliente()"><i id="" class="fa-solid fa-check"></i></td>'+
                        '</tr>';                          
            }
            $("#sel_cliente").html(result);
        }else{
            alert(data)
        }
    })
}
//===================================================================================//

//===================================================================================//
//============ funcion capturar cliente seleccionado ============//
function capturaCliente()
{
    var nombreClient = (document.getElementById('nomClient').innerHTML)+' '+(document.getElementById('apellClient').innerHTML);
    var ccClient = document.getElementById('ccClient').innerHTML;
    var sedeClient = document.getElementById('sedeClient').innerHTML;
    $("#nomCliente").html(nombreClient);
    $("#ccCliente").html(ccClient);
    $("#sedeCliente").html(sedeClient);
    $("#buscar_cliente").val("");
    $("#sel_cliente").html("");
}
//===================================================================================//

//===================================================================================//
//========= funcion listado de productos para guardar en base de datos =========// 
function asignarProducsFact(idProduc, producto, usuario, lineaVenta, precio, cantidad )
{
       
    cadena = "";
    
    totalProduc = cantidad*precio;

    if (idProduc!="" && producto!="" && usuario!="" && lineaVenta!="" && precio!="" && cantidad!="" ){
        cadena +=
                    '<tr>'+
                        '<td style="visibility:collapse; display:none;">'+lineaVenta+'</td>'+
                        '<td style="visibility:collapse; display:none;">'+idProduc+'</td>'+
                        '<td style="visibility:collapse; display:none;">'+usuario+'</td>'+
                        '<td>'  +producto+'</td>'+
                        '<td>'+precio+'</td>'+
                        '<td>'  +cantidad+'</td>'+
                        '<td>'+totalProduc+'</td>'+
                        '<td><i class="fa-solid fa-xmark"></i></td>'+
                    '</tr>';    
    }
               

    $("#producs_factura").append(cadena);
    $("#buscar_produc").val("");
    $("#sel_produc").html("");
    $("#nom_product").val("");
    $("#cant_product").val("");
    $("#precio_product").val("");
    $("").reset;
}
//===================================================================================//

//===================================================================================//
//============ funcion guardar transacciones en base de datos ============// 
function sumaTotalPrecios()
{
    var trs = $("#producs_factura tr").length;
    var tds = $("#producs_factura td").length;
    let pocision=6;
    total = 0;
    for (let i = 0; i < trs; i++) {
        for (var x = 0; x < tds; x++) {
            var element = $("#producs_factura td")[pocision].innerHTML;
        }
        total = total+(element*1);
        pocision= pocision+8;
    } 
    $("#totalFactura").html(total)
    console.log(total);
}
//===================================================================================//

//===================================================================================//
//============ funcion listar los resultados de la busqueda de productos ============//
function listarResultBusqueda(busqueda)
{
    $.ajax({
        url: 'http://localhost/tenderAppLocal/ajax/productoAjax.php?value=3',
        type: 'POST',
        data: {
            busqueda: busqueda
        } 
    }).done(function(resp){
        var data = JSON.parse(resp);
        var result = "";
        if (data.length>=1) {
            for (var i = 0; i<data.length; i++) {
                result+=
                        '<tr>'+
                            '<td id="id'+i+'">'          +data[i][0]+ '</td>'+
                            '<td id="nomProduc'+i+'">'   +data[i][1]+ '</td>'+
                            '<td id="precioProduc'+i+'">'+data[i][2]+ '</td>'+
                            '<td class="btn" onclick="produCapt('+i+')"><i id="asignar" class="fa-solid fa-check"></i></td>'+
                        '</tr>';
            }
            $("#sel_produc").html(result);    
        }else{
            alert(data)
        }     
    })
}
//===================================================================================//

//===================================================================================//
//========= funcion capturar producto seleccionado ==========//
function produCapt(num)
{
    var id = document.getElementById('id'+num).innerHTML;
    var nombre = document.getElementById('nomProduc'+num).innerHTML;
    var precio = document.getElementById('precioProduc'+num).innerHTML;
    $("#id_product").val(id);
    $("#nom_product").val(nombre);
    $("#precio_product").val(precio);
    $("#buscar_produc").val("");
    $("#sel_produc").html("");
}
//===================================================================================//

//===================================================================================//
//========= funcion listado de transacciones para guardar en base de datos =========// 
function asignarValoresTransac(idProduc, producto, transaccion, lineaVenta, fecha, usuario, precio, cantidad )
{
    
    var tds=$("#lista_transacc tr").length
    
    cadena = "";
    
    totalProduc = cantidad*precio;

    if (idProduc!="" && producto!="" && transaccion!="" && lineaVenta!="" && fecha!="" && usuario!="" && cantidad!="" && precio!= "")
                    '<td style="visibility:collapse; display:none;">'+fecha+'</td>'+
                    '<td style="visibility:collapse; display:none;">'+usuario+'</td>'+
                    '<td style="visibility:collapse; display:none;">'+idProduc+'</td>'+
                    '<td style="visibility:collapse; display:none;>'+lineaVenta+'</td>'+
                    '<td>'+producto+'</td>'+
                    '<td>'+precio+'</td>'+
                    '<td>'+cantidad+'</td>'+
                    '<td>'+totalProduc+'</td>'
                    '<td><i class="fa-solid fa-xmark"></i></td>'+
                '</tr>';    
    

    $("#transacciones").append(cadena);
    $("#buscar_produc").val("");
    $("#sel_produc").html("");
    $("#nom_product").val("");
    $("#cant_product").val("");
}
//===================================================================================//

//===================================================================================//
//============ funcion guardar transacciones en base de datos ============// 
function guardarTransacciones()
{
    var trs=$("#transacciones tr").length; 
    var tds=$("#transacciones td").length;
    conteoDatos= 7;
    cuenta = 0;
    for (var i = 0; i < trs; i++) {
        var datos = []
        for (var x = cuenta; x<conteoDatos; x++) {
            var crrntTd= $("#transacciones td")[x].innerHTML;
            datos.push((crrntTd));  
        }
        cuenta = conteoDatos+1;

        conteoDatos = ((conteoDatos*trs)+1);
        //enviar el array de datos al controlador
        $.ajax({
            url: 'http://localhost/tenderAppLocal/ajax/transaccionesAjax.php?value=1',
            type: 'POST',
            data: {
                data: datos
            }
        }).done(function(resp){
            
        })  
    }
    alert("Transacciones guardadas en base de datos");
    $("#transacciones").empty();
}
//===================================================================================//

//================== funcion listar productos en vista ventas ==================//
function listaProductos(filter){
    $.ajax({
        url: 'http: //localhost/tenderAppLocal/ajax/productoAjax.php?value'
    })
}
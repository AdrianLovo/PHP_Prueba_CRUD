import {listarFetch, eliminarFetch, agregarFetch, modificarFetch} from './UtilFetch.js';

export async function listarTable(){
    let lista = new Array();
    lista = await listarFetch('../App/Controllers/ControllerUsuario.php', '', '');

    let table = $('#tablaUsuario').DataTable({
        data: lista,
        
        "columns": [               
            //Mostrados
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "created_at" },
            { "data": "updated_at" },
            {
                "className": 'details-delete',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },  
            {
                "className": 'details-edit',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },                              
            //Ocultos
            { "data": "imagen" }
        ],
        "order": [[0, 'asc']],
        "columnDefs": [
            {
                "targets": [7],
                "visible": false,
                "searchable": false
            }
        ],
        
    });       
    return table;
}

export function eliminarTable(table){
    $('#tablaUsuario tbody').on('click', 'td.details-delete', function () {
        if(eliminarFetch( 
            "../App/Controllers/ControllerUsuario.php", "id",
            table.row($(this).parents('tr')).data().id)){
            table.row($(this).parents('tr')).remove().draw();
        }
    });
}

export async function agregarTable(){
    let respuesta = new Array()
    respuesta = await agregarFetch('../App/Controllers/ControllerUsuario.php', frmUsuario);

    if(respuesta.length > 0){
        $('#tablaUsuario').dataTable().fnAddData([
            { 
                "id": respuesta[0]['id'], 
                "name": respuesta[0]['name'], 
                "email": respuesta[0]['email'], 
                "created_at": respuesta[0]['created_at'], 
                "updated_at": respuesta[0]['updated_at'], 
                "imagen": respuesta[0]['imagen'] 
            }
        ]);            
    }
}

export async function modificarTable(){
    let respuesta = new Array()
    let fila = frmUsuarioE[3].value;
    respuesta = await modificarFetch('../App/Controllers/ControllerUsuario.php', frmUsuarioE);
        
    if(respuesta.length > 0){
        $("#tablaUsuario").DataTable().cell( fila, 1).data(respuesta[0]['name']);  
        $("#tablaUsuario").DataTable().cell( fila, 2).data(respuesta[0]['email']); 
        $("#tablaUsuario").DataTable().cell( fila, 4).data(respuesta[0]['updated_at']);
        $("#tablaUsuario").DataTable().cell( fila, 7).data(respuesta[0]['imagen']);
    }
}
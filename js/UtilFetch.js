import {mensaje} from './UtilSweetMessage.js';

export async function listarFetch(ruta, filtro, parametro){
    const data = new FormData();
    data.append('metodo', 'Listar');
    data.append('filtro', filtro);
    data.append('parametro', parametro);
    
    try{
        let response = await fetch(ruta, {
            method: 'POST',
            body: data
        });
        let respuesta = await response.json();
        //let respuesta = await response.text();
        //console.log(respuesta);
        
        if(respuesta.length > 0){
            return respuesta;
        }
    }catch(error){
        mensaje('Error para conectarse al servidor', 'error');  
        return null;	
    }
} 

export async function eliminarFetch(ruta, columna, id){
    const data = new FormData();
    data.append('metodo', 'Eliminar');
    data.append(columna, id);
    
    try{
        let response = await fetch(ruta, {
            method: 'POST',
            body: data
        });
        let respuesta = await response.text();
        //console.log(respuesta);
        
        if(respuesta.length > 0){
            mensaje('Registro Eliminado', 'success'); 
            return true;
        }else{
            mensaje('Error eliminando Registro', 'error');  	 	    
        }
    }catch(error){
        mensaje('Error para conectarse al servidor', 'error');  
        return false;	
    }
}

export async function agregarFetch(ruta, formulario){
    try{
        let response = await fetch(ruta, {
            method: 'POST',
            body: new FormData(formulario)
        })
        let respuesta = await response.json();      
        //let respuesta = await response.text();      
        //console.log(respuesta);        
        
        if(respuesta.length > 0){
            mensaje('Registro Agregado', 'success');  
            formulario.reset();  
            return respuesta;              
        }else{
            mensaje('Error Agregando Registro', 'error');
            return respuesta;
        }
    }catch(error){
        mensaje('Error Agregando Registro', 'error');
    }
}

export async function modificarFetch(ruta, formulario){
    try{
        let response = await fetch(ruta, {
            method: 'POST',
            body: new FormData(formulario)
        })
        let respuesta = await response.json();
        //let respuesta = await response.text();
        //console.log(respuesta);
       
        if(respuesta.length > 0){
            formulario.reset();
            mensaje('Registro Modificado', 'success');
           return respuesta;
        }else{
            mensaje('Registro sin cambios', 'success');
            return respuesta;
        }
    }catch(error){
        mensaje('Error Modificando Registro', 'error');
    }
}


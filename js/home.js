import {mensaje} from './UtilSweetMessage.js';
import {listarTable, eliminarTable, agregarTable, modificarTable} from './homeFunciones.js';

(async function(){
   
    //ELEMENTOS DOM
    let table;  
    let img = document.getElementById('img');   
    let salir = document.getElementById('salir');
    let agregar = document.getElementById('agregar');
    let cancelar = document.getElementById('cancelar');    
    let modificar = document.getElementById('modificar');    
    let imgPrevia = document.getElementById('imgPrevia');
    let frmUsuario = document.getElementById("frmUsuario");
    let frmUsuarioE = document.getElementById('frmUsuarioE');

    
    table = await listarTable();
    eliminarTable(table);
    Modificar();  
    
   
    //AGREGAR
    agregar.addEventListener("click", async (e) => {
        e.preventDefault();
        if(validarFormularioAgregar(frmUsuario)){
            agregarTable(frmUsuario);
            imgPrevia.src = "/Resources/img/default.png";
            $("a[href='#pills-listar']").tab("show");
        }        
    });

    //MODIFICAR
    function Modificar(){   
        $('#tablaUsuario tbody').on('click', 'td.details-edit', function () {
            frmUsuarioE[1].value = table.row($(this).parents('tr')).data().id;
            frmUsuarioE[2].value = table.row($(this).parents('tr')).data().imagen;
            frmUsuarioE[3].value = table.row( this ).index();
            frmUsuarioE[4].value = table.row($(this).parents('tr')).data().name;
            frmUsuarioE[5].value = table.row($(this).parents('tr')).data().email;
            
            if(table.row($(this).parents('tr')).data().imagen != null){
                document.getElementById("imgPreviaE").src = table.row($(this).parents('tr')).data().imagen;   
             }

            $("#pills-modificar-tab").removeClass("disabled");        
            $("a[href='#pills-modificar']").tab("show");            
        });
    }

    modificar.addEventListener("click", (e) => {
        e.preventDefault();  
        if(validarFormularioModificar(frmUsuarioE)){
            modificarTable();
            $("#pills-modificar-tab").addClass("disabled");        
            $("a[href='#pills-listar']").tab("show"); 
        }
        
    });    

    //VALIDAR FORMULARIO
    function validarFormularioAgregar(frmUsuario){
        let nombreWarning = document.getElementById('nombreWarning');
        let passwordWarning = document.getElementById('passwordWarning');
        let emailWarning = document.getElementById('emailWarning');


        //name
        if(frmUsuario[1].value.length == 0){
            frmUsuario[1].classList.add('Error')
            nombreWarning.innerHTML = '<p class="text-danger">*Ingrese un Nombre</p>'
            return false;
        }else{
            nombreWarning.innerHTML = ''
            frmUsuario[1].classList.remove('Error')
        }  

        //password
        if(frmUsuario[2].value.length == 0){
            frmUsuario[2].classList.add('Error')
            passwordWarning.innerHTML = '<p class="text-danger">*Ingrese un Password</p>'
            return false;
        }else{
            passwordWarning.innerHTML = ''
            frmUsuario[2].classList.remove('Error')
        }

        //email
        if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(frmUsuario[3].value)){
            frmUsuario[3].classList.add('Error');
            emailWarning.innerHTML = '<p class="text-danger">*Email invalido</p>';
            return false;
        }else{
            emailWarning.innerHTML = '';
            frmUsuario[3].classList.remove('Error');
        }  

        return true;     
    }

    //VALIDAR FORMULARIO
    function validarFormularioModificar(frmUsuario){
        let nombreEWarning = document.getElementById('nombreEWarning');
        let emailEWarning = document.getElementById('emailEWarning');

        //name
        if(frmUsuario[4].value.length == 0){
            frmUsuario[4].classList.add('Error')
            nombreEWarning.innerHTML = '<p class="text-danger">*Ingrese un Nombre</p>'
            return false;
        }else{
            nombreEWarning.innerHTML = ''
            frmUsuario[4].classList.remove('Error')
        }  

        //email
        if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(frmUsuario[5].value)){
            frmUsuario[5].classList.add('Error');
            emailEWarning.innerHTML = '<p class="text-danger">*Email invalido</p>';
            return false;
        }else{
            emailEWarning.innerHTML = '';
            frmUsuario[5].classList.remove('Error');
        }  

        return true;     
    }

    cancelar.addEventListener('click', function(e){
        e.preventDefault();
        frmUsuarioE.reset();
        document.getElementById("imgPreviaE").src = "/Resources/img/default.png";
        $("#pills-modificar-tab").addClass("disabled");        
        $("a[href='#pills-listar']").tab("show");    
    });

    //IMAGENES 
    img.addEventListener('change', (e) => {
        let file = e.target.files[0];
        let img = URL.createObjectURL(file);
        let sizeByte = file.size;
        let siezekiloByte = parseInt(sizeByte / 1024);
        
        if (!(/\.(jpg|png|gif)$/i).test(file.name)) {
            mensaje('Tipo de archivo NO Admitido', 'error');        
        }else{
            if(siezekiloByte > 1024){
                mensaje('Tamaño maximo de archivo 1MB', 'error');        
            }else{
                document.getElementById("imgPrevia").src = img;  
            }
        }
    });

    imgE.addEventListener('change', (e) => {
        let file = e.target.files[0];
        let imgE = URL.createObjectURL(file);
        let sizeByte = file.size;
        let siezekiloByte = parseInt(sizeByte / 1024);
        
        if (!(/\.(jpg|png|gif)$/i).test(file.name)) {
            mensaje('Tipo de archivo NO Admitido', 'error');        
        }else{
            if(siezekiloByte > 1024){
                mensaje('Tamaño maximo de archivo 1MB', 'error');        
            }else{
                document.getElementById("imgPreviaE").src = imgE;  
            }
        }
    });

    //SALIR
    salir.addEventListener('click', function(e){
        e.preventDefault();
        Salir();
    })

    async function Salir(){
        const data = new FormData();
        data.append('metodo', 'Salir');
        
        try{
            let response = await fetch('../App/Controllers/Controller.php', {
                method: 'POST',
                body: data
            });
            let respuesta = await response.text();

            if(respuesta == "ok"){
                window.location="/index.php";                
            }           
        }catch(error){
            mensaje('Error para conectarse al servidor', 'error');  	
        }
    }   

})();

import {mensaje} from './UtilSweetMessage.js';
import {agregarFetch} from './UtilFetch.js';

(async function(){
   
    //ELEMENTOS DOM
    let img = document.getElementById('img');   
    let imgPrevia = document.getElementById('imgPrevia');
    let frmUsuario = document.getElementById("frmUsuario");
    let registrar = document.getElementById('registrar');


    //BTN AGREGAR
    registrar.addEventListener("click", async (e) => {
        e.preventDefault();
             
        if(validarFormulario(frmUsuario)){           
            let respuesta = new Array()
            respuesta = await agregarFetch('../App/Controllers/ControllerUsuario.php', frmUsuario);            
            
            if(respuesta.length > 0){
                imgPrevia.src = "/Resources/img/default.png";
            }
        }
    });

    //IMAGEN
    img.addEventListener('change', (e) => {
        let file = e.target.files[0];
        let img = URL.createObjectURL(file);
        let sizeByte = file.size;
        let siezekiloByte = parseInt(sizeByte / 1024);
        
        if (!(/\.(jpg|png|gif)$/i).test(file.name)) {
            frmUsuario[4].classList.add('Error');
            imagenWarning.innerHTML = '<p class="text-danger">*Tipo de Archivo invalido</p>';
            frmUsuario[4].value = '';
            document.getElementById("imgPrevia").src = '/Resources/img/default.png';  
        }else{
            frmUsuario[4].classList.remove('Error');
            imagenWarning.innerHTML = '';
            if(siezekiloByte > 1024){
                frmUsuario[4].classList.add('Error');
                imagenWarning.innerHTML = '<p class="text-danger">*Tamaño maximo de archivo 1MB</p>';
                frmUsuario[4].value = '';        
                document.getElementById("imgPrevia").src = '/Resources/img/default.png';  
            }else{
                document.getElementById("imgPrevia").src = img;  
                frmUsuario[4].classList.remove('Error');
                imagenWarning.innerHTML = '';
            }
        }
    });

    //VALIDAR FORMULARIO
    function validarFormulario(frmUsuario){
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
   

})();

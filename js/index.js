import {mensaje} from './UtilSweetMessage.js';

//Funcion anonima auto ejecutable
(function(){

    //ELEMENTOS DOM
    let btnLogin = document.getElementById('btnLogin');
    let inputs = document.querySelectorAll('input.data');
    let inputsArray = [...inputs];
    let valores = [];
    
    
    //EVENTOS
    btnLogin.addEventListener('click', () => ValidaCampos());
    inputsArray[1].addEventListener('keypress', (event) => event.keyCode == 13 ? ValidaCampos() : '' );    //Enter en input password

    //VALIDAR
    function ValidaCampos(){
        if(inputsArray[0].value.length > 0 && inputsArray[1].value.length > 0){
            inputsArray.forEach(function(element){   
                valores.push(element.value)
            })         
            Autenticar(valores[0], valores[1]);
        }else{
            mensaje('Existen campos vacios', 'error');         
        }
    }
    
    //AUTENTICAR
    async function Autenticar(email, password){
        const data = new FormData();
        data.append('metodo', 'Login');
        data.append('email', email);
        data.append('password', password);
        try{
            let response = await fetch('../App/Controllers/ControllerUsuario.php', {
                method: 'POST',
                body: data
            });
            let respuesta = await response.text();
            
            if(respuesta == "ok"){
                mensaje('Login', 'success');
                setTimeout(function(){ window.location="/views/home.php"; }, 1000);               
            }else{
                mensaje('Los datos ingresados son incorrectos', 'error'); 
                setTimeout(function(){ window.location.reload(); }, 1000);                
            }
        }catch(error){
            mensaje('Error para conectarse al servidor', 'error');  	
        }
    }
    
})();



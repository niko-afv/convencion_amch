//Se agrega validación de clubes
$.formUtils.addValidator({
    name : 'select_club',
    validatorFunction : function(value, $el, config, language, $form) {
        return (value > 0 && value < 38);
    },
    errorMessage : 'Debe seleccionar un club',
    errorMessageKey: 'badEvenNumber'
});

//Se castellanizan los mensajes de validación
var myLanguage = {
    errorTitle          : 'El envío del formulario ha fallado!',
    requiredFields      : 'Este campo es obligatorio',
    badEmail            : 'No has escrito una dirección de e-mail correcta.',
    lengthBadEnd        : ' caracteres',
    lengthTooShortStart : 'Tu respuesta debe contener mas de ',
};
//Se instancia la validación de formulario
$.validate({
    language : myLanguage
});

$(document).ready(function(){
    $('.chosen-select').chosen();

    $("form").submit(function(e){
        //e.preventDefault();
    });
});
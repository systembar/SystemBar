$(document).ready( 
    
    setTimeout(function(){
    
    $('.content-login').css("opacity", "1");
    }, 100)
)

//Email

$('#email').on('focus', function(){
    
    $('.lbl-email').css("margin-top", "-20px");
    $('.lbl-email').css("font-size", "14px");
})

$('#email').on('focusout', function(){
    
    if($('#email').val().length < 1){
        
        $('.lbl-email').css("margin-top", "15px");
        $('.lbl-email').css("font-size", "20px");
    }else{
        $('.lbl-email').css("margin-top", "-20px");
    $('.lbl-email').css("font-size", "14px");
    }
})

//Contraseña

$('#clave').on('focus', function(){
    
    $('.lbl-clave').css("margin-top", "20px");
    $('.lbl-clave').css("font-size", "14px");
})

$('#clave').on('focusout', function(){
    
    if($('#clave').val().length < 1){
        
        $('.lbl-clave').css("margin-top", "50px");
        $('.lbl-clave').css("font-size", "20px");
    }else{
        $('.lbl-clave').css("margin-top", "20px");
    $('.lbl-clave').css("font-size", "14px");
    }
})

//Campo

$('#campo').on('focus', function(){
    
    $('.lbl-campo').css("margin-top", "20px");
    $('.lbl-campo').css("font-size", "20px");
})



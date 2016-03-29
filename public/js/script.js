function Datos(){
    var dato = $('#genre').val();
    var route = 'http://localhost:8000/genero';
    var token = $('#token').val();

    $.ajax({
        url:        route,
        headers:    {'X-CSRF-TOKEN':token},
        type:       'POST',
        dataType:   'json',
        data:       {genre: dato},

        success:function(){
            $('#msj-success').fadeIn();
            $('#genre').val('');
        }
    });
};

$('form').keypress(function(e){
    if(e.which === 13){
        if($('#genre').val() === ''){
            $('#msj-danger').fadeIn();
        }else{
            Datos();
        }
        return false;
    }
});
$('#registro').click(function(){
    if($('#genre').val() === ''){
        $('#msj-danger').fadeIn();
    }else{
        Datos();
    }
});


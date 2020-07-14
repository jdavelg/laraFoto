var url = 'https://secure-meadow-51659.herokuapp.com';

window.addEventListener("load", function() {
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    $(document).on("click", ".btn-like", function like() {
        $(this).addClass('btn-dislike').removeClass('btn-like');
        $(this).attr('src', url+'/img/rojo.png');

        $.ajax({
            url: url + '/like/' + $(this).data('id'),
            type: 'GET',
            success: function (response) {
                if (response.like) {
                    console.log('has dado like a la publicacion');
                } else {
                    console.log('error al dar like');
                }
            }
        });

    });
    $(document).on("click", ".btn-dislike", function dislike() {
        $(this).addClass('btn-like').removeClass('btn-dislike');
        $(this).attr('src', url+'/img/gray.png');

        $.ajax({
            url: url + '/dislike/' + $(this).data('id'),
            type: 'GET',
            success: function (response) {
                if (response.like) {
                    console.log('has dado dislike a la publicacion');
                } else {
                    console.log('error al dar dislike');
                }
            }
        });
    });
    //buscador
    $('#buscador').submit(function(e){
       
        $(this).attr('action', url+'/gente/'+$('#buscador #search').val());
        
    })
    
    
    
});
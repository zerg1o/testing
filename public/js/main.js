var url = "http://proyecto-laravel.com.devel";
window.addEventListener('load',function(){
    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    function like(){
        //dar like
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'/img/hearts-red.png');
            $.ajax({
                url:url+'/like/'+$(this).data('id'),
                type:'get',
                success:function(response){
                    if(response.like){
                        console.log('Has dado like');
                    }else{
                        console.log('error al dar like');
                    }

                }
            });


            dislike();
        });


    }

    like();

    function dislike(){
        //dar dislike
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'/img/hearts-black.png');
            $.ajax({
                url:url+'/dislike/'+$(this).data('id'),
                type:'get',
                success:function(response){
                    if(response.like){
                        console.log('Has dado dislike');
                    }else{
                        console.log('error al dar dislike');
                    }

                }
            });

            like();
        });

    }

    dislike();


    $('#buscar').submit(function(){

        $(this).attr('action',url+'/users/'+$('#buscar #user').val());

    });
});

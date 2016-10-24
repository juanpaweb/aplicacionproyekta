$(function() {

        var menuPrincipal = $("#menu");
        var objscene = $(window).height();
        $(menuPrincipal).css("height",objscene+"px");

        var contenidoInterno = $(".div_logo_int");
         $(contenidoInterno).css("min-height",objscene+"px");

        $('#menu-button').click(function(){
                $('#container').toggleClass('active');
        });

        $('#btn_search').click(function(){
                $('#container').toggleClass('active-search');
                $('#container').removeClass('active-usser');
        });

        $('#btn_close_search').click(function(){
                $('#container').removeClass('active-search');
                return false;
        });

        $('#btn_despliegue_usser').click(function(){
                $('#container').toggleClass('active-usser');
                $('#container').removeClass('active-search');
        });

        $('#btn_close_usser').click(function(){
                $('#container').removeClass('active-usser');
                return false;
        });
});

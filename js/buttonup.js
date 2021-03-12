
jQuery(document).ready(function($){
    $('<style>'+
        '.scrollTop{ display:none; z-index:9999; position:fixed;'+
            'bottom:20px; left:90%; width:100%; height:10%; opacity: 0.8;'+
            'background:url(../icons/vector/up-button.svg) 0 0 no-repeat; }'
    +'</style>').appendTo('body');
    var
    speed = 550,
    $scrollTop = $('<a href="" class="scrollTop">').appendTo('body');		
    $scrollTop.click(function(e){
        e.preventDefault();
        $( 'html:not(:animated),body:not(:animated)' ).animate({ scrollTop: 0}, speed );
    });

    //появление
    function show_scrollTop(){
        ( $(window).scrollTop() > 330 ) ? $scrollTop.fadeIn(700) : $scrollTop.fadeOut(700);
    }
    $(window).scroll( function(){ show_scrollTop(); } );
    show_scrollTop();
});

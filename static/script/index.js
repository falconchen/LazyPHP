    $(document).ready(function(){
            $('.view_news').click(
                function() {    
                    $('.hero-unit').load(($(this).attr('href')));
                    $('.nav-list .active').removeClass('active');
                    $(this).parent().addClass('active');
                    return false;
                });
                
    });
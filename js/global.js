(function($) {


    var $header = $('header'),
        $menuButton = $header.find('#menu-toggle'),
        $menuMain = $header.find('.main-navigation'),
        $buttonOpenSearch = $('#search-open'),
        $seachPanel= $('#claudia-search-panel')
        $buttonUpp = $('#upp-button');

    $(window).on('load', function() {

        $buttonOpenSearch.on('click', function() {
            $seachPanel.slideToggle('slow',function(){
                if( $seachPanel.is(':hidden')){
                    $buttonOpenSearch.find('img').attr('src',data.theme_path+'/assets/images/search.png');
                    $seachPanel.find('#s').blur();
                }else{
                    $seachPanel.find('#s').focus();
                    $buttonOpenSearch.find('img').attr('src',data.theme_path+'/assets/images/close.png');
                }
            });
            
        });

        
        $buttonUpp.on('click', function() {
            $('html,body').animate({ scrollTop: 0 }, 800);
        });


        $menuButton.on('click', function() {
            $menuMain.slideToggle();
        });

        adjustPanelWidgets($('#wpadminbar'));
    });

    function adjustPanelWidgets($bar) {

        if ($bar) {

            $('#widgets-panel').css('top', $bar.height());
        }
    }
})(jQuery);
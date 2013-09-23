jQuery(document).ready(function(){
    jQuery("#main-nav li, .nav li").hover(function() {
        jQuery(this).contents("ul.sub-menu, ul.children").stop(1,1).fadeIn('fast');
    
        jQuery(this).hover(function() {
        }, function(){
            jQuery(this).parent().find("ul.sub-menu, ul.children").fadeOut('fast');
        });
    });
    
    var menu = jQuery('.mobile-nav').find('div.f-dropdown').html();
    jQuery('.mobile-nav').find('div.f-dropdown').remove();
    jQuery('.mobile-nav').append(menu).find('ul').addClass('f-dropdown').attr('id', 'drop2');
    
});
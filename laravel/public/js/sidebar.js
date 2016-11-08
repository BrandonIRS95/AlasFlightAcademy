/**
 * Created by brandonirs on 8/11/16.
 */
$('#menu-icon').click(function () {
    var $nav = $('#nav');
    var $ghost = $('<div>', {id:'ghost-div'});
    $nav.css('display','inline');
    $('#master-container').append($ghost);
    $ghost.click(function () {
        $ghost.remove();
        TweenMax.to($nav, 0.4, {'left': '-200px', onComplete:function () {
            $nav.css({'display':'none','left': '0px'});
        }});
    });
    TweenMax.from($nav, 0.4, {'left': '-200px'});
});
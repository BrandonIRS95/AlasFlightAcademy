
/*Need add TweenMax.js script in your html to work*/

window.showModalAnimation = function showModalAnimation($modalElement, callback, callback2){
    var $modalContainer = $modalElement;
    var $modalWrapper = $modalElement.find('.modal-dialog');
    var $modal = $modalElement.find('.modal-content');
    $modalElement.modal();

    $modalElement.one("hide.bs.modal", function (e) {
        hideModalAnimation($modalElement, callback2);
        e.preventDefault();
    });

    TweenMax.set($modalWrapper, {perspective:500});
    TweenMax.set($modal, {transformStyle:"preserve-3d"});
    TweenMax.from($modal, 0.6, {scale: 0.5, rotationY:'0_short', opacity: 0, rotationX:'80_short', rotation:'0_short', transformOrigin: 'top 90% -600', onComplete: function(){
        typeof callback === 'function' && callback();
    }});

}

window.hideModalAnimation = function hideModalAnimation($modalElement, callback){
    var $background = $('.modal-backdrop');
    var $contentModal = $modalElement.find('.modal-content');
    TweenMax.set($('.modal-open .modal'), {overflowY: 'hidden'});
    TweenMax.to($contentModal, 0.6, {ease: Back.easeIn.config(1), opacity: 0, scale: 0.5, rotationY:'0_short', rotationX:'80_short', rotation:'0_short', transformOrigin: 'top 90% -870', onComplete: function(){
        TweenMax.set($('.modal-open .modal'), {overflowY: 'auto'});
        TweenMax.set($contentModal, {clearProps:"all"});
        $modalElement.modal('hide');
        typeof callback === 'function' && callback();
    }});
    TweenMax.to($background, 0.6, {opacity: 0});
}
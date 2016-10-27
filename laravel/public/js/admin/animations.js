
/*Need add TweenMax.js script in your html to work*/


window.showModalAnimation = function($modalElement, callback, callback2){
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

};

window.hideModalAnimation = function($modalElement, callback){
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
};

window.slideAndReturnAnimation = function($element, callback){
    TweenMax.to($element,0.2,{x: 100, opacity: 0, onComplete: function () {
        typeof callback === 'function' && callback();
        TweenMax.to($element, 0.2, {opacity: 1, x: 0});
    }});
};

window.animationForContentConteiner = function(){
    var $contentConteiner = $('#content-container');
    var $masterConteiner = $('#master-container');
    var duration = 0.6;

    var timeLine = new TimelineMax({onComplete: function () {
        $('#lastDaySelected').trigger('click');
        $contentConteiner.css('transform','');
        $contentConteiner.css('transform-style','');
        $masterConteiner.css('perspective','');
        $('body').css('overflow-y','auto');
    }});

    timeLine.set($masterConteiner, {perspective:800});
    timeLine.set($('body'), {overflowY:'hidden'});
    timeLine.set($contentConteiner, {transformStyle:"preserve-3d"});
    timeLine.from($contentConteiner, duration, {scale: 0.5, rotationY:'0_short', rotationX:'-80_short', rotation:'0_short', transformOrigin: 'top 0% -600'});
    timeLine.to($contentConteiner, duration, {opacity: 1}, 0);
};

window.loadingProcessAnimation = function()
{   
    var $airplaneSvg = $('<image class="airplaneLoadingProcess" src="'+ urlSvgImages + '/' + 'ic_airplanemode_active_white_48px.svg' + '"/>');
    var $backgroundAnimation = $('<div>', { class: 'backgroundModalProcess'});
    var $divAirplane = $('<div>', { class: 'conteinerAirplaneLoadingProcess'});
    var $divText = $('<div>', { class: 'textAirplaneLoadingProcess'});
    var $divModal = $('<div>', { class: 'modalAirplaneLoadingProcess'});
    var $body = $('body');

    var self = this;
    
    self.show = function(text){
        
        $divText.html(text + '...');

        $divAirplane.append($airplaneSvg);

        $divModal.append($divAirplane);
        $divModal.append($divText);

        $backgroundAnimation.append($divModal);

        $body.append($backgroundAnimation);

        TweenMax.to($divAirplane, 2, {rotation:360, repeat:-1, ease:Linear.easeNone});  
    };
    
    self.done = function(text, callback){
        var $doneSvg = $('<img>',{ src: urlSvgImages + '/' + 'ic_done_white_1024px.svg', class: 'doneAirplaneLoadingProcess'});
        var $btnDone = $('<button>', { class: "textAirplaneLoadingProcess doneProcessButton", html: text, style: 'top: 170px;'});
        $backgroundAnimation.css('cursor','pointer');
        $backgroundAnimation.click(function(){
            TweenMax.set($backgroundAnimation, {position: 'absolute'}); 
            TweenMax.to($backgroundAnimation, 0.2, {y: '-100%', ease: Power0.easeNone, onComplete: function () {
                $backgroundAnimation.remove();
            }});

            typeof callback === 'function' && callback();
        });
        
        TweenMax.to($divAirplane, 0.4, {autoAlpha: 0, ease:Linear.easeNone, onComplete: function(){
            $divModal.append($doneSvg);
            $divModal.append($btnDone);
            $divText.remove();
            TweenMax.from($doneSvg, 1, {scale: 0, rotation: 360});
        }});
    }
    
};

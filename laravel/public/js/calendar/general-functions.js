function showModal($content) {
    var $popupBackground = $("<div>", {id: "popup-background"});
    var day = localStorage.getItem('daySelected');
    var month = localStorage.getItem('monthSelected');
    var monthName = localStorage.getItem('monthNameSelected');
    var year = localStorage.getItem('yearSelected');
    
    
    
    
    $popupBackground.click(function(e){
        
        if (e.target.id != 'content-popup' && !$('#content-popup').find(e.target).length) {
        TweenMax.to($popupBackground, 0.2, {opacity: 0})
        TweenMax.to($content, 0.2, {height: 0, width:0, onComplete: function(){
            $popupBackground.remove();
        }});
    }
        
        
    });
    
    
    $popupBackground.append($content);
   
    
    $("body").append($popupBackground);
    $('#date-popup-add-flight').html(monthName.toUpperCase() + ' ' + day + ', ' + year);
    
     $('#select-time-flight').change(function(){
           var $contentAnimation = $('#animation-add-flight');
           var $sunDiv = $('<div>', {id: 'sun-div'});
           $contentAnimation.prepend($sunDiv);
            TweenMax.to($sunDiv, 1, {top: '-35px', ease: Elastic.easeOut });
            TweenMax.to($('#content-popup'), 5, {background: 'linear-gradient(to top, #A9E2F3, #2E9AFE)'});
       });
    TweenMax.set($("#content-popup"), {scale: 0});
    TweenMax.to($("#content-popup"), 0.2, {scale: 1});
    TweenMax.staggerFrom('.label-block', 0.2, {left: '600px', opacity: 0}, 0.1);
    TweenMax.to($("#plane-svg"), 2.5, {left: '50%', rotation: 0, delay: 0.2, ease: Elastic.easeOut.config(2.5, 1), onComplete: function(){
        var t1 = new TimelineLite({onComplete:function() {
        this.restart();}
        });
        
        t1.to($("#plane-svg"), 8, {rotation: 10, ease: Power0.easeNone});
        
        t1.to($("#plane-svg"), 4, {rotation: -10, ease: Power0.easeNone});  
        
        t1.to($("#plane-svg"), 4, {rotation: 0, ease: Power0.easeNone});  
        
    }});
    
    
}

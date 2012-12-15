jQuery(function( $ ){
  $.fn.animateProgress = function(progress, callback) {
    return this.each(function() {
      $(this).animate({
        width: progress+'%'
      }, {
        duration: 2000, 

        easing: 'swing',

        step: function( progress ){
          var labelEl = $('.ui-label', this),
              valueEl = $('.value', labelEl);

          if (Math.ceil(progress) < 20 && $('.ui-label', this).is(":visible")) {
            labelEl.hide();
          }else{
            if (labelEl.is(":hidden")) {
              labelEl.fadeIn();
            };
          }

          if (Math.ceil(progress) == 85) {
            labelEl.text('');
            /*setTimeout(function() {
              labelEl.fadeOut();
            }, 1000);*/
          }else{
            valueEl.text(Math.ceil(progress) + '%');
          }
        },
        complete: function(scope, i, elem) {
          if (callback) {
            callback.call(this, i, elem );
          };
        }
      });
    });
  };
});

jQuery(function($) {
  /*$('#progress_bar .ui-progress .ui-label').hide();
  $('#progress_bar .ui-progress').css('width', '7%');

  $('#progress_bar .ui-progress').animateProgress(43, function() {
    $(this).animateProgress(79, function() {
      setTimeout(function() {
        $('#progress_bar .ui-progress').animateProgress(85, function() {
          $('#main_content').slideDown();
        });
      }, 2000);
    });
  });*/

});
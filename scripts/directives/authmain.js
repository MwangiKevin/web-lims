  app.directive('authmain', function() {

    return {
      // restrict: 'C',
      link: function(scope, elem, attrs) {
        //once Angular is started, remove class:
        // elem.removeClass('waiting-for-angular');

        
        var login = elem.find('#login-holder');
        var main = elem.find('#content');
        
        // login.hide();
        // login.css('display','none','!important');
        login.attr('style','display:none !important');
        
        scope.$on('event:auth-loginRequired', function() {
          login.slideDown('slow', function() {
            // main.hide();            
            main.attr('style','display:none !important');
          });
        });
        scope.$on('event:auth-loginConfirmed', function() {
          main.show();
          login.slideUp('slow');
        });
      }
    }
  });
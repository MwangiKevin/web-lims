  app.directive('authmain', ['apiAuth', function(apiAuth ) {

    return {
      // restrict: 'C',
      link: function(scope, elem, attrs) {
        //once Angular is started, remove class:
        
        var login = elem.find('#login-holder');
        var main = elem.find('#content');
        
        login.attr('style','display:none !important');
        
        scope.$on('event:auth-loginRequired', function() {
          login.slideDown('slow', function() {           
            main.attr('style','display:none !important');
            // apiAuth.logout();
          });
        });
        scope.$on('event:auth-loginConfirmed', function() {
          main.show();
          login.slideUp('slow');
        });   
        scope.$on('event:auth-loginNotRequired', function() {
          main.show();
          login.slideUp('slow');
        });
      }
    }
  }]);
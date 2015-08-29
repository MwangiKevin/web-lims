<div class="container ui stackable center aligned page grid">
	<br/>
  	<h1>Change password</h1>
  	<div class="ui form segment column nine wide" id = "form" style="background-color: #00b5ad;margin-top:35px;margin-bottom:35px;border-radius:0.2857rem;">
    	<h1><img src="<?php echo base_url('assets/images/nascop.jpg');?>" height="80"  alt="" style="z-index: -50;border-radius:0.2857rem;"></h1>

    	<div class="ui inverted dimmer" ng-class="{true: 'active', false: 'disabled'}[loading]">
      		<div class="ui text loader">Registering you now :)</div>
    	</div>
   	 	<div class="field">
      		<label for="Password">Choose a new Password</label>
      		<div class="ui icon input">
        		<input id="Password" type="password" ng-model="user.password">
        		<i class="asterisk red icon"></i>
      		</div>
    	</div>

    	<div class="field">
      		<label for="PasswordConfirm">Confirm your Password </label>
      		<input id="PasswordConfirm" type="password" ng-model="user.passwordConfirm">
    	</div>

    	<button class="ui blue button" ng-click="register()">Submit</button>

    	<div class="ui error message"></div>
  </div>

</div>


<script>

(function ($) {
  $('.ui.form').form({   
    password: {
      identifier: 'Password',
      rules: [{
        type: 'empty',
        prompt: 'Please enter a password'
      }, {
        type: 'length[6]',
        prompt: 'Password needs to be atleast 6 characters long'
      }]
    },
    passwordConfirm: {
      identifier: 'PasswordConfirm',
      rules: [{
        type: 'match[Password]',
        prompt: 'Password don\'t match'
      }]
    }
  }, {
    on: 'blur'
  });
}(jQuery));



</script>
<!-- <div class="container ui one column stackable center aligned page grid" > 
  <h1>Register Now</h1>

  <div class="ui form segment column nine wide" style="background-color: #00b5ad;margin-top:35px;margin-bottom:35px;border-radius:0.2857rem;">   
    <h1><img src="<?php echo base_url('assets/images/nascop.jpg');?>" height="80"  alt="" style="z-index: -50;border-radius:0.2857rem;"></h1>
    <div class="two fields">
      <div class="field">
        <label for="GivenName">Given Name</label>
        <input id="GivenName" placeholder="Given Name" type="text" />
      </div>

      <div class="field">
        <label for="Surname">Surname</label>
        <input id="Surname" placeholder="Surname" type="text">
      </div>
    </div>

    <div class="field">
      <label for="Email">Email</label>
      <input id="Email" placeholder="Email" type="text">
    </div>

    <div class="field">
      <label for="Username">Username</label>
      <input id="Username" placeholder="Username" type="text">
    </div>

    <div class="field">
      <label for="Password">Password</label>
      <input id="Password" type="password">
    </div>

    <div class="field">
      <label for="PasswordConfirm">Password Confirm</label>
      <input id="PasswordConfirm" type="password">
    </div>

    <button class="ui blue button">Submit</button>
  </div>    
</div>
 -->
 <div class="container">

    <h1>Register Now</h1>

    <div class="ui form segment" id = "form">
      
      <div class="ui inverted dimmer" ng-class="{true: 'active', false: 'disabled'}[loading]">
        <div class="ui text loader">Registering you now :)</div>
      </div>

      <div class="two fields">
        <div class="field">
          <label for="GivenName">Given Name</label>
          <div class="ui icon input">
            <input id="GivenName" placeholder="Given Name" type="text" ng-model="user.givenname">
            <i class="asterisk red icon"></i>
          </div>
        </div>

        <div class="field">
          <label for="Surname">Surname</label>
          <div class="ui icon input">
            <input id="Surname" placeholder="Surname" type="text" ng-model="user.surname">
            <i class="asterisk red icon"></i>
          </div>
        </div>
      </div>

      <div class="field">
        <label for="Email">Email</label>
        <div class="ui icon input">
          <input id="Email" placeholder="Email" type="text" ng-model="user.email">
          <i class="asterisk red icon"></i>
        </div>
      </div>

      <div class="field">
        <label for="Username">Username</label>
        <div class="ui icon input">
          <input id="Username" placeholder="Username" type="text" ng-model="user.username">
          <i class="asterisk red icon"></i>
        </div>
      </div>

      <div class="field">
        <label for="Password">Password</label>
        <div class="ui icon input">
          <input id="Password" type="password" ng-model="user.password">
          <i class="asterisk red icon"></i>
        </div>
      </div>

      <div class="field">
        <label for="PasswordConfirm">Password Confirm</label>
        <input id="PasswordConfirm" type="password" ng-model="user.passwordConfirm">
      </div>

      <button class="ui blue button" ng-click="register()">Submit</button>

      <div class="ui error message"></div>
    </div>

  </div>


  <script>

    (function ($) {
      $('.ui.form').form({
        givenName: {
          identifier: 'GivenName',
          rules: [{
            type: 'empty',
            prompt: 'Please enter your given name'
          }]
        },
        surname: {
          identifier: 'Surname',
          rules: [{
            type: 'empty',
            prompt: 'Please enter your surname'
          }]
        },
        username: {
          identifier: 'Username',
          rules: [{
            type: 'empty',
            prompt: 'Please enter a username'
          }]
        },
        email: {
          identifier: 'Email',
          rules: [{
            type: 'empty',
            prompt: 'Please enter your email'
          }, {
            type: 'email',
            prompt: 'Please enter a valid email'
          }]
        },
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

    // function RegisterController($scope, $element) {

    // }

  </script>
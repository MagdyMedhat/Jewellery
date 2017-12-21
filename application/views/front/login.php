

<section id="content" class="container_16">
  <div id="acloginpod">
    <ul>
      <li><a href="#tabsl-1">Login</a></li>
    </ul>
    <div class="acloginform">
      <div id="tabsl-1">
        <form method="post" action="<?php echo site_url() . "web/login"; ?>">
          <fieldset>
            <label for="username">Username:</label>
            <input type="text" value="" name="username" id="username" class="username textinput">
            <label for="ac_password">Password:</label>
            <input type="password" name="password" id="ac_password" class="password textinput">
              <a href="<?php echo site_url() . "web/register"; ?>" class="forgotpass">Register</a>
              <!--<a href="<?php echo site_url() . "web/forgot_password"; ?>" class="forgotpass">Forgot your password?</a> -->
            <div class="aclogin-action">

                <div class="fl">
              <input type="image" name="submit" value="submit" title="Login" alt="Login" src="<?php echo site_url() . "includes/"; ?>images/transparent.gif" class="acloginbttn">
              <div class="clearfix">&nbsp;</div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    // login tabs
    $("#acloginpod").tabs();
	// watermark
	$('input.username').watermark('Username');
	$('input.password').watermark('Password');
	$('input.email').watermark('Email Address');
    </script> 
</section>

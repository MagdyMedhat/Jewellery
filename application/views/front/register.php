<section id="content" class="container_16">
  <div id="acloginpod">
    <ul>
      <li><a href="#tabsl-2">Register</a></li>
    </ul>
    <div class="acloginform">
      <div id="tabsl-2">
        <form method="post" action="<?php echo site_url() . "web/register"; ?>">
          <fieldset>
            <label for="reg_username">Username:</label>
            <input type="text" name="username" value="" name="reg_username" id="username" class="username textinput">
            <label for="reg_password">Password:</label>
            <input type="password" name="password" id="reg_password" class="password textinput">
            <label for="reg_email">Email:</label>
            <input type="text" name="email" id="reg_email" class="email textinput">
            <div class="aclogin-action">
              <input type="image"  name="submit" value="submit" title="Register" alt="Register" src="<?php echo site_url() . "includes/"; ?>images/transparent.gif" class="registerpodbttn">
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

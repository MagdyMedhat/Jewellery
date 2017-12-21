<section id="content" class="container_16">
  <div id="acloginpod">
    <div class="acloginform">
      <form method="post" action="">
        <input type="hidden" value="home.mt" id="redirect" name="redirect">
        <fieldset>
          <label for="username">Username:</label>
          <input type="text" tabindex="2" value="example" name="username" id="username" class="textinput">
          <label for="ac_password">Password:</label>
          <input type="password" tabindex="3" value="exampleexample" name="password" id="ac_password" class="textinput">
          <label for="country">Country:</label>
          <select id="country" name="country">
            <option value="0">Egypt</option>
            <option value="1">USA</option>
            <option value="2">Isreal</option>
            <option value="3">Libya</option>
            <option value="4">Canda</option>
            <option value="5">Sudan</option>
            <option value="6">Syria</option>
          </select>
          <div class="row">
            <label for="hasCar">Has car:</label>
            <input type="radio" checked name="hasCar" value="radio" id="car_0">
            Yes
            <input type="radio" name="hasCar" value="radio" id="car_1">
            No</div>
          <div class="aclogin-action">
            <input type="image" tabindex="7" title="edit" alt="edit" src="<?php echo site_url() . "includes/"; ?>images/transparent.gif" class="editpodbttn">
            <div class="clearfix">&nbsp;</div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</section>

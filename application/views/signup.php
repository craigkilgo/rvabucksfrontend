


<div class="section">
<div class="container">
  <form action="<?php echo base_url()?>welcome/signedup" method="post" id="form">
  <div class="box">
    <div class="columns">
      <div class="field">
        <label class="label">Name</label>
        <div class="control">
          <input class="input" name="name" type="text" placeholder="Full name">
        </div>
      </div>
  </div>
  <div class="columns">
    <div class="field">
      <label class="label">Username</label>
      <div class="control has-icons-left has-icons-right">
        <input class="input is-success" name="username" type="text" placeholder="Text input" value="username">
        <span class="icon is-small is-left">
          <i class="fas fa-user"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="fas fa-check"></i>
        </span>
      </div>
      <!--<p class="help is-success">This username is available</p>-->
    </div>
</div>

  <div class="columns">
    <div class="field">
      <label class="label">Email</label>
      <div class="control has-icons-left has-icons-right">
        <input class="input" name="email" id="email" type="email" placeholder="Email input" value="hello@">
        <span class="icon is-small is-left">
          <i class="fas fa-envelope"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
      </div>
      <p id="emailWarning" class="help is-danger">This email is invalid</p>
    </div>
</div>

  <div class="columns">
    <div class="field">
      <label class="label">Password</label>
      <div class="control has-icons-left has-icons-right">
        <input name="pass" class="input p" type="password" id="pass" placeholder="Password">
        <span class="icon is-small is-left">
          <i class="fas fa-envelope"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
      </div>
    </div>
</div>
<br>
  <div class="columns">
    <div class="field">
      <label class="label">Confirm Password</label>
      <div class="control has-icons-left has-icons-right">
        <input class="input p" type="password" id="pass2" placeholder="Confirm Password">
        <span class="icon is-small is-left">
          <i class="fas fa-envelope"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="fas fa-exclamation-triangle"></i>
        </span>
      </div>
    </div>
</div>

<!--
<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox" name="agree">
      I agree to the <a href="#">terms and conditions</a>
    </label>
  </div>
</div>-->


<div class="field is-grouped">
  <div class="control">
    <button class="button is-link" type="submit" id="submit" disabled>Submit</button>
  </div>
  <div class="control">
    <a href="<?php echo base_url()?>" class="button is-text">Cancel</a>
  </div>
</div>

</div>
</div>
</div>
<script>

$(document).ready(function(){

  function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        // alert( pattern.test(emailAddress) );
        return pattern.test(emailAddress);
    };

$('#email').keyup(function() {
if(isValidEmailAddress($(this).val())){
  $('#emailWarning').css('color','white');
}else{
  $('#emailWarning').css('color','red');
}

});

  $( ".p" ).keyup(function() {
    console.log('key');
    if($('#pass').val() == $('#pass2').val()){
      $('#submit').prop("disabled",false);
    }else{
      $('#submit').prop("disabled",true);
    }
  });
});
</script>
</body>
</html>
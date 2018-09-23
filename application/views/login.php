<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - RVA Bucks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.1-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/login.css">

        <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>

</head>

<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">

                    <img src="https://rvabucks.io/img/logo2.png">
                    <?php
                    if(is_null($error)){

                    }else{
                        echo '<article id="errmessage" class="message is-danger">
                        <div class="message-header">
                          <p>Error</p>
                          <button id="delete" class="delete" aria-label="delete"></button>
                        </div>
                        <div class="message-body">
                          ';
                          echo $error;
                          echo '
                        </div>
                      </article>';
                    }

                    ?>
                    <div class="box">
                        
                        
                            <div id="loginDiv">
                                <a id="loginBtn" class="button is-block is-warning is-large is-fullwidth">Login</a>
                            </div>
                            <div id="loginBox" hidden>
                                    <form action="<?php echo base_url()?>welcome/attemptLogin" method="post">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input is-large" name="email" type="email" placeholder="Your Email" autofocus="">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input class="input is-large" type="password" name="pass" placeholder="Your Password">
                                        </div>
                                    </div>
                                    <button class="button is-block is-warning is-large is-fullwidth">Submit</button>
                                </form>

                            </div>
                            <br>
                            <a href="<?php echo base_url()?>welcome/signup" class="button is-block is-warning is-large is-fullwidth">Sign Up</a>
                        
                    
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){

            $('#loginBtn').on('click touchstart',function(){
                $('#loginDiv').hide();
                $('#loginBox').show();
            });
            $('#delete').on('clicl touchstart', function(){
                $('#errmessage').hide();
            });


        });
    </script>
</body>

</html>
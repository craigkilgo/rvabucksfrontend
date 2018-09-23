<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RVA Bucks</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
    <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase.js"></script>-->
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script type="text/javascript" src="https://identity-sandbox.capitalone.com/c1-identity-buttons/js/script.min.js"></script>
<style>
.levelContainer{
    width: 100%;
    background-color:#ddd; 
}
.exp
{
    width:10%;
    background-color: green;
}
#LevelStiff,#expP
{
    display: inline;
}
#bigContainer
{
    text-align: center;
}
</style>
<script type="text/javascript">
/*
    var config={
    apiKey:"AIzaSyC5EuoydXwtQjjibe0e093t_fvfZaOnnwY",
    authDomain: "rvabucks.firebaseapp.com",
    databaseURL: "https://rvabucks.firebaseio.com",
    storageBucket: "rvabucks.appspot.com"
};
var globalUserName="Yousef";
var userData;
 firebase.initializeApp(config);
var defaultDatabase=firebase.database();
function newUser(userId,password)
{
    firebase.database().ref('users/'+userId).set({ID:userId,EXP:0,TIER:1,PASSWORD:"dummypass",BALANCE:0});
    globalUserName=userId;

}
function changeBalance(quantity)
{
    var balanceRef= firebase.database().ref("users");
    var balance=0;
    firebase.database().ref('/users/'+globalUserName).once("value").then(function(snapshot){
        balance=snapshot.val().BALANCE;
        var id=snapshot.val().ID;
        var exp=snapshot.val().EXP;
        var tier=snapshot.val().TIER;
        var password=snapshot.val().PASSWORD;
        var fullname= snapshot.val().FULLNAME;

        console.log(balance);

        var newBalance=balance+quantity;
        var postData={ID:id,EXP:0,TIER:1,PASSWORD:"dummypass",BALANCE:newBalance,FULLNAME:fullname};
    var updates={};
    updates['/'+globalUserName+'/']=postData;
    firebase.database().ref('users').update(updates);

    });
    
}
function changeExp(newexp)
{
    var expRef= firebase.database().ref("users");
    var exp=0;
    firebase.database().ref('/users/'+globalUserName).once("value").then(function(snapshot){
        exp=snapshot.val().EXP;
        var id=snapshot.val().ID;
        var balance=snapshot.val().BALANCE;
        var tier=snapshot.val().TIER;
        var password=snapshot.val().PASSWORD;
        var fullname= snapshot.val().FULLNAME;
        console.log(balance);

        var updatedEXP=exp+newexp;
        if(updatedEXP>10)
        {
            tier+=Math.floor(updatedEXP/10);
            updatedEXP=updatedEXP%10;
            var postData={ID:id,EXP:updatedEXP,TIER:tier,PASSWORD:"dummypass",BALANCE:balance,FULLNAME:fullname};
        }
        else{
        var postData={ID:id,EXP:updatedEXP,TIER:1,PASSWORD:"dummypass",BALANCE:balance,FULLNAME:fullname};
    }
    var updates={};
    updates['/'+globalUserName+'/']=postData;
    firebase.database().ref('users').update(updates);

    });
}
function returnUserJSON()
{
firebase.database().ref('users/'+globalUserName).once("value").then(function(snapshot){
userData=snapshot.val();
console.log(userData);
updateUI();
});
}
function updateUI()
{
document.getElementById("money").innerHTML="$"+userData.BALANCE;
document.getElementById("Full Name").innerHTML=userData.FULLNAME;
document.getElementById("username").innerHTML=userData.ID;



}
*/
console.log(`<?php var_dump($session)?>`);
function loadLevel()
{
    var level=<?php echo $session['level']?>;
    var exp=<?php echo $session['exp']?>;

    var expWidth= (exp*10)+"%";
    document.getElementById('expBar').style.width=expWidth;
}
</script>

<!--
    <div class="navbar is-inline-flex is-transparent">
        <div class="navbar-brand">
            <a class="navbar-item">
                
            </a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-item">
                <div class="control has-icons-left">
                    <input class="input is-small has-text-centered" type="text" placeholder="search">

                </div>
            </div>
        </div>
        <div class="navbar-item is-flex-touch">
            <a class="navbar-item">
                <i class="material-icons">person_outline</i>
			</a>
			<a class="navbar-item" href="<?php echo base_url()?>welcome/logout">
				<i class="material-icons">
				power_settings_new
				</i>
			</a>
        </div>
    </div>
-->

    <div class="columns body-columns">
        <div class="column is-half is-offset-one-quarter">
            <div id="notification"></div>

            <div class="card">
                <div class="header">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                    <i class="material-icons">person_outline</i>
                            </figure>
                        </div>
                        <div class="media-content">
                            <p id="FullName" class="title is-4"><?php echo $session['name']?></p>
                            <p id="username" class="subtitle is-6" >@<?php echo $session['username']?></p>
                            <div id="bigContainer">
                            <p id="LevelStiff" class="title is-4"><?php echo $session['level']?>
</p>
<div class="levelContainer" >                                                        <div class="exp" id="expBar">  <p id="expP" class="subtitle is-6" ><?php echo $session['exp']?>XP</p></div>
    <script type="text/javascript">
        loadLevel();
    </script>
</div></div>

                        </div>
                    </div>
                </div>

                <div class="card-content">

                <?php


                if($session['verified']==1){
                    echo '
                    <div id="money" class="money">$<span id="moneyAmt">0.00</span></div>
                  <div class="field has-addons" id="largeButtonGroup">
                        <p class="control">
                            <a id="paybucks" class="button is-large is-warning is-outlined">
                                <span style="color:black;">Send</span>
                            </a>
                        </p>
                        <p class="control">
                            <a id="getbucks" class="button is-large is-warning is-outlined">
                                <span style="color:black;">Buy</span>
                            </a>
                        </p>
                        <p class="control">
                            <a id="makecharge" class="button is-large is-warning is-outlined">
                                <span style="color:black;">Receive</span>
                            </a>
                        </p>
                    </div>';
                    }else{
                        echo '<p class="control">Please verify your identity with Capital One before depositing.</p>';
                        $curl = curl_init();
                        $api_url = 'https://api-sandbox.capitalone.com/identity/proof/tools/web-button?redirectURI=https://rvabucks.io/prove/identity';
                        $api_token = 'Authorization: Bearer eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwicGNrIjoxLCJhbGciOiJkaXIiLCJ0diI6Miwia2lkIjoicjRxIn0..H6Sw1a5Ljq8oUoTDAwU8EA._ZpzOJF4sldE310Nw8DIR26wcbRYps1s5uYUcco6kJomL3FFCpkjVoyj9I4QG1J_J6qiqD_D6meEhkyAC3f32ly1IZwo8aOhP_K20SvgBq0sS7E6a2VDwv0X1SuB3jtxNQ2QAxGYXKFUmSwD0Jnxaieeo2HXS4pGnAICAOdToF7KPIZOck6d7QQU_6pLOnlGAqzwtyW_OZx2TlQ_8woZaNwVCJJR3-PXo-y2e3KN9TcQ6mYMolI_X01I-iW7R81W1q4zrB0oYbmYAwQkwrjOZfQRXnTmoyEVRLka6hNkHBs.5XMYzb_zyyM5f6YYUlUEtg';

                        curl_setopt_array($curl, array(
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_URL => $api_url,
                            CURLOPT_HTTPHEADER => array(
                            $api_token,'Accept: text/html;v=1','Correlation-Id: ccid'.$session['id']
                            )
                        ));

                        $result = curl_exec($curl);
                        echo $result;
                    }
                    ?>

                    <div id="moneyDiv" hidden>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button dollar is-large is-warning is-outlined" data-amount="10">
                                <span style="color:black;">$10</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button dollar is-large is-warning is-outlined" data-amount="20">
                                <span style="color:black;">$20</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button dollar is-large is-warning is-outlined" data-amount="50">
                                <span style="color:black;">$50</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button dollar is-large is-warning is-outlined" data-amount="100">
                                <span style="color:black;">$100</span>
                                </a>
                            </p>
                            </div>
                            <br>
                            <div class="field">
                                <div class="control">
                                <input id="amount" class="input is-large" type="number" placeholder="$">
                                </div>
                            </div>
                            <a id="buy" class="button is-large"><i class="material-icons">
credit_card
</i> &nbsp;Buy Bucks with Card</a>

                    </div>
                </div>
            </div>



            <footer class="footer">
                <div class="container is-fluid">
                    <div class="content has-text-centered">
                        <p>
                            <span style="color:#ffba00;">RVABucks</span> by
                            Yousef, Craig, Chris, Robert<br>
                           <a href="https://rvabucks.io/welcome/logout"><i class="material-icons">
                            power_settings_new
                            </i></a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

<div class="modal" id="modal">
<div class="modal-background"></div>
  <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Username or Token</p>
        <button id="deleteModal" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <input class="input" type="text" name="username" id="payUsername" placeholder="@john"><br>
            <input style="margin-top:5px;" name="amount" id="payAmount" class="input" type="number" placeholder="$0"><br>
            or<br>
            <input class="input" name="chargestring" type="text" id="payChargeString" placeholder="Charge token">
            
        </section>
        <footer class="modal-card-foot">
            <button id="payuserBtn" class="button is-warning">Pay</button>
            <button id="modalCancel" class="button">Cancel</button>
        </footer>
  </div>
</div>
<div class="modal" id="modal1">
    <div class="modal-background"></div>
    <div class="modal-card">
            <header class="modal-card-head">
            <p class="modal-card-title">Create Charge</p>
            <button id="deleteModal2" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
            <div class="field has-addons">
                            <p class="control">
                                <a class="button dollar2 is-large is-warning is-outlined" data-amount="10">
                                <span style="color:black;">$10</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button dollar2 is-large is-warning is-outlined" data-amount="20">
                                <span style="color:black;">$20</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button dollar2 is-large is-warning is-outlined" data-amount="50">
                                <span style="color:black;">$50</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button dollar2 is-large is-warning is-outlined" data-amount="100">
                                <span style="color:black;">$100</span>
                                </a>
                            </p>
                            </div>
                            <br>
                            <div class="field">
                                <div class="control">
                                <input id="amount2" class="input is-large" type="number" placeholder="$">
                                </div>
                            </div>
                            <button id="generateqr" class="button is-warning">Generate</button><br>
                            <img id="qr"><br>
                            <span id="chargeToken"></span>
            </section>
            <footer class="modal-card-foot">
            
            <button id="modalCancel2" class="button">Cancel</button>
            </footer>
    </div>
</div>

    <script>
             function updateBalance(){
            var formData1 = new FormData();
            formData1.append('id',<?php echo $session['id']?>);
            var fetchData = {
                            method: 'POST',
                            body: formData1,
                            headers: new Headers()
                        };
                        fetch('<?php echo base_url()?>api/balance', fetchData) // Call the fetch function passing the url of the API as a parameter
                        .then((resp) => resp.json()) // Transform the data into json
                        .then(function(data) {
                            console.log(data);
                            if(data.amount==null){
                                data.amount = 0;
                            }
                            var money = parseFloat(data.amount) / 100.00;
                            $('#moneyAmt').html(parseFloat(money));

                            
                        })
                        .catch(function(error) {
                            // This is where you run code if the server returns any errors
                            console.log(error);
                            
                        });

                    }
    $(document).ready(function(){
        $('#notification').on('click touchstart', '*', function() {

                $('#notification').html('');
            
        });
        console.log('line 360');
        $('#payuserBtn').on('click touchstart',function(){
            var payData = new FormData();
                payData.append('id',<?php echo $session['id']?>);
                payData.append('amount',$('#payAmount').val()*100);
                payData.append('username',$('#payUsername').val());
                payData.append('chargestring',$('#payChargeString').val());

                var fetchData3 = {
                            method: 'POST',
                            body: payData,
                            headers: new Headers()
                        };
                        fetch('<?php echo base_url()?>api/payuser', fetchData3) // Call the fetch function passing the url of the API as a parameter
                        .then((resp) => resp.json()) // Transform the data into json
                        .then(function(data) {
                            console.log(data);
                            var amount = data.amount / 100;
                            $('#modal').removeClass('is-active');
                            var string = `
                            <div class="notification is-success">
                            <button class="delete not-delete"></button>
                                You have successfully paid `+data.payee+` $`+amount+`.
                            </div>
                            `;
                            
                            $('#notification').html(string);
                            updateBalance();
                        })
                        .catch(function(error) {
                            // This is where you run code if the server returns any errors
                            console.log(error);
                            
                        });
        });
        console.log('line 394');
                    updateBalance();
        $('#generateqr').on('click touchstart',function(){
            var qrData = new FormData();
                qrData.append('id',<?php echo $session['id']?>);
                qrData.append('amount',$('#amount2').val()*100);

                var fetchData2 = {
                            method: 'POST',
                            body: qrData,
                            headers: new Headers()
                        };
                        fetch('<?php echo base_url()?>api/makecharge', fetchData2) // Call the fetch function passing the url of the API as a parameter
                        .then((resp) => resp.json()) // Transform the data into json
                        .then(function(data) {
                            //console.log('qr: '+data.string);
                            $('#amount2').val('');
                            $('#qr').attr("src","<?php echo base_url()?>api/qr/"+data.string);
                            $('#chargeToken').html(data.string);
                        })
                        .catch(function(error) {
                            // This is where you run code if the server returns any errors
                            console.log(error);
                            
                        });
        });

        $('.dollar').on('click touchstart',function(){
            $('#amount').val($(this).data('amount'));
            console.log($(this).data('amount'));

        });
        $('.dollar2').on('click touchstart',function(){
            $('#amount2').val($(this).data('amount'));
            //console.log($(this).data('amount'));

        });

        $('#getbucks').on('click touchstart',function(){
            $('#moneyDiv').show();
        });
        $('#paybucks').on('click touchstart',function(){
            $('#modal').addClass('is-active');
        });
        $('#makecharge').on('click touchstart',function(){
            $('#modal1').addClass('is-active');
        });
        $('#deleteModal').on('click touchstart',function(){
            $('#modal').removeClass('is-active');
        });
        $('#modalCancel').on('click touchstart',function(){
            $('#modal').removeClass('is-active');
        });
        $('#deleteModal2').on('click touchstart',function(){
            $('#modal1').removeClass('is-active');
        });
        $('#modalCancel2').on('click touchstart',function(){
            $('#modal1').removeClass('is-active');
        });
    });

            var handler = StripeCheckout.configure({
                key: 'pk_test_bgzUBYXNQPahwbpSrniKG9ad',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                billingAddress: true,
                shippingAddress: true,
                token: function(token,address) {
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.

                    var description2 = 'RVA Bucks';


                        //console.log(token.id);
                        //var url = 'https://80w3ax0wv0.execute-api.us-east-1.amazonaws.com/prod/charge';
                        //var url = 'https://060j2bl9wd.execute-api.us-east-1.amazonaws.com/prod/charge';
                        
                        var url = '<?php echo base_url()?>api/charge';
                        // The data we are going to send in our request
                       /* var data = {
                            amount: $('#amount').val() * 100,
                            currency: 'usd',
                            stripeToken: token.id,
                            description: description2,
                            email: '<?php echo $session['email']?>'
                        }*/
                        var formData = new FormData();
                        formData.append('amount',parseFloat($('#amount').val() * 100)*0.95);
                        formData.append('currency','usd');
                        formData.append('stripeToken','tok_visa');
                        formData.append('description',description2);
                        formData.append('email','<?php echo $session['email']?>');
                        formData.append('uid','<?php echo $session['id']?>');
                        formData.append('full_amount',$('#amount').val() * 100);

                       /*var toUrlEncoded = function toUrlEncoded(obj) {
                            return Object.keys(obj).map(function (k) {
                                return encodeURIComponent(k) + '=' + encodeURIComponent(obj[k]);
                            }).join('&');
                            };*/

                        //var urlEncodeData = $.param(data);
                        // The parameters we are gonna pass to the fetch function
                        //console.log("url encoded = "+toUrlEncoded);

                        var fetchData = {
                            method: 'POST',
                            body: formData,
                            headers: new Headers()
                        };
                        fetch(url, fetchData) // Call the fetch function passing the url of the API as a parameter
                        .then(function() {
                            // Your code for handling the data you get from the API
                            $('#moneyDiv').hide();
                            updateBalance();
                        })
                        .catch(function(error) {
                            // This is where you run code if the server returns any errors
                            //console.log(error);
                            //document.getElementById("box").innerHTML('Something went wrong...  Refresh and try again?');
                            updateBalance();
                        });

                            }
                            });

                            document.getElementById('buy').addEventListener('click', function(e) {
                              var descript = 'RVA Bucks';


                              // Open Checkout with further options:
                              handler.open({
                                name: '',
                                description: descript,
                                amount: parseFloat($('#amount').val() * 100)*0.95,
                                email: '<?php echo $session['email']?>',
                                name: '<?php echo $session['name']?>',
                              });
                              e.preventDefault();
                            });



                            // Close Checkout on page navigation:
                            window.addEventListener('popstate', function() {
                              handler.close();
                            });

    </script>
</body>

</html>
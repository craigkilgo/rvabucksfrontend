<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RVA Bucks</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.1-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
    <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase.js"></script>
<script type="text/javascript">
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
</script>
    <style>
    
    .navbar {
    position: fixed;
    left: 0;
    top: 0;
    z-index: 2;
    background-color: white;
    justify-content: space-around;
    width: 100%;
    border-bottom: 1px solid lightgray;
}
.navbar-menu {
    flex-grow: 0.5;
    justify-content: center;
}
.navbar-menu .navbar-item {
    flex-grow: 1;
    justify-content: center;
}
.navbar-menu .navbar-item .control {
    width: 50%;
}
.body-columns {
    margin-top: 10vh;
}
.card {
    margin-top: 5rem;
}
.card .header {
    padding: 5px 10px;
}
.card-footer .columns {
    width: 100%;
}
.card-footer .columns input {
    border: none;
    border-radius: 0;
    box-shadow: none;
}
.card-footer .columns .column:last-child {
    display: flex;
    align-items: center;
}
.card-footer .columns .column:last-child button {
    border: none;
}
.footer {
    margin-top: 10vh;
    padding: 2rem 1.5rem;
}

/* @media screen and (max-width: 786px){
    .navbar {
        justify-content: space-between;
    }
} */
.money{
    font-size:400%;
    font-weight:bold;
}

</style>

</head>

<body onload="returnUserJSON()">
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
    <div class="columns body-columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="card">
                <div class="header">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                    <i class="material-icons">person_outline</i>
                            </figure>
                        </div>
                        <div class="media-content">
                            <p id="Full Name" class="title is-4">John Smith</p>
                            <p id="username" class="subtitle is-6">@johnsmith</p>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <div id="money" class="money">$10.00</div>

                    <a style="margin-right:20px;" class="button is-large is-info">Pay</a><a class="button is-info is-large">Deposit</a>
                </div>

            </div>




            <footer class="footer">
                <div class="container is-fluid">
                    <div class="content has-text-centered">
                        <p>
                            <strong>RVABucks</strong> by
                            Yousef, Craig, Chris, Robert
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
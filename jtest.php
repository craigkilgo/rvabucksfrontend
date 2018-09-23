hi
<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
<script>
$(document).ready(function(){


                        var url = 'https://rvabucks.io/api/charge';
                        // The data we are going to send in our request
                        /*var data = {
                            amount: 10 * 100,
                            currency: 'usd',
                            stripeToken: 'tok_visa',
                            description: 'something',
                            email: 'me@apple.com'
                        }*/
                        var formData = new FormData();
                        formData.append('amount',10000);
                        formData.append('currency','usd');
                        formData.append('stripeToken','tok_visa');
                        formData.append('description','something');
                        formData.append('email','me@apple.com');

                        //var urlEncodeData = $.param(data);
                        // The parameters we are gonna pass to the fetch function
                        //console.log("url encoded = "+toUrlEncoded);

                        var fetchData = {
                            method: 'POST',
                            body: formData,
                            headers: new Headers()
                        };
                        fetch(url, fetchData) // Call the fetch function passing the url of the API as a parameter
                        .then(function(results) {
                            // Your code for handling the data you get from the API
                            console.log(results);
                        })
                        .catch(function(error) {
                            // This is where you run code if the server returns any errors
                            //console.log(error);
                            document.getElementById("box").innerHTML('Something went wrong...  Refresh and try again?');
                        });

                       


                        });
</script>
$(document).ready(function() {

    // process the form
    $('form.add_stuff').submit(function(event) {
        var that = $(this);
        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            "name" 	    : $(this).find('input[name=name]').val(),
            "foods" 	: $(this).find('input[name=foods]').val(),
            "drinks" 	: $(this).find('input[name=drinks]').val(),
            'tkid'      : tkid,
            'type'      : $(this).data('type')
        };

        // process the form
        $.ajax({
            type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url 		: 'add.php', // the url where we want to POST
            data 		: formData, // our data object
            dataType 	: 'json', // what type of data do we expect back from the server
            encode 		: true
        })
        // using the done promise callback
        .done(function(data) {

            // log data to the console so we can see
            console.log(data);

            // here we will handle errors and validation messages
            if ( ! data.success) {

                // handle errors for name ---------------
                if (data.errors.name) {
                    $('#name-group').addClass('has-error'); // add the error class to show red input
                    $('#name-group').append('<div class="help-block">' + data.errors.name + '</div>'); // add the actual error message under our input
                }

                // handle errors for email ---------------
                if (data.errors.foods) {
                    $('#foods-group').addClass('has-error'); // add the error class to show red input
                    $('#foods-group').append('<div class="help-block">' + data.errors.foods + '</div>'); // add the actual error message under our input
                }

                // handle errors for superhero alias ---------------
                if (data.errors.drinks) {
                    $('#drinks-group').addClass('has-error'); // add the error class to show red input
                    $('#drinks-group').append('<div class="help-block">' + data.errors.drinks + '</div>'); // add the actual error message under our input
                }

            } else {

                // ALL GOOD! just show the success message!
                that.append('<div class="alert alert-success">' + data.message + '</div>');
                that.reset();

                // usually after form submission, you'll want to redirect
                // window.location = '/thank-you'; // redirect a user to another page

            }
        })

        // using the fail promise callback
        .fail(function(data) {

            // show any errors
            // best to remove for production
            console.log(data);
        });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
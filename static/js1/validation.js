// src="https://jqueryvalidation.org/files/lib/jquery.js";
// src="https://code.jquery.com/jquery-3.6.3.js" ;
// // integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" 
// // rossorigin="anonymous";
// src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js";

src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js";
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js";

    
$(document).ready(function()
{
    
    $('#signupform').validate({
        rules:{
            fname:{
                required:true,
                minlength:3
            },
            lname:{
                required:true,
                minlength:3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            cpassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            mob:{
                required:true,
                minlength:10,
                maxlength:13
            }
        }
    });
})
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/signup.css">
    <title>Signup</title>
    <!-- <script src="static/js/validation.js"></script> -->
</head>

<body>
<div id="backgroundimage"></div>
    <div class="container">
        <form action="signup" method="post" id="signupform">
            <?= csrf_field() ?>
            <div class="form-body">
                <label for="Signup">
                    <h1>Signup Here</h1>
                </label>
                <div>
                    <label for="fname">First Name <sup>*</sup></label>
                    <div class="inputbox"><input type="text" name="fname" id="fname" ></div>
                </div>
                <div>
                    <label for="lname">Last Name <sup>*</sup></label>
                    <div class="inputbox"><input type="text" name="lname" id="lname"></div>
                </div>
                <div>
                    <label for="email">Email Address <sup>*</sup> </label>
                    <div class="inputbox"><input type="email" name="email" id="email" ></div>
                </div>
                <div>
                    <label for="mob"> Mobile Number <sup>*</sup></label>
                    <div class="inputbox" ><input type="text" name="mob" id="mob"></div>
                </div>
                <div>
                    <label for="password">Password <sup>*</sup></label>
                    <div class="inputbox"><input type="password" name="password" id="password"></div>
                </div>
                <div>
                    <label for="cpassword">Confirm Password <sup>*</sup></label>
                    <div class="inputbox"><input type="password" name="cpassword" id="cpassword"></div>
                </div>
                <div>
                    <div>
                        <input id="btn" type="submit" value="signup">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function() {
        $.validator.addMethod("email", function(value, element)
            {
            return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
            }, "Please enter a valid email address.");
            $.validator.addMethod("password",function(value,element)
            {
            return this.optional(element) || (/^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i).test(value);
            },"Passwords are 5-20 characters");

        $('#signupform').validate({
            rules: {
                fname: {
                    required: true,
                    minlength: 3,
                    number:false,
                },
                lname: {
                    required: true,
                    minlength: 3,
                    number:false,
                },
                email: {
                    required: true,
                    email: true
                    
                },
                password: {
                    required: true,
                    minlength: 5,
                },
                cpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                mob: {
                    required: true,
                    number:true,
                    minlength: 10,
                    maxlength: 10
                }
            }
        });
    })
    </script>

</body>

</html>
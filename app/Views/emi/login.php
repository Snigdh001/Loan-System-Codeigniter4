<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    sup {
        color: red;
    }
    .container {
        border: solid;
        margin: 100px !important;
        padding: 60px;
        height: 50vh;
        width: 50vw;
        background-color: white;
    }
    
    body {
        background-size: cover;
        background-image: url('static/bg.jpg');

    }

    label {
        left margin: 6px;
        display: block;
    }

    label.error {
        color: red;
        font-size: inherit;
        display: inline-block
    }

    .prevent-select {
        -webkit-user-select: none;
        /* Safari */
        -ms-user-select: none;
        /* IE 10 and IE 11 */
        user-select: none;
        /* Standard syntax */
    }
    </style>
</head>

<body>
    <div class="container">
        <form  method="POST" id="formlogin" action="">
        <?= csrf_field() ?>
            <label>
                <h1>Login</h1>
            </label>
            <div>
                <label for="email">Email Address<sup>*</sup></label>
                <div class="input">
                    <input type="email" name="email" id="email">
                </div>
            </div>
            <div>
                <label for="password"> Password<sup>*</sup></label>
                <div class="input">
                    <input type="password" name="password" id="password">
                </div>
            </div>
            <div>
                <label>Enter Captcha</label>
                <div>
                    <div>
                        <!-- <input type="img" name="" id="capt" disabled> -->
                        <h3 class="prevent-select" id="capt"></h3>
                        <input type="text" name="" id="textinput">
                    </div>
                    <div>
                        <h5>Captcha not visible <img
                                src="https://img.freepik.com/free-vector/illustration-refresh-icon_53876-5630.jpg?w=740&t=st=1672750665~exp=1672751265~hmac=be8fa0f925b18bba9f4fa7fb85229529029c497de8a4b167ecc4c7c120617407"
                                width="40px" id="refresh" onclick="cap()"></h5>
                    </div>
                </div>
                <div>
                    <input type="submit" onclick="return validcap()"  value="LogIn">
                    <!-- onclick="return validcap()" -->
                    <!-- <button type="submit">Login</button> -->
                    
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function() {
        $.validator.addMethod("email", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(
                value);
        }, "Please enter a valid email address.");
        $.validator.addMethod("password", function(value, element) {
            return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i.test(value);
        }, "Passwords are 6-16 characters");
        $('#formlogin').validate({
            rules: {
                email: {
                    required: true,
                    email: true,

                },
                password: {
                    required: true,
                    minlength: 5,
                }

            }
        });
    })
    </script>
    <script type="text/javascript">
    function cap() {
        var alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S',
            'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c',
            'd', 'e', 'f', 'g', 'h', 'i',
            'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '@', '#',
            '$', '%', '^', '&', '*', '+'
        ];
        var a = alpha[Math.floor(Math.random() * 71)];
        var b = alpha[Math.floor(Math.random() * 71)];
        var c = alpha[Math.floor(Math.random() * 71)];
        var d = alpha[Math.floor(Math.random() * 71)];
        var e = alpha[Math.floor(Math.random() * 71)];
        var f = alpha[Math.floor(Math.random() * 71)];

        var final = a + b + c + d + e + f;
        document.getElementById('capt').value = final;
        document.getElementById("capt").innerHTML = final;
    }
    window.onload = cap();

    function validcap() {
        var stg1 = document.getElementById('capt').value;
        var stg2 = document.getElementById('textinput').value;
        if (stg1 == stg2) {
            
            return true;

        } 
        else {
            alert("Please enter a valid captcha");
            // window.onload = cap();
            window.location.reload();
            // const element = document.getElementById("formlogin");
            // element.addEventListener("click", function(evn) {
            //     evn.preventDefault()
            // });
            return false;
            
        }
    }
    </script>

</body>

</html>
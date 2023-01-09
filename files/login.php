<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <form id= "login-form" action="/snigdh_ci4/" method="post">
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
                        <input type="text" name="" id="capt" readonly >
                        <input type="text" name="" id="textinput">
                    </div>
                    <div>
                        <h5>Captcha not visible <img
                                src="https://img.freepik.com/free-vector/illustration-refresh-icon_53876-5630.jpg?w=740&t=st=1672750665~exp=1672751265~hmac=be8fa0f925b18bba9f4fa7fb85229529029c497de8a4b167ecc4c7c120617407"
                                width="40px" id="refresh" onclick="cap()"></h5>
                    </div>
                </div>
                <div>
                    <button onclick="validcap()" type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
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
        document.getElementById("capt").value = final;
    }
    window.onload = cap();



    function validcap() {
        var stg1 = document.getElementById('capt').value;
        var stg2 = document.getElementById('textinput').value;
        if (stg1 == stg2) {
            alert("Form is validated Succesfully");
            let form_ele = document.getElementById("login-form");
            let formdata = new FormData(form_ele);
            const request = new XMLHttpRequest();
            request.open("POST", "/snigdh_ci4/");
            request.send(formdata);

        } else {
            alert("Please enter a valid captcha");
        }
    }
    </script>
</body>
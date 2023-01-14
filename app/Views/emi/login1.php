<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" id="formlogin" action="login1">
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
        <input type="submit" value="LogIn">
    </form>
</body>

</html>
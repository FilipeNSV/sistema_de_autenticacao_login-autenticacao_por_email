<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link rel="stylesheet" href="resources/css/style.css">

    <title>User Panel</title>
</head>

<body class="bg-dark">
    <!-- header -->
    <header class="header">

    <div class="container">
        <h1 class="text-center p-3 text-light">Login System</h1>
    </div>

    </header><br><br><br>

    <!-- Login -->
    <div class="container">
        <form action="?router=Site/LoginController/" onsubmit="return postValidation()" method="POST">
            <div class="container shadow rounded p-3" id="formLogin">
                <h2 class="text-light">Sign In</h2><br>
                
                <div class="form-floating">
                    <input type="email" class="form-control" name="emailLogin" placeholder="name@example.com" required>
                    <label for="floatingInputGrid">Email</label>
                </div><br>
                <div class="form-floating">
                    <input type="password" class="form-control" name="passwordLogin" placeholder="Senha" required>
                    <label for="floatingInputGrid">Password</label>
                </div><br>

                <div class="g-recaptcha" data-sitekey="6LdG9_4fAAAAAKT741HW3iwZWCkkHJPNS2-67hoK"></div><br>

                <div>
                    <input type="submit" class="btn mt-auto btn-outline-light" name="login" value="Login"></input>
                </div>
            </div><br><br><br><br>
        </form>
    </div>

    <div class="container">
        <a class="btn mt-auto btn-outline-light" href="?router=Site/register">Create Account!</a>
    </div>

    <script>
        function postValidation()
        {
            if(grecaptcha.getResponse() != "") return true;

            alert('Selecione a caixa de "Não sou um robô!');

            return false;
        }
    </script>

</body>

</html>
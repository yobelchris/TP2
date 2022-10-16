<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid row">
            <h1>LOGIN</h1>
            <form method="post" action="/login" class="col-sm-3">
                @isset($message)
                    @if(!$is_error)
                        <div class="alert alert-success" role="alert">
                            {{$message}}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @endif
                @endisset
                @csrf
                <div class="form-floating mb-sm-1">
                    <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-sm-1">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required><br>
                    <label for="password">Password</label>
                </div>
                <input type="hidden" id="failed_attempt" name="failed_attempt" value="@isset($failed_attempt){{$failed_attempt}}@endisset">
                <input type="submit" class="btn btn-primary" id="submitButton" value="Login">
                <b> or </b>
                <a href="/register">Register if you doesn't have an account</a>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        @isset($failed_attempt)
            @if($failed_attempt >= 3)
                <script>
                    btnSubmit = document.getElementById("submitButton")
                    btnSubmit.disabled = true
                    setTimeout(() => {
                        btnSubmit.disabled = false
                        document.getElementById("failed_attempt").value = 0
                    }, 30000)
                </script>
            @endif
        @endisset
    </body>
</html>

<style>
    html, body {
        height: 100%;
    }
    
    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }
    
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    
    .form-signin .checkbox {
        font-weight: 400;
    }
    
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    
    .form-signin .form-control:focus {
        z-index: 2;
    }
    
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<form method="post" action="index.php" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Loan Officer Sign In</h1>
    <label for="inputUsername" class="sr-only">Username:</label>
    <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <input type="hidden" name="action" value="login">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
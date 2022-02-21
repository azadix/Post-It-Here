<?php
    require "php/DatabaseOperations.php";
    require "templates/top.php";


    if (isset($_POST['login']) && isset($_POST['password'])) {
        $userLogin = $_POST['login'];
        $userPassword =  $_POST['password'];
        
    }

?>

<main role="main" clas="container">
    <div class="card loginForm">
        <div class="card-header">
            <h4>Log in</h4>
        </div>
        <div class="card-body">
            <form action="login.php" method="POST">
                <div class="form-group p-2">
                    <label for="login">Login:</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Username"></input>
                </div>
                <div class="form-group p-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off"></input>
                </div>
                <div class="form-group p-2">
                    <input type="submit" value="Login" class="btn btn-warning">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center links">
                Don't have an account? <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</main>

</body>
</html>
<?php
    require "php/DatabaseOperations.php";
    require "templates/top.php";

    $canRegister = true;

    if (isset($_POST['password']) && isset($_POST['passwordVerify'])) {
        if ($_POST['password'] !== $_POST['passwordVerify']) {
            echo "<div class='text-danger'>Password and Confirm password should be the same!</div>"; 
            $canRegister = false;  
        }
    }

    if (isset($_POST['username']) && !empty($_POST['username'])) {
        if ($connection->checkIfUsernameAlreadyExists($_POST['username'])) {
            echo "<div class='text-danger'>Username already taken!</div>";
            $canRegister = false;
        }
    }
    
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordVerify']) && $canRegister == true) {
        $userLogin = $_POST['username'];
        $userPassword =  $_POST['password'];
        $connection->addNewUser($userLogin, $userPassword);
        header ("Location: login.php");
    }
?>

<main role="main" clas="container">
    <div class="card loginForm">
        <div class="card-header">
            <h4>Create account</h4>
        </div>
        <div class="card-body">
            <form action="register.php" method="POST">
                <div class="form-group p-2">
                    <label for="ssername">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"></input>
                </div>
                <div class="form-group p-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off"></input>
                </div>
                <div class="form-group p-2">
                    <label for="password">Verify password:</label>
                    <input type="password" class="form-control" id="passwordVerify" name="passwordVerify" placeholder="Verify password" autocomplete="off"></input>
                </div>
                <div class="form-group p-2">
                    <input type="submit" value="Register" class="btn btn-warning">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center links">
                Already have an account? <a href="login.php">Log in</a>
            </div>
        </div>
    </div>
</main>

</body>
</html>
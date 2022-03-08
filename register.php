<?php
    require "php/databaseConnection.php";
    require "php/Class/User.php";
    require "php/Class/Note.php";

    require "templates/top.php";

    $canRegister = true;
    $passwordLength = 5;
    $userLogin="";
    $userPassword="";
    $userPasswordConfirm="";

    $user = new User($connection);

    //Check if post values are supplied
    if (isset($_POST['username'])){
        $userLogin = $_POST['username'];
        
        //Check if username is supplied and doesn't already exist
        if (empty($userLogin)) {
            echo "<div class='text-danger'>Username must be supplied!</div>";
            $canRegister = false;
        }
        if ($user->checkIfUsernameAlreadyExists($userLogin)) {
            echo "<div class='text-danger'>Username already taken!</div>";
            $canRegister = false;
        }
    }

    if (isset($_POST['password']) && isset($_POST['passwordConfirm'])){
        $userPassword = $_POST['password'];
        $userPasswordConfirm = $_POST['passwordConfirm'];
        
        //Check if passwords are matching
        if ($userPassword !== $userPasswordConfirm) {
            echo "<div class='text-danger'>Password and Confirm password should be the same!</div>"; 
            $canRegister = false;  
        }
        
        //Check if passwords are of required lenght
        if (strlen($userPassword) < $passwordLength) {
            echo "<div class='text-danger'>Password must be longer than {$passwordLength} characters!</div>"; 
            $canRegister = false;  
        }
    }

    if ($canRegister == true && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) ) {
        $user->addNewUser($userLogin, $userPassword);
        Header('Location: login.php');
    }
?>

<main role="main" clas="container">
    <div class="card bg-black-alpha">
        <div class="card-header">
            <h4>Create account</h4>
        </div>
        <div class="card-body">
            <form action="register.php" method="POST">
                <div class="form-group p-2">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"></input>
                </div>
                <div class="form-group p-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off"></input>
                </div>
                <div class="form-group p-2">
                    <label for="password">Confirm password:</label>
                    <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm password" autocomplete="off"></input>
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
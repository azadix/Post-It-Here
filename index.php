<?php
    require "php/DatabaseOperations.php";
    require "templates/top.php";
?>
        
<main role="main" class="container">
    <?php
        echo "<div class='row'>";
        // @TODO - Add generation from database
        // @TODO - Add modyfing of notes
        $amoutToGenerate = rand(5,20);

        if (isset($_COOKIE['isLoggedIn']) == false) {
            $amoutToGenerate = 0;
            echo "<p class='text-danger'>Log in to see notes</p>";
        }
        
        for ($noteCount=0; $noteCount < $amoutToGenerate; $noteCount++) {
            echo "<div class='col-lg-4 col-md-12 p-2 text-black note'>";
                echo "<div class='card'>";
                    echo "<div class='card-header bg-yellow bold'>";
                        echo "Note #{$noteCount}";
                    echo "</div>";
                    
                    $randomAmount = rand(1,7);
                    for ($amount=0; $amount < $randomAmount; $amount++) {
                        $isChecked = (rand(0,1)) ? 'checked' : '';
                        echo "<div class='input-group'>";
                        echo    "<span class='input-group-text'>
                                    <input class ='form-check-input mt-0' type='checkbox' {$isChecked}>
                                </span>
                                <input type='text' class='form-control' value='Random data # {$amount}'></input>";
                        echo "</div>";
                    }
                echo "</div>";

            echo "</div>";
        }
        echo "</div>";
        
    ?>
</main>

</body>
</html>
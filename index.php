<?php
    require "php/DatabaseOperations.php";
    require "templates/top.php";
?>
        
<main role="main" class="container">
    <?php
        echo "<button type='button' id='addNote' class='btn btn-outline-warning m-2'>Add a new note</button>";

        echo "<div class='row'>";
        // @TODO - Add generation from database
        // @TODO - Add modyfing of notes
        $notes = $connection->getNotes();

        foreach ($notes as $note) {
            echo "<div class='col-lg-4 col-md-12 p-2 text-black'>";
                echo "<div class='card p-1 h-100 note'>";
                    echo "<div class='card-header bg-yellow bold'>";
                        echo "<div class='input-group'>";
                            echo "<div class='input-group-prepend bg-yellow'>
                                    <div class='input-group-text border-dark bg-black-alpha'>#{$note['id']}</div>
                                </div>";
                            echo "<input type='text' class='form-control border-dark bg-yellow' value=''></input>";
                            echo "<button type='button' id='deleteNote' class='btn-close px-2' alt='Delete Note'></button>";
                        echo "</div>";
                        echo "<pre class='m-0'>Creator: {$note['title']}</pre>";
                    echo "</div>";
                    
                    $notesAmount = 1;
                    for ($amount=0; $amount < $notesAmount; $amount++) {
                        $isChecked = (rand(0,0)) ? 'checked' : '';
                        echo "<div class='input-group'>";
                        echo    "<span class='input-group-text'>
                                    <input class='form-check-input mt-0' type='checkbox' {$isChecked}>
                                </span>
                                <input type='text' class='form-control' value=''></input>";
                        echo "</div>";
                    }
                echo "</div>";

            echo "</div>";
        }
        echo "</div>";
    ?>
</main>
    <script src="js/script.js"></script>
</body>
</html>
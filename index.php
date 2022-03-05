<?php
    require "php/databaseConnection.php";
    require "php/Class/User.php";
    require "php/Class/Note.php";

    require "templates/top.php";
?>

<main role="main" class="container">
    <?php
        echo "<button type='button' class='btn btn-outline-warning m-2 addNote'>Add a new note</button>";

        echo "<div class='row'>";

        $noteObject = new Note($connection);
        $allNotes = $noteObject->getNotes();

        foreach ($allNotes as $oneNote) {
            $author = new User($connection);
            $authorName = $author->getUserName($oneNote['uploaderId']);

            echo "<div class='col-lg-4 col-md-12 p-2 text-black noteContainer'>";
                echo "<div class='card p-1 h-100 note'>";
                    echo "<div class='card-header bg-yellow bold'>";
                        echo "<div class='input-group'>";
                            echo "<div class='input-group-prepend bg-yellow'>
                                    <div class='input-group-text border-dark bg-black-alpha'>#{$oneNote['id']}</div>
                                </div>";
                            echo "<input type='text' class='form-control border-dark bg-yellow noteTitle' value=''></input>";
                            echo "<button type='button' class='btn-close px-2 deleteNote' alt='Delete Note'></button>";
                        echo "</div>";
                        echo "<pre class='m-0'>Author: {$authorName}</pre>";
                        echo "<pre class='m-0'>Creation date: {$oneNote['createdAt']}</pre>";
                    echo "</div>";

                    $notesAmount = 1;
                    for ($amount=0; $amount < $notesAmount; $amount++) {
                        $isChecked = rand(0,0) ? 'checked' : '';
                        echo "<div class='input-group'>";
                            echo "<span class='input-group-text'>
                                    <input class='form-check-input mt-0' type='checkbox' {$isChecked}>
                                </span>
                                <input type='text' class='form-control' value=''></input>";
                        echo "</div>";
                    }
                    echo "<div class='input-group'>";
                        echo "<button type='button' class='btn px-2 addItem' alt='Add list item'><span class='bi bi-plus-circle'> Add a new element</span></button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";

    ?>
</main>
    <script src="js/script.js"></script>
</body>
</html>
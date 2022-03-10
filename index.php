<?php
    require "php/databaseConnection.php";
    require "php/Class/User.php";
    require "php/Class/Note.php";

    require "templates/top.php";

    function addNote($index, $checked, $content){
        $disabled = ($checked == 'checked') ? 'disabled' : '';
        //<input type='text' class='form-control noteContent {$checked}' value='{$content}' {$disabled}></input>
        //<div contenteditable='true' class='form-control noteContent {$checked}' {$disabled}>{$content}</div>
        return "<div class='input-group noteRow'>
                    <div class='input-group-prepend d-none'>
                        <div class='input-group-text noteIndex'>{$index}</div>
                    </div>
                    <span class='input-group-text'>
                        <input class='form-check-input mt-0' type='checkbox' {$checked}>
                    </span>
                    <textarea rows='1' class='form-control noteContent {$checked}' {$disabled}>{$content}</textarea>
                </div>";
    }
?>

<main role="main" class="container">
    <?php
        echo "<button type='button' class='btn btn-outline-warning m-2 addContainer'>Add a new note</button>";
        echo "<div class='row'>";

        $noteObject = new Note($connection);
        $allContainers = array_reverse($noteObject->getContainers());

        foreach ($allContainers as $oneContainer) {
            $author = new User($connection);
            ($oneContainer['uploaderId'] != 0) ? $authorName = htmlspecialchars($author->getUserName($oneContainer['uploaderId'])) : $authorName = 'Anonymous';
            
            echo "<div class='col-lg-4 col-md-12 p-2 text-black noteContainer'>";
                echo "<div class='card p-1 h-100 note'>";
                    echo "<div class='card-header bg-yellow bold'>";
                        echo "<div class='input-group'>";
                            echo "<div class='input-group-prepend bg-yellow d-none'>
                                    <div class='input-group-text border-dark bg-black-alpha containerIndex'>{$oneContainer['id']}</div>
                                </div>";
                            echo "<input type='text' class='form-control border-dark bg-yellow containerTitle' value='{$oneContainer['title']}'></input>";
                            echo "<button type='button' class='btn-close px-2 deleteContainer'></button>";
                        echo "</div>";

                        echo "<pre class='m-0'>Author: {$authorName}</pre>";
                        echo "<pre class='m-0'>Creation date: {$oneContainer['createdAt']}</pre>";
                    echo "</div>";

                    $allNotes = $noteObject->getNotes($oneContainer['id']);
                    
                    echo "<ul class='sortable'>";
                        foreach ($allNotes as $oneNote) {
                            $isChecked = $oneNote['isChecked'] ? 'checked' : '';
                            echo "<li class='ui-state-default'>";
                                echo addNote($oneNote['order'], $isChecked, htmlspecialchars($oneNote['content']));
                            echo "</li>";
                        }
                    echo "</ul>";

                    echo "<div class='input-group'>";
                        echo "<button type='button' class='btn px-2 addNote'><i class='bi bi-plus-circle'></i> Add a new note</button>";
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
$.fn.findContainerIndex = function($domElement) {
    return $domElement.parentsUntil('.noteContainer').find('.containerIndex').text().replace("#", "");
};

$.fn.findNoteIndex = function($domElement) {
    return $domElement.parentsUntil('.input-group').find('.noteIndex').text().replace("#", "");
};

$.fn.updateTitle = function(containerIndex, title) {
    $.post({
            url: 'php/updateTitle.php',
            data: {
                id: containerIndex,
                title: title
            }
        })
        .done(function() {
            return $(this);
        });
};

$.fn.updateContent = function(containerIndex, noteIndex, content) {
    $.post({
            url: 'php/updateContent.php',
            data: {
                id: noteIndex,
                containerId: containerIndex,
                content: content
            }
        })
        .done(function() {
            return $(this);
        });
};

$('.container').on('click', '.deleteContainer', function() {
    let containerIndex = $(this).findContainerIndex($(this))
    $.post({
            url: 'php/deleteContainer.php',
            data: {
                id: containerIndex
            }
        })
        .done(function() {
            $('.container').load(location.href + ' .container>*')
        });
});

$('.container').on('click', '.addContainer', function() {
    $.post({
            url: 'php/addContainer.php',
        })
        .done(function() {
            $('.container').load(location.href + ' .container>*')
        });
});

$('.container').on('input', '.containerTitle', function() {
    let title = $(this).val().trim();
    let containerIndex = $(this).findContainerIndex($(this));

    setTimeout($(this).updateTitle(containerIndex, title), 1000);
});

$('.container').on('click', '.addItem', function() {
    let containerIndex = $(this).findContainerIndex($(this))
    $.post({
            url: 'php/addNote.php',
            data: {
                containerId: containerIndex,
                noteIndex: noteIndex
            }
        })
        .done(function() {
            $('.container').load(location.href + ' .container>*')
        });
});

$('.container').on('input', '.noteTitle', function() {
    let content = $(this).val().trim();
    let containerIndex = $(this).findContainerIndex($(this));
    let noteIndex = $(this).findNoteIndex($(this));

    setTimeout($(this).updateContent(containerIndex, noteIndex, content), 1000);
});
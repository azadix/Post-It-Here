$.fn.findNoteIndex = function($domElement) {
    return $domElement.parentsUntil('.noteContainer').find('.noteIndex').text().replace("#", "");
};

$.fn.updateTitle = function(noteIndex, title) {
    $.post({
            url: 'php/updateTitle.php',
            data: {
                id: noteIndex,
                title: title
            }
        })
        .done(function(result) {
            console.log('Title: ' + title + "\nNote: " + noteIndex);
            return result;
        });

};

$('.container').on('click', '.deleteNote', function() {
    let noteIndex = $(this).findNoteIndex($(this))
    $.post({
            url: 'php/deleteNote.php',
            data: {
                id: noteIndex
            }
        })
        .done(function() {
            $('.container').load(location.href + ' .container>*')
        });
});

$('.container').on('click', '.addNote', function() {
    $.post({
            url: 'php/addNote.php',
        })
        .done(function() {
            $('.container').load(location.href + ' .container>*')
        });
});

$('.container').on('input', '.noteTitle', function() {
    let title = $(this).val().trim();
    let noteIndex = $(this).findNoteIndex($(this));

    setTimeout($(this).updateTitle(noteIndex, title), 1000);
});
$('.container').on('click', '.addNote', function() {
    $.get('php/addNote.php', function() {
        //NOTE: not entirely sure why " .container>*" should include the ">*" but it works
        $('.container').load(location.href + ' .container>*');
    });
});

$('.container').on('click', '.deleteNote', function() {
    let noteIndex = $(this).siblings()[0].innerText.replace("#", "");
    $.get('php/deleteNote.php?note=' + noteIndex, function() {
        $('.container').load(location.href + ' .container>*');
    });
});

$('.container').on('input', '.noteTitle', function() {
    let title = $(this).val().trim();
    console.log(title);
});
$.fn.findContainerIndex = function($domElement) {
    return $domElement.parentsUntil('.noteContainer').find('.containerIndex').text().replace("#", "");
};

$.fn.findNoteIndex = function($domElement) {
    return $domElement.parents('.noteRow').find('.noteIndex').text().replace("#", "");
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

$.fn.updateContent = function(noteIndex, containerIndex, content) {
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

$.fn.updateStatus = function(noteIndex, containerIndex, status) {
    $.post({
            url: 'php/updateCheckbox.php',
            data: {
                id: noteIndex,
                containerId: containerIndex,
                status: status
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

$('.container').on('click', '.addNote', function() {
    let containerIndex = $(this).findContainerIndex($(this))
    $.post({
            url: 'php/addNote.php',
            data: {
                containerId: containerIndex
            }
        })
        .done(function() {
            $('.container').load(location.href + ' .container>*')
        });
});

$('.container').on('input', '.noteContent', function() {
    let noteIndex = $(this).findNoteIndex($(this));
    let containerIndex = $(this).findContainerIndex($(this));
    let content = $(this).val().trim();

    setTimeout($(this).updateContent(noteIndex, containerIndex, content), 1000);
});

$('.container').on('change', ':checkbox', function() {
    let noteIndex = $(this).findNoteIndex($(this));
    let containerIndex = $(this).findContainerIndex($(this));
    let status = 0;
    let noteContent = $(this).parents('.noteRow').find('.noteContent');

    if ($(this).is(':checked')) {
        status = 1;
        noteContent.addClass('checked');
        noteContent.attr('disabled', true);
    } else {
        noteContent.removeClass('checked');
        noteContent.attr('disabled', false);
    }

    setTimeout($(this).updateStatus(noteIndex, containerIndex, status), 1000);
});
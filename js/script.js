function findContainerIndex(domElement) {
    return domElement.parentsUntil('.noteContainer').find('.containerIndex').text();
};

function findNoteIndex(domElement) {
    return domElement.parents('.noteRow').find('.noteIndex').text();
};

function updateTitle(containerIndex, title) {
    $.post({
            url: 'php/updateTitle.php',
            data: {
                id: containerIndex,
                title: title
            }
        })
        .done(function() {
            return true;
        });
};

function updateContent(noteIndex, containerIndex, content) {
    $.post({
            url: 'php/updateContent.php',
            data: {
                id: noteIndex,
                containerId: containerIndex,
                content: content
            }
        })
        .done(function() {
            return true;
        });
};

function updateStatus(noteIndex, containerIndex, status) {
    $.post({
            url: 'php/updateCheckbox.php',
            data: {
                id: noteIndex,
                containerId: containerIndex,
                status: status
            }
        })
        .done(function() {
            return true;
        });
};

function resizeTextareas() {
    $('textarea').each(function() {
        $(this).css('height', $(this).prop('scrollHeight') + 'px');
    }).on("input", function() {
        $(this).css('height', 'auto;');
        $(this).css('height', $(this).prop('scrollHeight') + 'px');
    });
};


$(document).ready(function() {
    $('.container').on('click', '.deleteContainer', function() {
        let containerIndex = findContainerIndex($(this))
        $.post({
                url: 'php/deleteContainer.php',
                data: {
                    id: containerIndex
                }
            })
            .done(function() {
                $('.container').load(location.href + ' .container>*');
            });
    });

    $('.container').on('click', '.addContainer', function() {
        $.post({
                url: 'php/addContainer.php',
            })
            .done(function() {
                $('.container').load(location.href + ' .container>*');
            });
    });

    $('.container').on('input', '.containerTitle', function() {
        let title = $(this).val().trim();
        let containerIndex = findContainerIndex($(this));

        updateTitle(containerIndex, title);
    });

    $('.container').on('click', '.addNote', function() {
        let containerIndex = findContainerIndex($(this))
        $.post({
                url: 'php/addNote.php',
                data: {
                    containerId: containerIndex
                }
            })
            .done(function() {
                $('.container').load(location.href + ' .container>*');
            });
    });

    $('.container').on('input', '.noteContent', function() {
        let noteIndex = findNoteIndex($(this));
        let containerIndex = findContainerIndex($(this));
        let content = $(this).val().trim();

        updateContent(noteIndex, containerIndex, content);
    });

    $('.container').on('change', ':checkbox', function() {
        let noteIndex = findNoteIndex($(this));
        let containerIndex = findContainerIndex($(this));
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

        updateStatus(noteIndex, containerIndex, status);
    });

    resizeTextareas();

    // $(".sortable").sortable();
    // $('.sortable').on('sortstop', function() {
    //     let containerIndex = $(this).findContainerIndex($(this));
    //     $('.sortable').each(function() {
    //         let noteIndex = $(this).findNoteIndex($(this));
    //         $(this).updateOrder(noteIndex, containerIndex);
    //     })
    // })
});
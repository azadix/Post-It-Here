function deleteNote() {
    let noteIndex = this.parentNode.firstChild.innerText.replace("#", "");
    console.log(noteIndex);
    fetch('http://localhost/post-it-here/post-it-here/deleteNote.php', {
        method: 'POST',
        body: noteIndex
    });
}

function addNote() {
    fetch('http://localhost/post-it-here/post-it-here/addNote.php', {
        method: 'POST',
        body: ''
    });
}

document.querySelectorAll('#deleteNote').forEach(closeButton => {
    closeButton.addEventListener('click', deleteNote);
});;

let addNoteButton = document.getElementById('addNote');
addNoteButton.addEventListener('click', addNote);
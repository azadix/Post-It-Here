function deleteNote() {
    let noteIndex = this.parentNode.firstChild.innerText.replace("#", "");
    console.log(noteIndex + " has been deleted");
    fetch('http://localhost/post-it-here/post-it-here/deleteNote.php?note=' + noteIndex);
}

function addNote() {
    fetch('http://localhost/post-it-here/post-it-here/addNote.php');
}

document.querySelectorAll('#deleteNote').forEach(closeButton => {
    closeButton.addEventListener('click', deleteNote);
});;

let addNoteButton = document.getElementById('addNote');
addNoteButton.addEventListener('click', addNote);
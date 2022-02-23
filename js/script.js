function deleteNote() {
    let noteIndex = this.parentNode.firstChild.innerText.replace("#", "");
    console.log(noteIndex);
    fetch('http://localhost/post-it-here/post-it-here/deleteNote.php', {
        method: 'POST',
        body: noteIndex
    });
}

document.querySelectorAll('#deleteNote').forEach(closeButton => {
    closeButton.addEventListener('click', deleteNote);
});;
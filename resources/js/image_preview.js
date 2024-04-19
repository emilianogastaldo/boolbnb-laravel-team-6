const placeholder = 'https://marcolanci.it/boolean/assets/placeholder.png';
// Recupero l'input in cui carico il file dell'immagine
const imageFiled = document.getElementById('image');
// Recupero dove farò vedere la preview
const previewField = document.getElementById('preview');

let blobUrl;

imageFiled.addEventListener('change', () => {
    // controllo se ho il file
    if (imageFiled.files && imageFiled.files[0]) {
        // prendo il file
        const file = imageFiled.files[0];
        //  URL temporaneo
        blobUrl = URL.createObjectURL(file);

        previewField.src = blobUrl;
    }
    else {
        previewField.src = placeholder;
    }

});

// I blob sono pesanti, quindi quando lascio la pagina devo cancellarlo
window.addEventListener('beforeunload', () => {
    if (blobUrl) URL.revokeObjectURL(blobUrl);
});
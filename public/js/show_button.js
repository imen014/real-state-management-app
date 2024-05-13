// Récupérer le bouton et le bloc
const showButton = document.getElementById('showButton');
const hiddenBlock = document.getElementById('hiddenBlock');

// Ajouter un écouteur d'événements sur le bouton
showButton.addEventListener('click', function() {
    // Si le bloc est caché, l'afficher ; sinon, le cacher
    if (hiddenBlock.style.display === 'none') {
        hiddenBlock.style.display = 'block';
    } else {
        hiddenBlock.style.display = 'none';
    }
});

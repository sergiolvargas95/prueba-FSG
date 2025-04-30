document.addEventListener('DOMContentLoaded', function () {
    const fotoInput = document.getElementById('fotoInput');
    const previewImage = document.getElementById('previewImage');
    const previewContainer = document.getElementById('previewContainer');

    if (fotoInput) {
        fotoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

window.cancelarPreview = function () {
    const fotoInput = document.getElementById('fotoInput');
    const previewImage = document.getElementById('previewImage');
    const previewContainer = document.getElementById('previewContainer');

    fotoInput.value = '';
    previewImage.src = '';
    previewContainer.style.display = 'none';
};
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const clearNewImageBtn = document.getElementById('clearNewImage');
    const removeCurrentImageBtn = document.getElementById('removeCurrentImage');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const currentImageSection = document.getElementById('currentImageSection');
    const removeImageFlag = document.getElementById('removeImageFlag');

    // Handle new image selection
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                    clearNewImageBtn.style.display = 'inline-block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
                clearNewImageBtn.style.display = 'none';
            }
        });
    }

    // Handle clearing newly selected image
    if (clearNewImageBtn) {
        clearNewImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.style.display = 'none';
            clearNewImageBtn.style.display = 'none';
        });
    }

    // Handle removing current image
    if (removeCurrentImageBtn) {
        removeCurrentImageBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove the current image?')) {
                currentImageSection.style.display = 'none';
                removeImageFlag.value = '1';
            }
        });
    }
});
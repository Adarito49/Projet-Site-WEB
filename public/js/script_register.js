function previewImage() {
    var reader = new FileReader();
    reader.onload = function() {
        var imagePreview = document.querySelector('.image-preview');
        
        imagePreview.innerHTML = '';
        
        var image = document.createElement('img');
        image.src = reader.result;
        imagePreview.appendChild(image);
    }
    reader.readAsDataURL(event.target.files[0]);
    }
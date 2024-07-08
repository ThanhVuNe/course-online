function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.img-change').attr('src', e.target.result);
            $('.img-change').show();
        }

        reader.readAsDataURL(input.files[0]);
    }
}
document.getElementById('lessonUrl').onchange = e => {
    const file = e.target.files[0];
    const fileType = file.type;
    $('.video-change').empty();
    if (fileType.includes('video')) {
        // Video file
        const url = URL.createObjectURL(file);
        $('.change-video').hide();
        const html = `<video controls="controls" src="${url}" type="video/mp4" class="mb-3 img-change video"></video>`;
        $('.video-change').append(html);
    } else if (fileType == 'application/pdf') {
        console.log('pdf file');
        // PDF file
        const url = URL.createObjectURL(file);
        $('.change-video').hide();
        const html = `<embed src="${url}" type="application/pdf" class="mb-3 pdf-change" style="width:100%; height:500px;">`;
        $('.video-change').append(html);
    } else {
        // Unsupported file type
        alert('Unsupported file type. Please select a video, PDF, or PowerPoint (PPTX) file.');
        // Clear file input
        $('#lessonUrl').val('');
    }
};

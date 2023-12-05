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
    const url = URL.createObjectURL(file);
    $('.change-video').hide();
    const html = `<video controls="controls" src=" ${url} " type="video/mp4" class="mb-3 img-change video"></video>`
    $('.video-change').append(html);
};

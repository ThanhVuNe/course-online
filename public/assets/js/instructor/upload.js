$(document).ready(function () {
    $('#btnFinish').attr('aria-disabled', 'true');
    $('#btnFinish').css('pointer-events', 'none');
})

const imageInput = document.getElementById('image');
const videoInput = document.getElementById('trailer');
const uploadBtn = document.getElementById("uploadS3");
const courseId = document.getElementById("courseId").value;
const path = window.location.origin + "/instructor/courses/create/getUploadUrl/" + courseId;

imageInput.addEventListener("change", function (event) {
    const image = event.target.files[0];

    if (image) {
        const reader = new FileReader();
        reader.readAsDataURL(image);
    }
});

videoInput.addEventListener("change", function (event) {
    const video = event.target.files[0];

    if (video) {
        const readerVideo = new FileReader();
        readerVideo.readAsDataURL(video);
    }
});

uploadBtn.addEventListener("click", async () => {
    const formPUT = document.getElementById("stepTwo");
    const baseUrl = formPUT.dataset.url;
    const selectImage = imageInput.files[0];
    const selectVideo = videoInput.files[0];

    if (selectVideo && selectImage) {
        $(".btn-close").hide();
        $("#closeModal").hide();
        $("#modalNotification").modal("show");
        try {
            const responseUrlUpload = await axios.get(path);
            const urlImage = responseUrlUpload.data.urlImage;
            const urlVideo = responseUrlUpload.data.urlVideo;
            await axios.put(urlImage, selectImage, {
                headers: {
                    'Content-Type': 'image/jpeg'
                }
            });

            await axios.put(urlVideo, selectVideo, {
                headers: {
                    'Content-Type': 'video/mp4'
                }
            });

            axios.put(baseUrl)
            .then(function (response) {
                $(".modal-body").text(response.data.message);
                $(".btn-close").show();
                $("#closeModal").show();
            })

            $('#uploadS3').css('pointer-events', 'none');
            $('#uploadS3').css('opacity', '0.3');
            $('#btnFinish').css('pointer-events', 'auto');
        } catch (error) {
            $(".modal-body").text("Upload files was failed!");
            $("#modalNotification").modal("show");
        }
    } else {
        $(".modal-body").text("Please chosen the files!");
        $("#modalNotification").modal("show");
    }
});

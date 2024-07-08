$(document).ready(function () {
    $('#btnFinish').attr('aria-disabled', 'true');
    $('#btnFinish').css('pointer-events', 'none');
    $('#btnFinish').css('opacity', '0.3');
})

const fileInput = document.getElementById('lessonUrl');
const uploadBtn = document.getElementById("uploadS3");
const topicId = document.getElementById("topicId").value;
var lessonDuration = '';

function secondsToHms(d) {
    d = Number(d);
    const h = Math.floor(d / 3600);
    const m = Math.floor(d % 3600 / 60);
    const s = Math.floor(d % 3600 % 60);
    return h > 0 ? `${h}:${m}:${s}` : m > 0 ? `${m}:${s}` : `${s}`;
}

function isVideo(file) {
    // List of video MIME types
    const videoMimeTypes = [
        'video/mp4',
        'video/webm',
        'video/ogg'
        // Add more video MIME types if needed
    ];

    // Check if the file's MIME type is in the list of video MIME types
    return videoMimeTypes.includes(file.type);
}
fileInput.addEventListener("change", function (event) {
    const file = event.target.files[0];

    if(isVideo(file)) {
        const videoFile = file;
        const video = document.createElement('video');
        video.preload = 'metadata';
        video.onloadedmetadata = function () {
            window.URL.revokeObjectURL(video.src);
            var duration = video.duration;
            document.getElementById("timeDurationFormat").value = secondsToHms(duration);
            document.getElementById("timeDuration").value = duration;
            lessonDuration =  secondsToHms(duration);
        }
        if (videoFile) {
            const readerVideo = new FileReader();
            readerVideo.readAsDataURL(videoFile);
            readerVideo.onload = function (e) {
                video.src = URL.createObjectURL(videoFile);
            }
        }
    }
    else {
        const file = event.target.files[0];

        document.getElementById("timeDurationFormat").value = '';
        document.getElementById("timeDuration").value = '';
    }

});

uploadBtn.addEventListener("click", async () => {
    const formId = document.querySelector("#formCreate");
    const title = document.getElementById("title").value;
    const baseUrl = formId.dataset.url;

    try {
        const response = await axios.post(baseUrl, {
            'title': title,
            'topic_id': topicId,
        });
        const lessonId = response.data.lessonId;

        const file = fileInput.files[0];
        console.log(lessonId);
        const path = window.location.origin + "/instructor/lessons/getUploadUrl/" + lessonId;
        const putUrl = window.location.origin + '/instructor/lessons/updateUrl/' + lessonId;

        if (file) {
            $(".btn-close").hide();
            $("#closeModal").hide();
            $("#modalNotification").modal("show");
            try {

                let fileType = file.type;

                const responseUrlUpload = await axios.get(path, {
                    params: {
                        fileType: fileType
                    }
                });
                const uploadUrl = responseUrlUpload.data.urlVideo;
                console.log(file.type);
                console.log(uploadUrl);
                await axios.put(uploadUrl, file, {
                    headers: {
                        'Content-Type': fileType // Set the Content-Type header based on the file type
                    }
                });

                await axios.put(putUrl, {
                    fileType: fileType,
                    lessonDuration: lessonDuration
                })
                    .then(function (response) {
                        $(".modal-body").text(response.data.message);
                        $(".btn-close").show();
                        $("#closeModal").show();
                    })

                $('#uploadS3').css('pointer-events', 'none');
                $('#uploadS3').css('opacity', '0.3');
                $('#btnFinish').css('opacity', '1');
                $('#btnFinish').css('pointer-events', 'auto');
            } catch (error) {
                console.log(error);
                $(".modal-body").text("Upload failed!");
                $("#modalNotification").modal("show");
            }
        } else {
            $(".modal-body").text("Please select a file!");
            $("#modalNotification").modal("show");
        }
    } catch (error) {
        $(".messageNotice").html(error.message);
        $(".toast-error").show();
    }
});

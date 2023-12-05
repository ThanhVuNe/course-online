const videoInput = document.getElementById('lessonUrl');
const uploadBtn = document.getElementById("uploadS3");
const topicId = document.getElementById("topicId").value;

function secondsToHms(d) {
    d = Number(d);
    const h = Math.floor(d / 3600);
    const m = Math.floor(d % 3600 / 60);
    const s = Math.floor(d % 3600 % 60);
    return h > 0 ? `${h}:${m}:${s}` : m > 0 ? `${m}:${s}` : `${s}`;
}

videoInput.addEventListener("change", function (event) {
    const videoFile = event.target.files[0];
    const video = document.createElement('video');
    video.preload = 'metadata';
    video.onloadedmetadata = function () {
        window.URL.revokeObjectURL(video.src);
        var duration = video.duration;
        document.getElementById("timeDurationFormat").value = secondsToHms(duration);
        document.getElementById("timeDuration").value = duration;
    }
    if (videoFile) {
        const readerVideo = new FileReader();
        readerVideo.readAsDataURL(videoFile);
        readerVideo.onload = function (e) {
            video.src = URL.createObjectURL(videoFile);
        }
    }
});


uploadBtn.addEventListener("click", async () => {
    var formId = document.querySelector("#formCreate");
    var title = document.getElementById("title").value;
    var timeDuration = document.getElementById("timeDuration").value;
    var baseUrl = formId.dataset.url;

    try {
        const response = await axios.post(baseUrl, {
            'title': title,
            'lesson_duration': timeDuration,
            'topic_id': topicId,
        });
        const lessonId = response.data.lessonId;
        console.log(lessonId);

        const selectVideo = videoInput.files[0];
        const path = window.location.origin + "/instructor/lessons/getUploadUrl/" + lessonId;
        console.log(path);
        const putUrl = window.location.origin + '/instructor/lessons/updateUrl/' + lessonId;

        if (selectVideo) {
            $(".btn-close").hide();
            $("#closeModal").hide();
            $("#modalNotification").modal("show");
            try {
                const responseUrlUpload = await axios.get(path);
                const urlVideo = responseUrlUpload.data.urlVideo;

                await axios.put(urlVideo, selectVideo, {
                    headers: {
                        'Content-Type': 'video/mp4'
                    }
                });

                await axios.put(putUrl)
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
    } catch (error) {
        $(".messageNotice").html(error.message);
        $(".toast-error").show();
    }
});

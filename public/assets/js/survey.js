document.addEventListener('DOMContentLoaded', function () {
    $('#surveyForm').modal('show');

    $('.btn-next-slide').on('click', function () {
        $('.slide-begin').hide();
        $('.slide-survey').show();
    })

    var index = 0;
    $('.progress').css('width', 1 / 3 * 100 + '%');
    $('.group-btn-survey .btn').on('click', function () {
        var btnId = $(this).attr('id');
        if (btnId == 'next') {
            if (index <= 2) {
                index++;
                $('#prev').show();

                if (index <= 1) {
                    $('#next').text('Next');
                } else if (index > 1) {
                    $('#next').text('Submit');
                    document.getElementById("next").type = "submit";
                    $("#next").bind('click', function () {
                        $('#formSurvey').trigger('submit');
                    })
                }
            }

        } else if (btnId == 'prev') {
            $('#next').text('Next');
            if (index != 0) {
                index--;
            }
            if (index == 0) {
                $('#prev').hide();
            }
        }
        var title = ["What the kind of you want to learn?", "What is your favorite language?", "Which level do you want to start learning from?"];

        $('.content > div').hide().eq(index).show();
        $('.content > div').eq(index).show();
        $('.title').text(title[index]);

        $('.progress').css('width', (index + 1) / 3 * 100 + '%')
    })

})

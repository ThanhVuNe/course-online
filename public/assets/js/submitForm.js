function submitForm(id) {
    var formId = document.querySelector("#formEdit" + id);
    var content = document.getElementById("content" + id).value;
    var baseUrl = formId.dataset.url;

    axios.put(baseUrl, {
        'content': content,
    }, { withCredentials: true })
    .then(function (response) {
        if (response.status == 200) {
            $(`.edit-comment.${id}`).hide();
            $(`.comment-content.${id}`).html(content);
            $(`.comment-content.${id}`).show();
            $(".messageNotice").html(response.data.message);
            $(".toast-success").show();
        } else {
            $(".messageNotice").html(response.data.message);
            $(".toast-error").show();
        }

        setTimeout(() => {
            $(".notification-toast").hide();
        }, 3000);
    })
    .catch(function (error) {
        $(".messageNotice").html(error.message);
            $(".toast-error").show();
        setTimeout(() => {
            $(".notification-toast").hide();
        }, 3000);
    });
}

function deleteComment(id, parentId)
{
    var formDelete = document.getElementById("formDelete" + id);
    var baseUrl = formDelete.dataset.url;

    $('#submitDelete').on("click", function () {
        $('#cancelDelete').trigger('click');
        axios.delete(baseUrl, {
            params: { id: id },
        }, { withCredentials: true })
        .then(function (response) {
            if ((parentId) !== null) {
                var countComment = $(`#count${parentId}`).text();
                var newCount = parseInt(countComment) - 1;
                switch (newCount) {
                    case 0:
                        $(`show-reply.${parentId}`).remove();
                        $(`hide-reply.${parentId}`).remove();
                        break;

                    default:
                        $(`#count${parentId}`).text(newCount);
                        break;
                }
            }
            $('#comment' + id).remove();
            if (response.data.code == 200) {
                $(".messageNotice").html(response.data.message);
                $(".toast-success").show();
            } else {
                $(".messageNotice").html(response.data.message);
                $(".toast-error").show();
            }

            setTimeout(() => {
                $(".notification-toast").hide();
            }, 3000);
        })
        .catch(function (error) {
            $(".messageNotice").html(error.message);
            $(".toast-error").show();
            setTimeout(() => {
                $(".notification-toast").hide();
            }, 3000);
        });
    })

}

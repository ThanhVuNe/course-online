function deleteItem(itemId, token) {

    $.ajax({
        type: 'POST',
        url: `carts/${itemId}`,
        data: {
            'id': itemId,
            '_method': 'DELETE',
            '_token': token
        },
        success: function () {
            location.reload(true);
            $(".messageNotice").text("Delete item was successful");
            $(".toast-success").show();

            setTimeout(() => {
                $(".notification-toast").hide();
            }, 10000);
        }
    });
}

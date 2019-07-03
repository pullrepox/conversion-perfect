(function ($) {
    $('.email-list-edit, .email-list-export').on('click', function () {
        location.href = $(this).data('target');
    });
    
    /**
     * Lists Delete
     */
    let delId = '';
    $('.email-list-delete').on('click', function () {
        delId = $(this).data('id');
    });
    
    $('#deleteList').on('click', function () {
        window.axios.delete(`/email-lists/${delId}`).then((r) => {
            $('#delete-list-modal').modal('hide');
            // if (r.data.result === 'success') {
            location.reload();
            // }
        });
    });
})(jQuery);

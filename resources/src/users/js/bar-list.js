(function ($) {
    /**
     * Bar Delete
     */
    let delId = '';
    $('.bar-delete').on('click', function () {
        delId = $(this).data('id');
    });
    
    $('#deleteBar').on('click', function () {
        window.axios.delete(`/bars/${delId}`).then((r) => {
            $('#delete-modal').modal('hide');
            if (r.data.result === 'success') {
                location.reload();
            }
        });
    });
})(jQuery);

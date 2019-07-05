(function ($) {
    /**
     * Bar Delete
     */
    let delId = '';
    $('.bar-delete').on('click', function () {
        delId = $(this).data('id');
    });
    
    // Delete from database.
    $('#deleteBar').on('click', function () {
        window.axios.delete(`/bars/${delId}`).then((r) => {
            $('#delete-modal').modal('hide');
            if (r.data.result === 'success') {
                location.reload();
            }
        });
    });
    
    // Bar Clone.
    $('.bar-clone').on('click', function () {
        window.axios.put(`/bars/${$(this).data('target')}`, {
            flag: 'clone'
        }).then((r) => {
            if (r.data.result === 'success') {
                location.reload();
            }
        });
    });
})(jQuery);

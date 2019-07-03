(function ($) {
    $('.group-edit, .group-report').on('click', function () {
        location.href = $(this).data('target');
    });
    
    /**
     * Group Delete
     */
    let delId = '';
    $('.group-delete').on('click', function () {
        delId = $(this).data('id');
    });
    
    $('#deleteGroup').on('click', function () {
        window.axios.delete(`/groups/${delId}`).then((r) => {
            $('#delete-group-modal').modal('hide');
            // if (r.data.result === 'success') {
            location.reload();
            // }
        });
    });
    
    /**
     * Tracker Clone
     */
    $('.group-clone').on('click', function () {
        window.axios.put(`/groups/${$(this).data('target')}`, {
            flag: 'clone'
        }).then((r) => {
            if (r.data.result === 'success') {
                location.reload();
            }
        });
    });
})(jQuery);

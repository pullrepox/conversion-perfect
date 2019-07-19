import ClipboardJS from 'clipboard';

(function ($) {
    'use strict';
    
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
    
    /**
     * Clipboard
     * @type {string}
     */
    let $element = '.clipboard-bar-embed-code';
    if ($($element).length) {
        clipboardInit($($element));
    }
    
    // Methods
    function clipboardInit($this) {
        $this.tooltip().on('mouseleave', function () {
            $this.tooltip('hide');
        });
        
        let clipboard = new ClipboardJS($element);
        clipboard.on('success', function (e) {
            $(e.trigger)
                .attr('title', 'Copied')
                .tooltip('_fixTitle')
                .tooltip('show')
                .attr('title', 'Copy to clipboard')
                .tooltip('_fixTitle');
            
            e.clearSelection()
        });
    }
    
    $('.bar-copy-code').on('click', function () {
        $('#script_copy').val(`<script data-cfasync="false" src="${$(this).data('link')}"></script>`);
        $('#url_copy').val($(this).data('custom'));
    });
})(jQuery);

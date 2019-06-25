import ClipboardJS from 'clipboard';

(function ($) {
    'use strict';
    $('.tracker-edit').on('click', function () {
        location.href = $(this).data('target');
    });
    
    /**
     * Tracker Clone
     */
    $('.tracker-clone').on('click', function () {
        window.axios.put(`/trackers/${$(this).data('target')}`, {
            flag: 'duplicate'
        }).then((r) => {
            if (r.data.result === 'success') {
                location.reload();
            }
        });
    });
    
    /**
     * Tracker Delete
     */
    let delId = '';
    $('.tracker-delete').on('click', function () {
        delId = $(this).data('id');
    });
    
    $('#deleteTracker').on('click', function () {
        window.axios.delete(`/trackers/${delId}`).then((r) => {
            $('#delete-modal').modal('hide');
            if (r.data.result === 'success') {
                location.reload();
            }
        });
    });
    
    /**
     * Destination Link Click
     */
    $('.external-click').on('click', function () {
        window.open($(this).data('target'), '_blank');
    });
    
    /**
     * Clipboard
     * @type {string}
     */
    let $element = '.clipboard-tracker',
        $btn = $($element);
    
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
                // .attr('title', 'Copy ' + $(e.trigger).data('link') + ' to clipboard')
                .attr('title', 'Copy to clipboard')
                .tooltip('_fixTitle');
            
            e.clearSelection()
        });
    }
    
    // Events
    if ($btn.length) {
        clipboardInit($btn);
    }
    /** === === **/
})(jQuery);

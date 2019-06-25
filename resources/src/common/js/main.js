require('bootstrap-notify');
(function ($) {
    $(function () {
        $('#checkAgreeRegister').on('click', function () {
            if ($(this).get(0).checked) {
                $('#register-btn').attr('disabled', false);
            } else {
                $('#register-btn').attr('disabled', true);
            }
        });
    });
    
    /**
     * Notify
     * @param placement
     * @param align
     * @param icon
     * @param type
     * @param title
     * @param message
     * @param url
     * @param animIn
     * @param animOut
     */
    window.commonNotify = function (placement, align, icon, type, title, message, url, animIn, animOut) {
        $.notify({
            icon: icon,
            title: title,
            message: message,
            url: url
        }, {
            element: 'body',
            type: type,
            allow_dismiss: true,
            newest_on_top: true,
            placement: {
                from: placement,
                align: align
            },
            offset: {
                x: 15, // Keep this as default
                y: 80 // Unless there'll be alignment issues as this value is targeted in CSS
            },
            spacing: 10,
            z_index: 1080,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: animIn,
                exit: animOut
            },
            template: '<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify w-auto" role="alert">' +
                '<span class="alert-icon" data-notify="icon"></span>' +
                '<div class="alert-text"</div>' +
                '<span class="alert-title" data-notify="title">{1}</span>' +
                '<span data-notify="message">{2}</span>' +
                '</div>' +
                '<button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '</div>'
        });
    };
    
    if (window._clickAppConfig.alert.success !== '') {
        window.commonNotify('top', 'center', 'far fa-thumbs-up', 'success', null, window._clickAppConfig.alert.success, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    
    if (window._clickAppConfig.alert.info !== '') {
        window.commonNotify('top', 'center', 'far fa-bell', 'info', null, window._clickAppConfig.alert.info, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    
    if (window._clickAppConfig.alert.warning !== '') {
        window.commonNotify('top', 'center', 'fas fa-exclamation-triangle', 'warning', null, window._clickAppConfig.alert.warning, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    
    if (window._clickAppConfig.alert.error !== '') {
        window.commonNotify('top', 'center', 'fas fa-bug', 'danger', null, window._clickAppConfig.alert.error, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
})(jQuery);

import List from 'list.js';

(function ($) {
    'use strict';
    
    let upgrades = window._clickAppConfig.upgrades;
    let permissions = window._clickAppConfig.permissions;
    // Permissions
    $('#split_test_nav').on('click', function () {
        if (permissions['split-test'] === 0 && upgrades['professional']['to_do']) {
            let i_html = 'Sorry, your current plan does not include Split Testing. You need to upgrade to the ' + upgrades['professional']['description'] + ' plan to use Split Testing.';
            $('#pro-plan-item-text').html(i_html);
            $('#upgrade-pro-modal').modal('show');
        } else {
            location.href = $(this).data('href');
        }
    });
    
    $('#multi_bar_nav').on('click', function () {
        if (permissions['multi-bar'] === 0 && upgrades['professional']['to_do']) {
            let i_html = 'Sorry, your current plan does not include Multi-Bars. You need to upgrade to the ' + upgrades['professional']['description'] + ' plan to use Multi-Bars.';
            $('#pro-plan-item-text').html(i_html);
            $('#upgrade-pro-modal').modal('show');
        } else {
            location.href = $(this).data('href');
        }
    });
    
    $('#upgrade-pro-btn').on('click', function () {
        let href_ids = upgrades['professional']['jvzooid'].split(',');
        if (href_ids.length > 0) {
            for (let i = 0; i < href_ids.length; i++) {
                window.open(`https://www.jvzoo.com/b/0/${href_ids[i]}/14`, '_new');
            }
        }
        $('#upgrade-pro-modal').modal('hide');
    });
    
    $('#upgrade-lead-capture-btn').on('click', function () {
        let href_ids = upgrades['lead-capture']['jvzooid'].split(',');
        if (href_ids.length > 0) {
            for (let i = 0; i < href_ids.length; i++) {
                window.open(`https://www.jvzoo.com/b/0/${href_ids[i]}/14`, '_new');
            }
        }
        
        $('#upgrade-lead-capture-modal').modal('hide');
    });
    
    $('#upgrade-social-btn').on('click', function () {
        let href_ids = upgrades['social-unlimited']['jvzooid'].split(',');
        if (href_ids.length > 0) {
            for (let i = 0; i < href_ids.length; i++) {
                window.open(`https://www.jvzoo.com/b/0/${href_ids[i]}/14`, '_new');
            }
        }
        
        $('#upgrade-social-modal').modal('hide');
    });
    
    // Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    });
    
    /**
     * Form Control Input
     */
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        let forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        let validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
    
    // Variables
    let $input = $('.form-control');
    
    // Methods
    function init($this) {
        $this.on('focus blur', function (e) {
            $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus'));
        }).trigger('blur');
    }
    
    // Events
    if ($input.length) {
        init($input);
    }
    /** === === **/
    
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
            timer: 2000,
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
        window.commonNotify('top', 'right', 'far fa-thumbs-up', 'success', null, window._clickAppConfig.alert.success, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    
    if (window._clickAppConfig.alert.info !== '') {
        window.commonNotify('top', 'right', 'far fa-bell', 'info', null, window._clickAppConfig.alert.info, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    
    if (window._clickAppConfig.alert.warning !== '') {
        window.commonNotify('top', 'right', 'fas fa-exclamation-triangle', 'warning', null, window._clickAppConfig.alert.warning, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    
    if (window._clickAppConfig.alert.error !== '') {
        window.commonNotify('top', 'right', 'fas fa-bug', 'danger', null, window._clickAppConfig.alert.error, '', 'animated fadeInDown', 'animated fadeOutUp');
    }
    /** === === **/
    
    /**
     * Table Sort
     */
        // Variables
    let $lists = $('[data-toggle="list"]');
    let $listsSort = $('[data-sort]');
    
    // Get options
    function getOptions($list) {
        return {
            valueNames: $list.data('list-values'),
            listClass: $list.data('list-class') ? $list.data('list-class') : 'list'
        };
    }
    
    // Events Init
    if ($lists.length) {
        $lists.each(function () {
            List($(this).get(0), getOptions($(this)));
        });
    }
    
    // Sort
    $listsSort.on('click', function () {
        return false;
    });
})(jQuery);

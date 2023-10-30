/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

if($(".duplicate-content").length) {
    $('.duplicate-content').each(function(e){
        let _target = $("#" + $(this).data('duplicate-target'));

        $(this).on('input', function() {
            _target.val($(this).val());
        });
    });
}

function format(item) {
    var originalOption = item.element;
    var originalText = item.text;

    if(!item.id) {
        return item.text;
    }

    return '<span style="padding-left: ' + $(originalOption).data('padding') + 'px;">' + originalText + '</span>';
}

$(function($) {
    if($().daterangepicker) {
        if($(".datepicker").length) {
            $('.datepicker').daterangepicker({
                locale: {format: 'YYYY-MM-DD'},
                singleDatePicker: true,
            });
        }

        if($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {format: 'YYYY-MM-DD HH:mm'},
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }

        if($(".daterange").length) {
            $('.daterange').daterangepicker({
                locale: {format: 'YYYY-MM-DD'},
                drops: 'down',
                opens: 'right'
            });
        }
    }
});

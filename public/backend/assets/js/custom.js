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

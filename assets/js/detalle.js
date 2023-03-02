$(document).ready(function() {
    $('.hidden').removeClass('hidden').hide();
    $('.masInfo').click(function() {
        $(this).find('span').each(function() { $(this).toggle(); });
    });
});
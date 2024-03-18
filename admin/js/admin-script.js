jQuery(document).ready(function($) {
    $('#lumiafee-settings-form').on('submit', function(e) {
        e.preventDefault();

        var data = {
            'action': 'lumiafee_save_settings',
            'nonce': $('#lumiafee_settings_nonce').val(),
            'settings': $(this).serialize()
        };

        $.post(ajaxurl, data, function(response) {
            alert('Ayarlar kaydedildi.');
        });
    });
});

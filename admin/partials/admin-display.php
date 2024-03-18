<?php
// WooCommerce ödeme yöntemlerini al
$payment_gateways = WC()->payment_gateways->payment_gateways();
$options = get_option('lumiafee_payment_fees');

echo '<div class="wrap"><h2>LumiaFee Ayarları</h2><form id="lumiafee-settings-form">';

// Nonce alanı
wp_nonce_field('lumiafee_save_settings', 'lumiafee_settings_nonce');

foreach ($payment_gateways as $gateway) {
    if ($gateway->enabled == 'yes') { // Sadece aktif ödeme yöntemleri
        $fee = isset($options[$gateway->id]) ? $options[$gateway->id] : '';
        echo '<label for="fee-' . esc_attr($gateway->id) . '">' . esc_html($gateway->get_title()) . ' Ücreti (%):</label>';
        echo '<input type="text" id="fee-' . esc_attr($gateway->id) . '" name="payment_fees[' . esc_attr($gateway->id) . ']" value="' . esc_attr($fee) . '"><br>';
    }
}

echo '<button type="submit" class="button-primary">Ayarları Kaydet</button></form></div>';


function lumiafee_save_settings() {
    // Nonce kontrolü
    check_ajax_referer('lumiafee_save_settings', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_die('Yetkiniz yok.');
    }

    $settings = isset($_POST['settings']) ? $_POST['settings'] : '';
    parse_str($settings, $settings_array);

    // Ayarları güvenli bir şekilde kaydet
    if (isset($settings_array['payment_fees'])) {
        update_option('lumiafee_payment_fees', $settings_array['payment_fees']);
        wp_send_json_success('Ayarlar kaydedildi.');
    } else {
        wp_send_json_error('Bir hata oluştu.');
    }
}
add_action('wp_ajax_lumiafee_save_settings', 'lumiafee_save_settings');

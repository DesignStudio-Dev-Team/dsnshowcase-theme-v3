<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'dsn_cta_get_languages_for_tab' ) ) {
    function dsn_cta_get_languages_for_tab(): array {
        $languages = [];

        if ( function_exists( 'dssGetLanguageOptions' ) ) {
            $syndified_languages = dssGetLanguageOptions();
            if ( is_array( $syndified_languages ) && ! empty( $syndified_languages ) ) {
                foreach ( $syndified_languages as $lang ) {
                    if ( empty( $lang['abbreviated_name'] ) ) {
                        continue;
                    }
                    $full_locale = $lang['abbreviated_name'];
                    $lang_code   = strtolower( explode( '_', $full_locale )[0] );
                    $label       = ! empty( $lang['native_name'] ) ? $lang['native_name'] : ( ! empty( $lang['language_name'] ) ? $lang['language_name'] : strtoupper( $lang_code ) );
                    $languages[ $full_locale ] = [
                        'full_locale' => $full_locale,
                        'lang_code'   => $lang_code,
                        'label'       => $label,
                    ];
                }
            }
        }

        if ( empty( $languages ) ) {
            $wpml_languages = apply_filters( 'wpml_active_languages', null );
            if ( is_array( $wpml_languages ) && ! empty( $wpml_languages ) ) {
                foreach ( $wpml_languages as $code => $lang ) {
                    $full_locale = ! empty( $lang['default_locale'] ) ? $lang['default_locale'] : ( isset( $lang['language_code'] ) ? $lang['language_code'] : $code );
                    $lang_code   = strtolower( isset( $lang['language_code'] ) ? $lang['language_code'] : $code );
                    $label       = ! empty( $lang['native_name'] ) ? $lang['native_name'] : ( ! empty( $lang['translated_name'] ) ? $lang['translated_name'] : strtoupper( $lang_code ) );
                    $languages[ $full_locale ] = [
                        'full_locale' => $full_locale,
                        'lang_code'   => $lang_code,
                        'label'       => $label,
                    ];
                }
            }
        }

        if ( empty( $languages ) ) {
            $full_locale = get_locale();
            $lang_code   = function_exists( 'dssGetSiteLanguage' ) ? dssGetSiteLanguage() : strtolower( explode( '_', $full_locale )[0] );
            $languages[ $full_locale ] = [
                'full_locale' => $full_locale,
                'lang_code'   => $lang_code,
                'label'       => strtoupper( $lang_code ),
            ];
        }

        return $languages;
    }
}

if ( ! function_exists( 'dsn_cta_current_full_locale' ) ) {
    function dsn_cta_current_full_locale(): string {
        $languages = apply_filters( 'wpml_active_languages', null );
        if ( is_array( $languages ) && ! empty( $languages ) ) {
            foreach ( $languages as $lang ) {
                if ( ! empty( $lang['active'] ) && ! empty( $lang['default_locale'] ) ) {
                    return $lang['default_locale'];
                }
            }
        }
        return get_locale();
    }
}

if ( ! function_exists( 'dsn_cta_current_lang_code' ) ) {
    function dsn_cta_current_lang_code(): string {
        if ( function_exists( 'dssGetSiteLanguage' ) ) {
            $code = dssGetSiteLanguage();
            if ( '' !== $code ) {
                return strtolower( $code );
            }
        }
        return strtolower( explode( '_', get_locale() )[0] );
    }
}

if ( ! function_exists( 'dsn_cta_get_syndified_meta_object' ) ) {
    function dsn_cta_get_syndified_meta_object( int $productID ) {
        $raw = get_post_meta( $productID, 'dss_syndified', true );
        if ( empty( $raw ) ) {
            return new stdClass();
        }
        if ( is_object( $raw ) ) {
            return $raw;
        }
        if ( is_array( $raw ) ) {
            return (object) $raw;
        }
        $decoded = json_decode( $raw );
        if ( is_object( $decoded ) ) {
            return $decoded;
        }
        return new stdClass();
    }
}

if ( ! function_exists( 'dsn_cta_get_syndified_meta_array' ) ) {
    function dsn_cta_get_syndified_meta_array( int $productID ): array {
        $raw = get_post_meta( $productID, 'dss_syndified', true );
        if ( empty( $raw ) ) {
            return [];
        }
        if ( is_array( $raw ) ) {
            return $raw;
        }
        if ( is_object( $raw ) ) {
            return (array) $raw;
        }
        $decoded = json_decode( $raw, true );
        return is_array( $decoded ) ? $decoded : [];
    }
}

if ( ! function_exists( 'dsn_cta_read_setting' ) ) {
    function dsn_cta_read_setting( array $meta, string $base, array $suffix_candidates ): string {
        $seen = [];
        foreach ( $suffix_candidates as $suffix ) {
            if ( '' === $suffix || isset( $seen[ $suffix ] ) ) {
                continue;
            }
            $seen[ $suffix ] = true;
            $key = $base . '_' . $suffix;
            if ( isset( $meta[ $key ] ) && is_string( $meta[ $key ] ) && '' !== $meta[ $key ] ) {
                return $meta[ $key ];
            }
        }
        return '';
    }
}

if ( ! function_exists( 'dsn_get_cta_button_text' ) ) {
    function dsn_get_cta_button_text( int $productID, string $full_locale = '' ): string {
        if ( $productID <= 0 ) {
            return '';
        }
        if ( '' === $full_locale ) {
            $full_locale = dsn_cta_current_full_locale();
        }
        if ( '' === $full_locale ) {
            return '';
        }
        $meta = dsn_cta_get_syndified_meta_array( $productID );
        return dsn_cta_read_setting(
            $meta,
            'dealer_cta_button_text_setting',
            [ $full_locale, strtolower( $full_locale ) ]
        );
    }
}

if ( ! function_exists( 'dsn_get_cta_form_shortcode' ) ) {
    function dsn_get_cta_form_shortcode( int $productID, string $lang_code = '' ): string {
        if ( $productID <= 0 ) {
            return '';
        }
        if ( '' === $lang_code ) {
            $lang_code = dsn_cta_current_lang_code();
        }
        if ( '' === $lang_code ) {
            return '';
        }
        $meta = dsn_cta_get_syndified_meta_array( $productID );
        return dsn_cta_read_setting(
            $meta,
            'dealer_cta_form_shortcode_setting',
            [ $lang_code, strtolower( get_locale() ) ]
        );
    }
}

add_filter( 'woocommerce_product_data_tabs', 'dsn_cta_register_product_data_tab' );
function dsn_cta_register_product_data_tab( $tabs ) {
    $tabs['dsn_showcase_cta_settings'] = [
        'label'    => __( 'DSNShowcase CTA Settings', 'dsnshowcase' ),
        'target'   => 'dsn_showcase_cta_settings_options',
        'class'    => [ 'show_if_simple', 'show_if_variable' ],
        'priority' => 65,
    ];
    return $tabs;
}

add_action( 'woocommerce_product_data_panels', 'dsn_cta_render_product_data_panel' );
function dsn_cta_render_product_data_panel() {
    global $post;

    if ( ! $post || empty( $post->ID ) ) {
        return;
    }

    $productID    = (int) $post->ID;
    $languages    = dsn_cta_get_languages_for_tab();
    $meta         = dsn_cta_get_syndified_meta_array( $productID );
    $multilingual = count( $languages ) > 1;
    ?>
    <div id="dsn_showcase_cta_settings_options" class="panel woocommerce_options_panel">
        <div class="options_group">
            <p class="form-field">
                <strong><?php esc_html_e( 'CTA Button Text Overrides', 'dsnshowcase' ); ?></strong><br>
                <span class="description">
                    <?php esc_html_e( 'Optional. Overwrites the reserve / get-info button label and title for this product. Leave empty to use the default translated label.', 'dsnshowcase' ); ?>
                </span>
            </p>
            <?php foreach ( $languages as $lang ) :
                $full_locale = $lang['full_locale'];
                $label_str   = $lang['label'];
                $value       = dsn_cta_read_setting(
                    $meta,
                    'dealer_cta_button_text_setting',
                    [ $full_locale, strtolower( $full_locale ) ]
                );
                $field_id    = 'dsn_cta_button_text_' . sanitize_key( $full_locale );
                $field_label = $multilingual
                    ? sprintf( __( 'Button Text (%s)', 'dsnshowcase' ), $label_str )
                    : __( 'Button Text', 'dsnshowcase' );
                ?>
                <p class="form-field">
                    <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $field_label ); ?></label>
                    <input
                        type="text"
                        class="short"
                        style="width: 50%;"
                        id="<?php echo esc_attr( $field_id ); ?>"
                        name="dsn_cta_button_text[<?php echo esc_attr( $full_locale ); ?>]"
                        value="<?php echo esc_attr( $value ); ?>"
                        placeholder="<?php esc_attr_e( 'Custom button text (leave empty to use default)', 'dsnshowcase' ); ?>"
                    />
                </p>
            <?php endforeach; ?>
        </div>

        <div class="options_group">
            <p class="form-field">
                <strong><?php esc_html_e( 'CTA Form Shortcode Overrides', 'dsnshowcase' ); ?></strong><br>
                <span class="description">
                    <?php esc_html_e( 'Optional. Shortcode rendered inside the Syndified CTA modal for this product. The modal itself is rendered by the Syndified plugin.', 'dsnshowcase' ); ?>
                </span>
            </p>
            <?php foreach ( $languages as $lang ) :
                $lang_code = $lang['lang_code'];
                $label_str = $lang['label'];
                $value     = dsn_cta_read_setting(
                    $meta,
                    'dealer_cta_form_shortcode_setting',
                    [ $lang_code, strtolower( $lang['full_locale'] ) ]
                );
                $field_id  = 'dsn_cta_form_shortcode_' . sanitize_key( $lang_code );
                $field_label = $multilingual
                    ? sprintf( __( 'Form Shortcode (%s)', 'dsnshowcase' ), $label_str )
                    : __( 'Form Shortcode', 'dsnshowcase' );
                ?>
                <p class="form-field">
                    <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $field_label ); ?></label>
                    <textarea
                        rows="3"
                        class="short"
                        style="width: 50%;"
                        id="<?php echo esc_attr( $field_id ); ?>"
                        name="dsn_cta_form_shortcode[<?php echo esc_attr( $lang_code ); ?>]"
                        placeholder="<?php echo esc_attr( '[gravityform id="1" title="false" description="false"]' ); ?>"
                    ><?php echo esc_textarea( $value ); ?></textarea>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

add_action( 'woocommerce_process_product_meta', 'dsn_cta_save_product_data_panel' );
function dsn_cta_save_product_data_panel( $post_id ) {
    $post_id = (int) $post_id;
    if ( $post_id <= 0 ) {
        return;
    }

    $has_button_text    = isset( $_POST['dsn_cta_button_text'] ) && is_array( $_POST['dsn_cta_button_text'] );
    $has_form_shortcode = isset( $_POST['dsn_cta_form_shortcode'] ) && is_array( $_POST['dsn_cta_form_shortcode'] );

    if ( ! $has_button_text && ! $has_form_shortcode ) {
        return;
    }

    $meta = dsn_cta_get_syndified_meta_object( $post_id );

    if ( $has_button_text ) {
        $submitted = wp_unslash( $_POST['dsn_cta_button_text'] );
        foreach ( $submitted as $full_locale => $value ) {
            $suffix = preg_replace( '/[^A-Za-z0-9_-]/', '', (string) $full_locale );
            if ( '' === $suffix ) {
                continue;
            }
            $meta->{ 'dealer_cta_button_text_setting_' . $suffix } = sanitize_text_field( (string) $value );
        }
    }

    if ( $has_form_shortcode ) {
        $submitted = wp_unslash( $_POST['dsn_cta_form_shortcode'] );
        foreach ( $submitted as $lang_code => $value ) {
            $suffix = sanitize_key( (string) $lang_code );
            if ( '' === $suffix ) {
                continue;
            }
            $meta->{ 'dealer_cta_form_shortcode_setting_' . $suffix } = (string) $value;
        }
    }

    update_post_meta( $post_id, 'dss_syndified', wp_slash( wp_json_encode( $meta ) ) );
}

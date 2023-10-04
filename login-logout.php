<?php
/**
 * Plugin Name: Login Logout Corner
 * Description: Dodaje linki logowania/wylogowania w prawym górnym rogu witryny.
 * Version: 1.0
 * Author: TraviLabs
 * License: GPL-2.0+
 */

// Prevent direct file access
defined('ABSPATH') || exit;

// Add the custom CSS to display the login/logout links in the top-right corner
function login_logout_corner_css() {
    echo "
    <style>
        #login-logout-corner {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 9999;
            font-family: Arial, sans-serif;
        }
        #login-logout-corner a {
            color: #000;
            text-decoration: none;
            background-color: #f2f2f2;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            font-size: 14px;
        }
        #login-logout-corner a:hover {
            background-color: #e6e6e6;
        }
        #login-logout-corner span.avatar-icon {
            margin-right: 5px;
        }

        /* Media queries for responsive design */
        @media (max-width: 767px) {
            #login-logout-corner {
                top: 10px;
                right: 10px;
            }
            #login-logout-corner a {
                font-size: 12px;
                padding: 8px 12px;
            }
        }

        @media (max-width: 479px) {
            #login-logout-corner {
                top: 5px;
                right: 5px;
            }
            #login-logout-corner a {
                font-size: 10px;
                padding: 6px 10px;
            }
        }
    </style>
    ";
}
add_action('wp_head', 'login_logout_corner_css');

// Add the login/logout links in the top-right corner
function login_logout_corner_links() {
    $avatar_icon = '&#128100;'; // Emoji icon for avatar

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $display_name = $current_user->display_name;
        $logout_url = wp_logout_url(home_url());

        echo '
        <div id="login-logout-corner">
            <a href="' . $logout_url . '"><span class="avatar-icon">' . $avatar_icon . '</span>Wyloguj (' . $display_name . ')</a>
        </div>
        ';
    } else {
        $login_url = home_url('/konto');

        echo '
        <div id="login-logout-corner">
            <a href="' . $login_url . '"><span class="avatar-icon">' . $avatar_icon . '</span>Zaloguj się</a>
        </div>
        ';
    }
}
add_action('wp_footer', 'login_logout_corner_links');

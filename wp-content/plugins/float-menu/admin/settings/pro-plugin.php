<?php

use FloatMenuLite\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;
?>

<div class="wpie-sidebar wpie-sidebar-features">
    <h2 class="wpie-title"><?php esc_html_e( 'PRO Functions', 'float-menu' ); ?></h2>

    <div class="wpie-fields__box">
        <details class="wpie-details-sidebar">
            <summary>Hold text open</summary>
            <p>
                When enabled, the "Hold Open" option ensures that the menu label (the text representing the
                menu) remains visible at all times, even when the user hovers away from the menu itself.
            </p>
        </details>
        <details class="wpie-details-sidebar">
            <summary>Item Types</summary>
            <div class="wpie-details-sidebar-box">
                <ul>
                    <li><strong>Link:</strong> Create a link to any page on your website. You can also choose to open
                        the link in a new window.
                    </li>
                    <li><strong>Next Post:</strong> Generate a link to the next post within the current post's category.
                    </li>
                    <li><strong>Previous Post:</strong> Generate a link to the previous post within the current post's
                        category.
                    </li>
                    <li><strong>Share:</strong> Create a link with sharing options for social media. Choose from 29
                        different social media services.
                    </li>
                    <li><strong>Translate:</strong> Offer your users the ability to translate your page in real-time.
                    </li>
                    <li><strong>Search:</strong> Create a menu item with a search field.</li>
                    <li><strong>Print:</strong> Provide a link for printing the current page.</li>
                    <li><strong>Scroll To Top:</strong> Create a smooth-scrolling link that takes users to the top of
                        the page.
                    </li>
                    <li><strong>Scroll To Bottom:</strong> Create a smooth-scrolling link that takes users to the bottom
                        of the page.
                    </li>
                    <li><strong>Smooth Scroll:</strong> Enable this option for a more pleasant user experience when
                        navigating a page with anchor links.
                    </li>
                    <li><strong>Go Back:</strong> Allow users to navigate back to the previous page in their browser
                        history.
                    </li>
                    <li><strong>Go Forward:</strong> Create a link to the next page in the user's browser history.</li>
                    <li><strong>Email:</strong> Generate a quick link that opens the user's email client to compose a
                        new email addressed to a specific address you define.
                    </li>
                    <li><strong>Telephone:</strong> Create a link that allows users to call a specific phone number.
                    </li>
                    <li><strong>Login:</strong> Create a link to your site's login page.</li>
                    <li><strong>Logout:</strong> Create a link for users to log out if they are currently logged in.
                    </li>
                    <li><strong>Lost Password:</strong> Create a link to the password reset page for users.</li>
                    <li><strong>Register:</strong> Create a link to the user registration page on your site.</li>
                    <li><strong>Open Popup:</strong> Generate a link that opens a popup created by the plugin.</li>
                    <li><strong>Extra Text:</strong> Display a custom information text box for your users.</li>
                </ul>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Icons</summary>
            <div class="wpie-details-sidebar-box">
                <ul>
                    <li><strong>Set Font Awesome Icon:</strong> Choose an icon from the Font Awesome library and
                        optionally set an animation for the icon.
                    </li>
                    <li><strong>Custom Icon:</strong> Set a custom icon using a URL to the image or by defining a class
                        for the icon if you're using a font icon set other than Font Awesome.
                    </li>
                    <li><strong>Text:</strong> Use a letter or emoji as the icon. This can be a great alternative to
                        Font Awesome icons.
                    </li>
                </ul>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Google Events Tracking</summary>
            <div class="wpie-details-sidebar-box">
                <p>Integrate Google Events Tracking to monitor user interactions with your menu items. You'll need to
                    have Google Analytics tracking code installed on your site to use this feature.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Hide/Show</summary>
            <div class="wpie-details-sidebar-box">
                <ul>
                    <li><strong>Show After Position:</strong> Control when the menu becomes visible after the user
                        scrolls down the page (in pixels).
                    </li>
                    <li><strong>Hide After Position:</strong> Control when the menu hides as the user scrolls up the
                        page (in pixels).
                    </li>
                </ul>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Sub Menu</summary>
            <div class="wpie-details-sidebar-box">
                <p>By grouping related items under submenu, you can improve user experience by making navigation more
                    intuitive and organized. Users can easily find the specific information they need without feeling
                    overwhelmed by a long list of top-level menu items.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Display Rules</summary>
            <div class="wpie-details-sidebar-box">
                <p>Control exactly where your menus appear using shortcodes, page types, post categories/tags, author
                    pages, and date archives.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Devices Rules</summary>
            <div class="wpie-details-sidebar-box">
                <p>Ensure optimal menu visibility across all devices with options to hide/remove on specific screen
                    sizes.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Multilingual Support</summary>
            <div class="wpie-details-sidebar-box">
                <p> For websites catering to a global audience, Float Menu Pro allows you to restrict menu visibility to
                    specific languages. This ensures users only see menus relevant to their chosen language setting.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>User Role Permissions</summary>
            <div class="wpie-details-sidebar-box">
                <p>Define which user roles (e.g., Administrator, Editor, Author) have the ability to see the menu items.
                    This can be helpful for displaying internal menus relevant only to website administrators or
                    managing menus for specific user groups.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Scheduling</summary>
            <div class="wpie-details-sidebar-box">
                <p>Schedule menu appearances based on specific days, times, and dates. This allows you to promote
                    temporary events or campaigns without cluttering your website permanently.</p>
            </div>

        </details>
        <details class="wpie-details-sidebar">
            <summary>Create Popup</summary>
            <div class="wpie-details-sidebar-box">
                <p>Configure popups that open upon clicking on menu items.</p>
            </div>

        </details>
        <a href="<?php echo esc_url( WOWP_Plugin::info( 'pro' ) ); ?>" target="_blank">Read More about PRO</a>
    </div>
</div>

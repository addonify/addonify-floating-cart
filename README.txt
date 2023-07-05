=== Addonify Floating Cart For WooCommerce ===

Contributors: addonify
Tags: cart, woocommerce, woocommerce cart, floating cart, side cart, woo cart, woocommerce floating cart, woocommerce side cart, ajax cart
Requires at least: 5.9 or higher
Requires PHP: 7.4
Tested up to: 6.2.2
Stable tag: 1.1.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Addonify Floating Cart is a free WooCommerce addon that adds an interactive sticky shopping cart on your website allowing your visitors no need to go to cart page to manage their cart items. 

== Description ==

Addonify Floating Cart is a free WooCommerce addon that adds an interactive sticky shopping cart on your website allowing your visitors no need to go to cart page to manage their cart items. 

Addonify Floating Cart is packed with lots of features and functionalities. The necessary cart actions such as adding product into the cart, removing product from the cart with undo functionality, updating cart quantities, applying coupon discounts etc. The sidebar shopping cart can be toggled on floating cart button click, or Add to Cart button click, or toast notification button click, or View Cart button click.

For vistors attention, display toast notification when a product is added into the cart and display shopping cart when clicked on it. Also to provide information on the schemes that you have created to engage visitors, display shopping meter with targeted amount and interactive custom text.

🌍 [Live Demo Preview](https://demo.addonify.com/woo/01/floating-cart/)
📋 [Documentation Guide](https://docs.addonify.com/kb/floating-cart/)


#### 🔥 MAIN FEATURES

- Fully ajaxed cart. No page reloads when adding, removing, or updating cart items quantities.
- Adjust floating cart trigger button position.
- Choose floating cart trigger button icon from the list of 7+ icons.
- Adjust floating cart product count badge position.
- Manage product quantities in the shopping cart.
- Display number of products in the shopping cart.
- Undo product removal in shopping cart.
- Shopping meter with targeted amount and custom text. 
- Shopping meter progress bar animation.
- Custom labels for cart drawer/modal text elements.
- Apply coupons, display applied coupons, remove applied coupons, and display coupon messages.
- Sidebar cart display position.
- Toast notification when product is added into the cart.
- Open cart when product is added to the WooCommerce cart.
- Choose shipping address and calculate shipping cost in the cart.
- Supports TAX calculation in the cart.
- Supports all WooCommerce product types.
- Responsive design.
- Custom typography and color options.
- Display cart subtotal amount, discount amount, and total amount in the cart.
- Choose between close and cart page redirect action on button click.
- Custom CSS support.
- User and developer documentation.

#### 🎨 COLOR & CUSTOMIZATION

- Cart toggle button color & typography options.
- Toast notification color options.
- Cart drawer/modal color options.
- Product in cart color options.
- Misc elements inside cart color options.


#### 🔐 GDPR COMPLIANT

Addonify Floating Cart does not collect any personal or sensitive data from website visitors thus making this plugin GDPR compliant.


#### 💬 DISCUSSIONS & REPORTINGS

We are open to any kind of discussions  that can help improve this plugin. Share your ideas, ask questions related to the plugin, report bugs or issues, and request for new features.

👉 [Create New Discussion](https://github.com/addonify/addonify-floating-cart/discussions)
👉 [Report Bug or Issue](https://github.com/addonify/addonify-floating-cart/issues)


####  🌐 TRANSLATIONS

If you wish Addonify Floating Cart to be translated in your language, feel free to contribute translating at [*transalte.wordpress.org*](https://translate.wordpress.org/projects/wp-plugins/addonify-floating-cart) directly.


== Frequently Asked Questions ==

= Do you have documentation guide? =

Yes, we do have documentation guide. Please visit our [documentation site.](https://docs.addonify.com/kb/floating-cart/)

= Will this plugin work without WooCommerce? =

No, this plugin will not work without WooCommerce.

= Does this plugin work with my theme? =

Yes, Addonify Floating Cart should work with all WordPress themes. If it does not work with your theme, let us know by [*creating an issue*](https://github.com/addonify/addonify-floating-cart/issues)

= On which page floating cart will not be visible? =

Floating cart button and sidebar shopping cart will not be visible on cart and checkout pages.

 
== Installation ==

1. Download the plugin.
2. Unzip the downloaded zip file.
3. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
4. Activate `Addonify Floating Cart` from Dashboard > Plugins.


== Screenshots ==

1. Addonify Floating Cart setting page on admin dashboard.
2. Addonify Floating Cart design setting page on admin dashboard.
3. Floating Cart drawer on frontend.
4. Floating Cart discount section on frontend.


== Changelog ==

= 1.1.9 - ? July, 2023 =

- Removed: Option `open_cart_modal_on_notification_button_click` from plugin settings page.
- Refactored: Public facing JavaScript code.

= 1.1.8 - 27 June, 2023 =

- Added: Shopping meter progress bar animation. 
- Tweak: Cart trigger button style.

= 1.1.7 - 01 June, 2023 =

- Tweak: How reactive state on plugin setting's page is managed (vue js).

= 1.1.6 - 12 May, 2023 =

- Fix: Badge position setting not working in cart modal toggle button #190
- Fix: Shopping meter enabled by default #191
- Fix: Error in saving settings.

= 1.1.5 - 10 May, 2023 =

- Added: Color options for icon in toast notification.
- Added: Option for selecting icon for cart modal toggle button.
- Fix: Incorrect use of "for" attribute in label element. Ref: https://wordpress.org/support/topic/incorrect-use-of/

= 1.1.4 - 6 May, 2023 =

- Update: Variable product name with attributes in cart modal.
- Update: Product permalink in cart modal.


= 1.1.3 - 4 May, 2023 =

- Fix: Issue with attribute name of variable product.


= 1.1.2 - 3 May, 2023 = 

- Tweak: Load admin CSS using wp_enqueue_style only on the floating cart setting page.
- Fixed: Issue of values of fields in `Cart Drawer/Modal Labels` not getting displayed. [GitHub Issue #161](https://github.com/addonify/addonify-floating-cart/issues/161)
- Added: New setting, `Action of Button before Checkout Button`, to switch between modal close and cart open on button click action. [GitHub Issue #158](https://github.com/addonify/addonify-floating-cart/issues/158)
- Updated: Renamed settings, `Cart Close Button Label` to `Label of Button before Checkout Button` and `Display Cart Close Button` to `Display Button before Checkout Button`.
- Tweak: Load admin CSS using wp_enqueue_style only on the floating cart setting page.
- Tweak: Class of the button before checkout button changed from `close` to `secondary`.


= 1.1.1 - 20 April, 2023 = 

- Added: Option for showing product type count or products quantities in floating cart badge.
- Update: Refresh cart after page load for fragments cache related issues.


= 1.1.0 - 13 April, 2023 =

- Fixed: Threshold and subtotal calculation mismatch issue.


= 1.0.9 - 12 April, 2023 =

- Added: Option to calculate shipping meter threshold amount include/excluding discount amount.
- Added: Mutation observer on cart & init Perfect scrollbar.
- Fixed: Issue with perfect scrollbar library.


= 1.0.8 - 16 March, 2023 =

- Update: Static texts in UDP Agents are now translation ready.
- Removed: Option for showing/hiding tax at cart footer section.
- Removed: Option for show/hide shipping calculation in floating cart. Shippping option now works with woocommerce options.
- Added: Option for compare Shopping Meter Threshold with Subtotal Before or After Discount.


= 1.0.7 - 03 March, 2023 =

- Fixed: Discount and subtotal not showing properly, shipping showing dash when shipping is free.
- Fixed: Shipping section not updated on coupon update.
- Update: Shipping now shows 0 instead of free when shipping is 0.
- Update: Spinner added for cart, hovers the whole cart instead of single product.
- Update: Different sections for Cart options and labels in admin settings page.
- Update: Shows '-' instead of 0 when no shipping option is selected.
- Update: UDP agent updated to v1.0.1.


= 1.0.6 - 24 January 2022 =

- Added: Recommended products in floating cart setting page.


= 1.0.5 - 18 November 2022 =

- Improvement: Color picker in settings page.


= 1.0.4 - 03 November 2022 =

- Fix: Actual name not showing in coupon applied section fixed
- Fix: Actual message not showing in coupon page fixed
- Added: Integrated UDP.


= 1.0.3 - 18 September 2022 =

- Tweak: Number of unique items displayed on badges.
- Tweak: Position of quantity increase and decrease button has changed.
- Fix: Minor fix.


= 1.0.2 - 15 September 2022 =

- Tweak: blockUI overlay background color in cart.
- Fix: HTML print issue in cart total.


= 1.0.1 - 13 September 2022 =

- Updated: Data sanitization, escape, and validation.


= 1.0.0 - 11 September 2022 =

- New: Initial release.
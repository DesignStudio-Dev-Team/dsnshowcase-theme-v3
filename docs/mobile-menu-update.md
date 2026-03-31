# New Mobile Menu — DSNShowcase Theme Update Guide

## Overview

The mobile menu submodule lives at `mobile-menu/` inside the theme. DSNShowcase header files use WordPress's `get_template_part()` to pull in the mobile bar, so child theme overrides work automatically through WordPress's template hierarchy.

---

## How the theme is wired

| File | Purpose |
|------|---------|
| `functions.php` | Loads the submodule: `require_once DSN_THEME_DIR . '/mobile-menu/mobile-menu.php';` |
| `templates/mobile-header.php` | Mobile bar template (logo + trigger). Shared by all header layouts. |
| `templates/header_1.php` … `header_5.php`, `header_syndified.php` | Each calls `get_template_part('templates/mobile-header')` at the point where the mobile bar appears. |

The theme uses a `dsn:` Tailwind prefix. Desktop sections are hidden on mobile with `hidden dsn:lg:block` (or `absolute hidden dsn:lg:block` depending on the header layout).

---

## Updating a site with no child theme

No per-site file changes needed. Update via the WordPress dashboard:

- Go to **Appearance → Themes** and click **Update** if an update is available, or
- Upload the new theme zip via **Appearance → Themes → Add New → Upload Theme**.

Verify settings under **Appearance → Customize → Mobile Menu** after updating.

---

## Updating a site with a child theme

Child theme files take priority over the parent. Any header file copied into the child theme must be updated manually.

### 1. Find which header files the child theme overrides

Check `wp-content/themes/{child-theme}/templates/` for any `header_*.php` files. Only those need updating — the rest inherit from the parent automatically.

### 2. Update each overridden header file

Check the corresponding header file in the parent theme (`templates/header_*.php`) to see exactly where `get_template_part( 'templates/mobile-header' )` is placed and what surrounds it. Use that as the reference for positioning it correctly in the child theme file, keeping any custom styles or markup the child theme adds.

1. Find the old mobile section — typically a `dsn:lg:hidden` wrapper containing a `dsMobileMenuIcon` and `dsMobileMenu` block.
2. Replace the entire block with:
   ```php
   <?php get_template_part( 'templates/mobile-header' ); ?>
   ```
3. Confirm the desktop wrapper uses `hidden dsn:lg:block` so it does not render on mobile.

### 3. Remove old mobile JavaScript

Remove from the child header file:

- The `bodymovin.loadAnimation(…)` block and its click handler toggling `.dsMobileOpen`
- Any `$("#open-search-mobile")` / `$("#close-search-mobile")` handlers

### 4. Overriding mobile-header.php in the child theme

While it is technically possible to override the mobile bar by creating `{child-theme}/templates/mobile-header.php` (WordPress's `get_template_part()` checks the child theme first), this should be a last resort. Before doing so, inform the dev team — the goal is a standardised approach across all sites, and any new feature or variation is better built into the shared submodule so every theme benefits from it.

---

## CSS customisation

Colours are applied automatically via `wp_add_inline_style` in `functions.php`, which reads these ACF option fields (set under **Theme Settings → Mobile Menu**):

| ACF field | Drives | Fallback |
|-----------|--------|---------|
| `mobile_menu_bg` | `--dsn-mm-panel-bg`, `--dsn-mm-trigger-color` | `#333333` |
| `mobile_link_color` | `--dsn-mm-item-text` | `#ffffff` |

No manual CSS is needed as long as the ACF fields are set. If you need to override for a specific site, use **Customizer → Additional CSS** as a last resort:

```css
:root {
  --dsn-mm-panel-bg:      #your-colour;
  --dsn-mm-trigger-color: #your-colour;
  --dsn-mm-item-text:     #ffffff;
}
```

---

## Customizer settings

**Appearance → Customize → Mobile Menu**

| Setting | Description |
|---------|-------------|
| Header layout | Side by side or Stacked |
| Logo size | Small / Medium / Large / Extra large |
| Show search icon | Toggles search button |
| Show cart icon | Requires WooCommerce |
| Show account icon | Requires WooCommerce |
| Show language switcher | Toggles the WPML language switcher icon. This setting only appears in the Customizer when WPML is active. The icon renders only when WPML is active **and** at least 2 languages are configured. |

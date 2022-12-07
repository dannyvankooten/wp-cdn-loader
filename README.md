This repository moved to https://git.sr.ht/~dvko/wp-cdn-loader on 2022-12-07 :warning: 

---

# CDN Loader for WordPress

Simple plugin that will load all public assets from a CDN instead of your local server.

### Usage
1. Install the plugin
2. Define the following constant in your `wp-config.php`
```php
define( 'DVK_CDN_URL', '//xxxxxx.cloudfront.net' );
```

The plugin won't replace assets when `SCRIPT_DEBUG` is enabled.

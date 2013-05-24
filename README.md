# WP Blank Theme

This is a blank html5/responsive theme. [HTML5 Blank](http://html5blank.com/) Using this as starting point. I rewrote the resposniveness to breakpoints instead of fluid.

## Important Notes ##
This repo contains a submodule (a repo within a repo) of [WP-Options-Panel](https://github.com/owldesign/WP-Blank-Options-Panel). If you dont want to use the Options Panel just remove the ```options``` directory and in your ```functions.php``` remove the the following snippet.

```php
if(!class_exists('VG_Options')){
  require_once( dirname( __FILE__ ) . '/options/vg-options.php' );
}
```

## Features ##

* 4 State Responsive Grid Layout [The Four States of Responsive Web Design](http://astronautweb.co/2012/01/responsive-web-design-four-states/)
* Widescreen - 1280px
* Standard - 960px
* Tablet - 768px
* Mobile - 320px
* Other HTML5 stuff, check [HTML5 Blank](http://html5blank.com/)
# Post Format UI
Admin post format inteface for Wordpress

###Quick Install
1. Download the latest release of Post Format UI
2. Install using WordPress built-in Add New Plugin installer
3. Activate the plugin

###Use in theme

Video Post Format:
```sh
<?php if ( has_post_format( 'video' )) : ?>
<?php echo wp_oembed_get(get_post_meta($post->ID, '_pfui_video', true)); ?>
<?php endif ?>
```
Audio Post Format:
```sh
<?php if ( has_post_format( 'audio' )) : ?>
<?php echo wp_oembed_get(get_post_meta($post->ID, '_pfui_audio', true)); ?>
<?php endif ?>
```
Gallery Post Format:
```sh
<?php if ( has_post_format( 'gallery' )) : ?>
<?php
$images = get_post_meta($post->ID, '_pfui_gallery', true);
if ($images) {
foreach ($images as $image) {
$thumbnail = wp_get_attachment_image_src($image, 'thumbnail');
echo '<img src="'. $thumbnail[0] .'">';
}
}
?>
<?php endif ?>
```
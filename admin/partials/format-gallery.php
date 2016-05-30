<table class="form-table pfui-table">
  <tbody>
    <tr>
      <th>
        <label class="pfui-title" for="pfui-text-field-gallery"><?php _e( 'Add/Edit Gallery', 'pfui' ); ?></label>
        <p class="pfui-description"><?php _e('Create gallery, change order, add new and remove images in your gallery.','pfui'); ?></p>
      </th>
      <td>
        <div class="pfui-gallery">
          <?php 
            
            $images = get_post_meta($post->ID, '_pfui_gallery', true);
       
            if ($images) {
              foreach ($images as $image) {
                $thumbnail = wp_get_attachment_image_src($image, 'thumbnail');
                echo '<figure class="pfui-thumbnail" data-id="'. $image .'">
                <div class="pfui-delete-thumbnail"><i class="dashicons dashicons-no-alt"></i></div><img src="'. $thumbnail[0] .'"></figure>';
              }
            }
          ?>
        </div>
        <button type="button" class="pfui-gallery-add-images button button-primary"><?php _e( 'Add/Edit Gallery', 'pfui' ); ?></button>
        <input type="hidden" name="pfui_gallery_field" id="pfui-text-field-gallery" value="<?php echo (empty($images) ? "" : implode(',', $images)); ?>">
      </td>
    </tr>
  </tbody>
</table>
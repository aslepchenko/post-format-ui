<table class="form-table pfui-table">
    <tbody>
        <tr>
            <th>
                <label class="pfui-title" for="pfui-text-field-audio"><?php _e( 'Insert URL', 'pfui' ); ?></label>
                <p class="pfui-description"><?php _e('Complete list of audio that can be embedded, you can find here: ','pfui'); ?><a href="http://codex.wordpress.org/Embeds" target="_blank">Wordpress Embeds</a></p>
            </th>
            <td>
                <textarea name="pfui_audio_field" id="pfui-text-field-audio" cols="30" rows="10"><?php echo esc_textarea(get_post_meta($post->ID, '_pfui_audio', true)); ?></textarea>
            </td>
        </tr>
    </tbody>
</table>
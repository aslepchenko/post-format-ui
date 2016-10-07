(function($) {
    'use strict';

    $(function() {
        var pfui_gallery = (function() {

            //open wordpress media
            var openFrame = function() {
                var frame = wp.media({
                    title: pfui.media_title,
                    library: {
                        type: 'image'
                    },
                    button: {
                        text: pfui.media_button
                    },
                    multiple: true
                });
                frame.open().state().on('select', getSelectedItems);
            };

            // get selected images and render on page
            var getSelectedItems = function() {
                var selection = this.get('selection');
                selection.each(function(attachment) {
                    attachment = attachment.toJSON();
                    $('.pfui-gallery').append("<figure class='pfui-thumbnail' data-id=" + attachment.id + "><div class='pfui-delete-thumbnail'><i class='dashicons dashicons-no-alt'></i></div><img src=" + attachment.sizes.thumbnail.url + "></figure>");
                });
                updateItems();
            };

            // update array after add or change sort thumbnails
            var updateItems = function() {
                var ids = [];
                $('.pfui-thumbnail').each(function() {
                    ids.push($(this).data('id'));
                });
                $('input[name="pfui_gallery_field"]').val(ids);
                console.log(ids);
            };

            //remove images
            var removeItems = function() {
                $(this).parent().remove();
                updateItems();
            };

            //make images sortable
            var sortItems = function() {
                if ($('#pfui-gallery').hasClass('pfui-gallery')) {
                    $('.pfui-gallery').sortable({
                        placeholder: "pfui-sortable-placeholder",
                        stop: function() {
                            updateItems();
                        }
                    });
                }
            };

            var bind = function() {
                $('.pfui-gallery-add-images').on('click', openFrame);
                $('.pfui-gallery').on('click', '.pfui-delete-thumbnail', removeItems);
            };

            var init = function() {
                bind();
                sortItems();
            };
            return {
                init: init
            }
        }());

        var pfui_switch = (function() {

            var hide = function() {
                $('#pfui-gallery').css('display', 'none');
                $('#pfui-video').css('display', 'none');
                $('#pfui-audio').css('display', 'none');
            };
            var checked = function() {
                var checkedVal = $('#post-formats-select input:checked').val();
                $('#pfui-' + checkedVal).css('display', 'block');
            };
            var bind = function() {
                $('#post-formats-select input').on('change', function() {
                    hide();
                    var val = $(this).val();
                    $('#pfui-' + val).css('display', 'block');
                });
            };
            var init = function() {
                checked();
                bind();
            };
            return {
                init: init
            }

        }());

        pfui_gallery.init();
        pfui_switch.init();

    });

})(jQuery);

jQuery(document).ready(function($) {
    
    // Main Content Type Logic
    var $contentType = $('#hasht_content_type');
    var $sections = $('.hasht-conditional-section');

    function updateFields() {
        var selectedType = $contentType.val();
        
        // Hide all conditional sections first
        $sections.hide();
        
        // Show the relevant section
        $('.hasht-conditional-section[data-show-if="' + selectedType + '"]').show();
    }

    // Video Source Type Logic
    var $videoSourceRadios = $('input[name="_news_video_source_type"]');
    var $videoSubSections = $('.hasht-sub-conditional');

    function updateVideoFields() {
        var selectedSource = $('input[name="_news_video_source_type"]:checked').val();
        
        $videoSubSections.hide();
        $('.hasht-sub-conditional[data-show-sub-if="' + selectedSource + '"]').show();
    }

    // Initialize
    if ($contentType.length) {
        updateFields();
        $contentType.on('change', updateFields);
    }

    if ($videoSourceRadios.length) {
        updateVideoFields();
        $videoSourceRadios.on('change', updateVideoFields);
    }

    // Media Uploader Logic (PDF)
    var frame;
    var $uploadBtn = $('#hasht_upload_pdf_btn');
    var $removeBtn = $('#hasht_remove_pdf_btn');
    var $urlInput = $('#hasht_publication_file_url');
    var $idInput = $('#hasht_publication_file_id');

    // Toggle remove button visibility
    function toggleRemoveButton() {
        if ($idInput.val()) {
            $removeBtn.removeClass('hidden');
            $uploadBtn.text('تغییر فایل');
        } else {
            $removeBtn.addClass('hidden');
            $uploadBtn.text('انتخاب / آپلود PDF');
        }
    }
    toggleRemoveButton();

    $uploadBtn.on('click', function(e) {
        e.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'انتخاب فایل نشریه (PDF)',
            button: {
                text: 'استفاده از این فایل'
            },
            library: {
                type: 'application/pdf' // Limit to PDF
            },
            multiple: false
        });

        // When an image is selected in the media frame...
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            
            // Check file size (50MB = 52428800 bytes)
            if (attachment.filesizeInBytes > 52428800) {
                alert('حجم فایل انتخاب شده بیشتر از ۵۰ مگابایت است.');
                return;
            }

            $urlInput.val(attachment.url);
            $idInput.val(attachment.id);
            toggleRemoveButton();
        });

        // Finally, open the modal on click
        frame.open();
    });

    $removeBtn.on('click', function(e) {
        e.preventDefault();
        $urlInput.val('');
        $idInput.val('');
        toggleRemoveButton();
    });

    // Gallery Logic
    var galleryFrame;
    var $galleryBtn = $('#hasht_add_gallery_btn');
    var $galleryInput = $('#hasht_gallery_images');
    var $galleryPreview = $('#hasht_gallery_preview');

    $galleryBtn.on('click', function(e) {
        e.preventDefault();

        // If the media frame already exists, reopen it.
        if (galleryFrame) {
            galleryFrame.open();
            return;
        }

        // Create a new media frame
        galleryFrame = wp.media({
            title: 'انتخاب تصاویر گالری',
            button: {
                text: 'افزودن به گالری'
            },
            library: {
                type: 'image'
            },
            multiple: true
        });

        // Pre-select existing images
        galleryFrame.on('open', function() {
            var selection = galleryFrame.state().get('selection');
            var ids = $galleryInput.val().split(',');
            ids.forEach(function(id) {
                if(id) {
                    var attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add( attachment ? [ attachment ] : [] );
                }
            });
        });

        // When images are selected...
        galleryFrame.on('select', function() {
            var selection = galleryFrame.state().get('selection');
            var ids = [];
            $galleryPreview.empty();

            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                ids.push(attachment.id);
                
                // Add to preview
                var imgUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                var item = $('<div class="hasht-gallery-item" data-id="' + attachment.id + '" style="position: relative; width: 80px; height: 80px;">' +
                             '<img src="' + imgUrl + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">' +
                             '<span class="remove-image" style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 18px; height: 18px; text-align: center; line-height: 16px; cursor: pointer; font-size: 12px;">×</span>' +
                             '</div>');
                $galleryPreview.append(item);
            });

            $galleryInput.val(ids.join(','));
        });

        galleryFrame.open();
    });

    // Remove Image Logic
    $galleryPreview.on('click', '.remove-image', function() {
        var item = $(this).parent();
        var idToRemove = item.data('id');
        var currentIds = $galleryInput.val().split(',');
        
        // Remove id
        currentIds = currentIds.filter(function(id) {
            return id != idToRemove;
        });
        
        $galleryInput.val(currentIds.join(','));
        item.remove();
    });

});

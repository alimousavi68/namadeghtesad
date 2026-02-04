<?php
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    /**
     * Hasht Theme CLI Commands
     */
    class Hasht_CLI {
        /**
         * Regenerates images and cleans up old sizes.
         *
         * ## EXAMPLES
         *
         *     wp hasht regenerate_images
         *
         */
        public function regenerate_images( $args, $assoc_args ) {
            WP_CLI::line( 'Starting image regeneration for Namad Eghtesad...' );
            
            // Get all attachments
            $attachments = get_posts( [
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ] );

            $count = count( $attachments );
            
            if ( $count === 0 ) {
                WP_CLI::success( 'No images found to regenerate.' );
                return;
            }

            $progress = \WP_CLI\Utils\make_progress_bar( 'Regenerating images', $count );

            foreach ( $attachments as $attachment_id ) {
                $full_path = get_attached_file( $attachment_id );
                
                if ( ! file_exists( $full_path ) ) {
                    $progress->tick();
                    continue;
                }

                // 1. Regenerate metadata (creates new sizes)
                $metadata = wp_generate_attachment_metadata( $attachment_id, $full_path );
                if ( is_wp_error( $metadata ) ) {
                    WP_CLI::warning( "Failed to regenerate metadata for attachment ID: $attachment_id" );
                } else {
                    wp_update_attachment_metadata( $attachment_id, $metadata );
                    
                    // 2. Cleanup old sizes
                    // Only run cleanup if metadata regeneration was successful to avoid data loss
                    $this->cleanup_old_sizes($attachment_id, $full_path, $metadata);
                }
                
                $progress->tick();
            }

            $progress->finish();
            WP_CLI::success( 'Images regenerated and cleaned up successfully!' );
        }

        /**
         * Delete image files that are no longer registered in the metadata.
         */
        private function cleanup_old_sizes($attachment_id, $full_path, $metadata) {
            $dir = dirname($full_path);
            $filename = basename($full_path);
            $file_info = pathinfo($filename);
            
            // Handle edge case where file has no extension
            if (!isset($file_info['extension'])) {
                return;
            }
            
            $ext = $file_info['extension'];
            $base_name = $file_info['filename'];

            // Get list of all files in directory
            $files = scandir($dir);
            if (!$files) return;

            // Collect currently active files from metadata
            $active_files = [];
            $active_files[] = $filename; // Original file

            if (isset($metadata['sizes']) && is_array($metadata['sizes'])) {
                foreach ($metadata['sizes'] as $size) {
                    if (isset($size['file'])) {
                        $active_files[] = $size['file'];
                    }
                }
            }

            // Find files that look like generated thumbnails of this image
            // Pattern: base_name-WIDTHxHEIGHT.ext
            // We use a regex that matches the standard WP suffix pattern
            $pattern = '/^' . preg_quote($base_name, '/') . '-\d+x\d+\.' . preg_quote($ext, '/') . '$/i';

            foreach ($files as $file) {
                if (preg_match($pattern, $file)) {
                    // If this file is NOT in the active list, delete it
                    if (!in_array($file, $active_files)) {
                        $file_to_delete = $dir . '/' . $file;
                        if (file_exists($file_to_delete)) {
                            @unlink($file_to_delete);
                            // Optional: Log deletion if verbose mode (not implemented here)
                        }
                    }
                }
            }
        }
    }

    WP_CLI::add_command( 'hasht', 'Hasht_CLI' );
}

<?php

namespace SnapWizard\Helpers;

use WP_Error;
use WP_REST_Request;
use WP_Query;
use Exception;
use Monolog\Logger;
use Lablnet\Encryption;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplayException;

class FeedProcessor
{
    public ?Logger $logger;
    public TokenManager $tokenManager;

    public function __construct(TokenManager $tokenManager, ?Logger $logger = null)
    {
        $this->logger = $logger;
        $this->tokenManager = $tokenManager;
    }

    /**
     * @param WP_REST_Request $request
     * @return string
     *
     * @throws InstagramBasicDisplayException
     * @throws Exception
     */
    public function snapwizard_process_ig_feed_url( WP_REST_Request $request ): string
    {
        if( WP_DEBUG ) { $this->logger->info('Start processing'); }

        $snapWizardAppId = get_option( 'snapwizard_app_id' );
        $snapWizardSecretKey = get_option( 'snapwizard_secret_key' );
        $snapWizardToken = get_option( 'snapwizard_crypted_token' );
        $snapWizardLimitPerPage = get_option( 'snapwizard_limit_per_page' );
        $snapWizardExclude = get_option( 'snapwizard_exclude' );
        $snapwizardAuthor = get_option( 'snapwizard_author' );
        $snapwizardPostCategories = get_option( 'snapwizard_post_categories' );
        $snapwizardMediaCategories = get_option( 'snapwizard_media_categories' );
        $snapWizardFileType = get_option( 'snapwizard_file_type' );
//        $snapWizardProcessingType = get_option( 'snapwizard_processing_type' );
        $snapWizardLastRefreshingToken = get_option( 'snapwizard_last_refreshing_token' );

        if( WP_DEBUG ) { $this->logger->info('All settings loaded'); }

        if ( ! $snapWizardToken ) {
            if( WP_DEBUG ) { $this->logger->error('Missing token!'); }

            return json_encode([
                'response' => 'error',
                'message' => 'Missing token!',
            ]);
        }

        // Security check
        $parameters = $request->get_query_params();
        if ($parameters['appid'] !== $snapWizardAppId) {
            if( WP_DEBUG ) { $this->logger->error('App ID mismatch!'); }

            return json_encode([
                'response' => 'error',
                'message' => 'App ID mismatch!',
            ]);
        }

        if( WP_DEBUG ) { $this->logger->info('Security check passed'); }

        // Decrypt the token
        $encryption = new Encryption( $snapWizardSecretKey );
        $decryptedToken = $encryption->decrypt( $snapWizardToken );

        if( WP_DEBUG ) { $this->logger->info('Token decrypted'); }

        // IG Basic Display Object
        $instagram = new InstagramBasicDisplay( $decryptedToken );

        // Set user access token for the connection
        $instagram->setAccessToken( $decryptedToken );

        if( WP_DEBUG ) { $this->logger->info('InstagramBasicDisplay called successfully'); }

        // Get the media from user profile
        $userMedia = $instagram->getUserMedia('me', $snapWizardLimitPerPage );

        $mediaList = $userMedia->data ?? [];
//echo "<pre>";
//print_r($userMedia->data);
//echo "</pre>";
//echo "<pre>";
//print_r($userMedia);
//echo "</pre>";
//die();

        // caption
        // id
        // media_type
        // media_url
        // permalink
        // thumbnail_url (only for video)
        // timestamp
        // username

        if(isset($userMedia->error))
        {
            if( WP_DEBUG ) { $this->logger->error($userMedia->error->message); }

            return json_encode([
                'response' => 'error',
                'message' => $userMedia->error->message,
            ]);
        }

        // Start pagination
        if( WP_DEBUG ) { $this->logger->info('Start pagination calls'); }

        $paging = true;
        $moreMedia = $instagram->pagination($userMedia);

        $mediaList = array_merge($mediaList, $moreMedia->data);

        if(isset($moreMedia->error))
        {
            if( WP_DEBUG ) { $this->logger->error($moreMedia->error->message); }

            return json_encode([
                'response' => 'error',
                'message' => $moreMedia->error->message,
            ]);
        }

        while ($paging) {
            if (isset($moreMedia->paging->next)) {

                $moreMedia = $instagram->pagination($moreMedia);

                if(isset($moreMedia->error))
                {
                    if( WP_DEBUG ) { $this->logger->error($moreMedia->error->message); }

                    return json_encode([
                        'response' => 'error',
                        'message' => $moreMedia->error->message,
                    ]);
                }

                $mediaList = array_merge($mediaList, $moreMedia->data);

                if( WP_DEBUG ) { $this->logger->info('Pagination calling...', ['next' => $moreMedia->paging->next ?? null]); }
            } else {
                $paging = false;

                if( WP_DEBUG ) { $this->logger->info('Stop pagination calls'); }
            }
        }

//        echo "<pre>";
//        print_r($mediaList);
//        echo "</pre>";
//        die();

        // Prepare some values
        $snapWizardExcludeList = explode(PHP_EOL, $snapWizardExclude);

        if ($snapwizardPostCategories === '') {
            $snapwizardPostCategories = [];
        }
        if ($snapwizardMediaCategories === '') {
            $snapwizardMediaCategories = [];
        }

        // ========================================
        // START PROCESSING ALL THE MEDIA FROM FEED
        // ========================================
        foreach ( $mediaList as $media ) {

            if ($snapWizardFileType === Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_SELECT_ONLY_IMAGES) {
                if ( $media->media_type !== Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_IMAGE ) {
                    continue;
                }
            }

            if ($snapWizardFileType === Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_SELECT_ONLY_CAROUSEL_ALBUM) {
                if ( $media->media_type !== Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_CAROUSEL_ALBUM ) {
                    continue;
                }
            }

            if ($snapWizardFileType === Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_SELECT_ONLY_VIDEOS) {
                if ( $media->media_type !== Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_VIDEO ) {
                    continue;
                }
            }

            $filename = basename ( parse_url ( ($media->media_url ?? $media->thumbnail_url), PHP_URL_PATH ));

            // echo $media->media_url . " ||| " . $originalFilename . "<br />";
            if ( count ( $snapWizardExcludeList ) > 0 ) {
                if ( in_array ( $filename, $snapWizardExcludeList, true )) {
                    continue;
                }
            }

            if( WP_DEBUG ) { $this->logger->info('All settings checked'); }

//print_r($instpressUploadsDir . DIRECTORY_SEPARATOR . $filename);
//print_r(file_exists($instpressUploadsDir . DIRECTORY_SEPARATOR . $filename ) ? 'true' : 'false');

            // Process title
            if (!isset($media->caption)) {
                $postTitle = $media->username . ' - ' . $media->id;
            } else {
                $postTitle = substr(strip_tags($media->caption), 0, ( strpos(strip_tags($media->caption), PHP_EOL, 0) ) - 0); // preg_replace('/([^?!.]*.).*/', '\\1', strip_tags($m->caption));
                if (!$postTitle) {
                    $postTitle = preg_replace('/([^?!.]*.).*/', '\\1', strip_tags($media->caption));
                }
            }

            // Insert post if not exists

            // Retrieve a post with the same name (slug)
            $args = [
                'name' => sanitize_title($postTitle),
                'post_status' => 'publish',
                'post_type' => 'post',
            ];
            $posts = new WP_Query($args);

            if( WP_DEBUG ) { $this->logger->info('Check for existing Post Name', ['name' => sanitize_title($postTitle), 'foundPosts' => $posts->found_posts]); }

            if ($posts->found_posts === 0) {

                if (WP_DEBUG) {
                    $this->logger->info('Inserting post...');
                }

                $postId = $this->insertPost($media, $postTitle, $snapwizardAuthor, $snapwizardPostCategories);

                if (WP_DEBUG) {
                    $this->logger->info('Inserting media...');
                }

                $attachmentId = $this->setAttachmentAndThumbnail($media, $snapwizardAuthor, $postId, $snapwizardMediaCategories);

                $galleryIds = [];
                $galleryVideos = [];
                if (isset($media->children)) {

                    if (WP_DEBUG) {
                        $this->logger->info('Loop over children', ['countChildren' => count($media->children->data)]);
                    }

                    foreach ($media->children->data as $mediaChildren) {
                        $attachmentId = $this->setAttachmentAndThumbnail($mediaChildren, $snapwizardAuthor, $postId, $snapwizardMediaCategories);

                        list($galleryVideos, $galleryIds) = $this->prepareGalleries($mediaChildren, $attachmentId, $galleryVideos, $galleryIds);
                    }
                } else {

                    if (WP_DEBUG) {
                        $this->logger->info('NO CHILDREN CASE', ['media_type' => $media->media_type]);
                    }

                    list($galleryVideos, $galleryIds) = $this->prepareGalleries($media, $attachmentId, $galleryVideos, $galleryIds);
                }

                if ($postId > 0) {
                    $this->appendGalleriesToPostContent($galleryVideos, $galleryIds, $postId);
                }
            }

            if( WP_DEBUG ) { $this->logger->info('---> Element processed <---'); }
        }

        update_option('snapwizard_last_run', date("Y-m-d H:i:s"));

        // Refreshing the token if necessary // ...TODO... move into TokenManager
        $now = new \DateTime();
        $lastRefreshingToken = new \DateTime($snapWizardLastRefreshingToken);
        $diff = $now->diff($lastRefreshingToken);

        if( WP_DEBUG ) { $this->logger->info('Last refreshing token', ['snapWizardLastRefreshingToken' => $snapWizardLastRefreshingToken]); }

        if ($diff->days >= 30) {
            $this->tokenManager->refreshingToken($instagram, $decryptedToken, $snapWizardSecretKey);

            if( WP_DEBUG ) { $this->logger->info('Token refreshed'); }
        }

        // Last log
        if( WP_DEBUG ) { $this->logger->info('End'); }
        if( WP_DEBUG ) { $this->logger->info('============================================================================'); }

        return json_encode([
            'response' => 'success',
        ]);
    }

    /**
     * @param object $media
     * @param string $postTitle
     * @param int $snapwizardAuthor
     * @param array $snapwizardPostCategories
     * @return int|WP_Error
     */
    private function insertPost(object $media, string $postTitle, int $snapwizardAuthor, array $snapwizardPostCategories = []): int|WP_Error
    {
        $wpPostData = [
            'post_title' => trim($postTitle),
            'post_content' => (isset($media->caption)) ? sprintf('%s <br /><a href="%s" target="_blank">%s</a>', $media->caption, $media->permalink, __( 'Read on Instagram' )) : '',
            'post_type' => 'post', // or whatever is your post type slug.
            'post_author' => $snapwizardAuthor,
            'post_category' => $snapwizardPostCategories,
            'post_status' => 'publish',
            'post_date' => date("Y-m-d H:i:s", strtotime($media->timestamp)),
            'meta_input' => [
                // If you have any meta data, that will go here.
            ],
        ];

        return wp_insert_post($wpPostData, true);
    }

    /**
     * @param object $media
     * @param int $snapwizardAuthor
     * @param WP_Error|int $postId
     * @param bool|array $snapwizardMediaCategories
     * @return int|WP_Error
     */
    private function setAttachmentAndThumbnail(object $media, int $snapwizardAuthor, WP_Error|int $postId, bool|array $snapwizardMediaCategories): int|WP_Error
    {
        if (is_wp_error($postId)) {
            return new WP_Error('is_wp_error', 'Error in setAttachment');
        }

        $mediaUrl = $media->media_url ?? $media->thumbnail_url;

        $mediaInfo = pathinfo( $mediaUrl ); // Extracting information into array

        if ($mediaInfo === '') {
            return new WP_Error('media-info', 'Error in setAttachment');
        }

        $attachId = $this->saveAttachment($mediaUrl, $mediaInfo, $media, $snapwizardAuthor, $postId, $snapwizardMediaCategories);

        // And finally assign featured image to post
//        if (!has_post_thumbnail($postId)) {
            set_post_thumbnail($postId, $attachId);
//        }

        // Thumbnail on video
        if ($media->media_type === Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_VIDEO) {
            $mediaUrl = $media->thumbnail_url;

            $mediaInfo = pathinfo( $mediaUrl ); // Extracting information into array

            $attachVideoId = $this->saveAttachment($mediaUrl, $mediaInfo, $media, $snapwizardAuthor, $postId, $snapwizardMediaCategories);

            set_post_thumbnail($postId, $attachVideoId);
        }

        return $attachId;
    }

    /**
     * @param string $url
     * @return bool|string
     */
    private function mime2ext(string $url): bool|string
    {
        set_error_handler([$this, 'warningHandler'], E_WARNING);

        $fInfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
        $mime = $fInfo->buffer(file_get_contents($url));
        finfo_close($fInfo);

        restore_error_handler();

        $videoMimeMap = [
            'video/3gpp2'                                                               => '3g2',
            'video/3gp'                                                                 => '3gp',
            'video/3gpp'                                                                => '3gp',
            'video/x-msvideo'                                                           => 'avi',
            'video/msvideo'                                                             => 'avi',
            'video/avi'                                                                 => 'avi',
            'video/x-f4v'                                                               => 'f4v',
            'video/x-flv'                                                               => 'flv',
            'video/mj2'                                                                 => 'jp2',
            'video/quicktime'                                                           => 'mov',
            'video/x-sgi-movie'                                                         => 'movie',
            'video/mp4'                                                                 => 'mp4',
            'video/mpeg'                                                                => 'mpeg',
            'video/ogg'                                                                 => 'ogg',
            'video/vnd.rn-realvideo'                                                    => 'rv',
            'video/webm'                                                                => 'webm',
            'video/x-ms-wmv'                                                            => 'wmv',
            'video/x-ms-asf'                                                            => 'wmv',
        ];

        return $videoMimeMap[$mime] ?? false;
    }

    /**
     * @param array|string $mediaInfo
     * @param string $mediaUrl
     * @param string $file
     * @return string
     */
    private function setExtensionIfNecessary(array|string $mediaInfo, string $mediaUrl, string $file): string
    {
        if ($mediaInfo['extension'] === '' || strlen($mediaInfo['extension']) > 5) {
            $extension = $this->mime2ext($mediaUrl);

            if ($extension !== false) {
                if (!str_contains($file, $extension)) {
                    $file = $file . '.' . $extension;
                }
            }

            if (WP_DEBUG) {
                $this->logger->info('Check extension',
                    [
                        'file' => $file,
                        'mediaUrl' => $mediaUrl,
                        'mediaInfo' => $mediaInfo,
                        'media-extension' => $mediaInfo['extension'],
                        'extension' => $extension
                    ]);
            }
        }

        return $file;
    }

    /**
     * @param string $filename
     * @return string
     */
    private function getFilePathBasedOnPermissions(string $filename): string
    {
        if (wp_mkdir_p(wp_get_upload_dir()['path'])) {
            $file = wp_get_upload_dir()['path'] . '/' . $filename;
        } else {
            $file = wp_get_upload_dir()['basedir'] . '/' . $filename;
        }

        return $file;
    }

    /**
     * @param mixed $media
     * @param WP_Error|int $attachmentId
     * @param array $galleryVideos
     * @param array $galleryIds
     * @return array[]
     */
    private function prepareGalleries(mixed $media, WP_Error|int $attachmentId, array $galleryVideos, array $galleryIds): array
    {
        if ($media->media_type === Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_VIDEO) {
            $galleryVideos[] = '[video src="' . wp_get_attachment_url($attachmentId) . '"]';
        } elseif ($media->media_type === Constants::SNAPWIZARD_INSTAGRAM_MEDIA_TYPE_IMAGE) {
            $galleryIds[] = $attachmentId;
        }

        return [$galleryVideos, $galleryIds];
    }

    /**
     * @param string $mediaUrl
     * @param array|string $mediaInfo
     * @param object $media
     * @param int $snapwizardAuthor
     * @param WP_Error|int $postId
     * @param bool|array $snapwizardMediaCategories
     * @return int|WP_Error
     */
    private function saveAttachment(string $mediaUrl, array|string $mediaInfo, object $media, int $snapwizardAuthor, WP_Error|int $postId, bool|array $snapwizardMediaCategories): int|WP_Error
    {
        $imageData = file_get_contents($mediaUrl);

        list($filename, $file) = $this->getExtendedFilename($mediaUrl, $mediaInfo);

        clearstatcache(true, $file);

        // Create the image  file on the server
        file_put_contents($file, $imageData);

        // Check image file type
        $wp_filetype = wp_check_filetype($filename, null);

        // Include media and image library
        require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'media.php';
        require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'image.php';

        // Set attachment data
        $attachment = [
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => $media->caption ?? '',
            'post_status' => 'inherit',
            'post_author' => $snapwizardAuthor,
            'post_date' => date("Y-m-d H:i:s", strtotime($media->timestamp)),
        ];

        // Create the attachment
        $attachId = wp_insert_attachment($attachment, $file, $postId);

        if ($snapwizardMediaCategories) {
            wp_set_object_terms($attachId, $snapwizardMediaCategories, 'category');
        }

        // Define attachment metadata
        $attachData = wp_generate_attachment_metadata($attachId, $file);

        // Assign metadata to attachment
        wp_update_attachment_metadata($attachId, $attachData);

        return $attachId;
    }

    /**
     * @param int $errno
     * @param string $errstr
     */
    private function warningHandler(int $errno, string $errstr)
    {
        if( WP_DEBUG ) { $this->logger->error('Timeout on mime2ext', ['errno' => $errno, 'errstr' => $errstr]); }
    }

    /**
     * @param array $galleryVideos
     * @param array $galleryIds
     * @param WP_Error|int $postId
     */
    private function appendGalleriesToPostContent(array $galleryVideos, array $galleryIds, WP_Error|int $postId): void
    {
        $gallery = '';
        $videoGallery = '';
        if (count($galleryVideos) > 0) {

            if (WP_DEBUG) {
                $this->logger->info('Inserting video gallery in post');
            }

            $videoGallery = implode('', $galleryVideos);

            if (WP_DEBUG) {
                $this->logger->info('Video gallery', ['videoGallery' => $videoGallery]);
            }
        } else {

            if (WP_DEBUG) {
                $this->logger->info('Inserting image gallery in post');
            }

            $gallery = ' [gallery ids="' . implode(',', $galleryIds) . '" columns="4" size="medium" link="file"]';

            if (WP_DEBUG) {
                $this->logger->info('Image gallery', ['gallery' => $gallery]);
            }
        }

        $lastPostInserted = get_post($postId);

        wp_update_post([
            'ID' => $postId,
            'post_content' => $lastPostInserted->post_content . $gallery . $videoGallery,
        ]);
    }

    /**
     * @param string $mediaUrl
     * @param array|string $mediaInfo
     * @return array
     */
    private function getExtendedFilename(string $mediaUrl, array|string $mediaInfo): array
    {
        // ...TODO... test with or without unique...

        //$uniqueFileName = wp_unique_filename(wp_get_upload_dir()['path'], parse_url($mediaInfo['basename'], PHP_URL_PATH));
        $filename = parse_url($mediaInfo['basename'], PHP_URL_PATH); //basename($uniqueFileName);

        // Check folder permission and define file location
        $file = $this->getFilePathBasedOnPermissions($filename);

        // Check mime type and extension
        $file = $this->setExtensionIfNecessary($mediaInfo, $mediaUrl, $file);

        return array($filename, $file);
    }
}

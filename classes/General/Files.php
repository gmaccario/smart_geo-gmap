<?php

namespace SGGM\General\Classes;

if(!interface_exists('SGGM\General\Classes\iFiles'))
{
    interface iFiles
    {
        public function uploadFile(string $path = '', array $files = [], array $restrictions = ['geojson', 'json'], string $type = 'geojson') : bool;
        public function deleteFile( string $path = '', string $fileName = '', array $restrictions = ['geojson', 'json']) : bool;
    }
}

if(!class_exists('\General\Classes\Files')) {

    /**
     * @name Files
     * @description Files
     *
     * @return
     */
    class Files implements iFiles
    {
        /**
         * uploadFile
         *
         * @param string $path
         * @param array $files
         * @param array $restrictions
         * @param string $type
         *
         * @return bool
         */
        public function uploadFile( string $path = '', array $files = [], array $restrictions = ['json', 'geojson'], string $type = 'geojson') : bool
        {
            if ($type === 'geojson') {
                $existingFiles = array_diff( scandir(SMART_GEO_GMAP_PATH_DATA, 1 ), array( '..', '.', '.gitignore' ));

                if (count($existingFiles) >= 3) {
                    return false;
                }
            }

            if( empty( $files[ 'name' ] )) {
                return false;
            }

            $tmpFilePath = $files[ 'tmp_name' ];

            if( $tmpFilePath === "" ) {
                return false;
            }

            /**
             * Sanitize file name to avoid directory traversal
             */
            $cleanFileName = sanitize_file_name( $files[ 'name' ] );

            $filePath = $path . $cleanFileName;

            /**
             * Check file extension
             */
            $extension = pathinfo( $filePath, PATHINFO_EXTENSION );

            if( count( $restrictions ) > 0 ) {
                if( empty( $extension ) || !in_array( $extension, $restrictions )) {
                    return false;
                }
            }

            /**
             * Move the file
             */
            if( !move_uploaded_file( $tmpFilePath, $filePath )) {
                return false;
            }

            /**
             * Check Json file content
             */
            $jsonString = file_get_contents( $filePath );

            $jsonData = json_decode( $jsonString );

            $isValid = json_last_error() == JSON_ERROR_NONE;

            if( $isValid ) {
                return true;
            }
            else {
                $this->deleteFile( SMART_GEO_GMAP_PATH_DATA, $filePath );

                return false;
            }
        }

        /**
         * deleteFile
         *
         * @param string $path
         * @param string $fileName
         * @param array $restrictions
         *
         * @return bool
         */
        public function deleteFile( string $path = '', string $fileName = '', array $restrictions = ['geojson', 'json']) : bool
        {
            $extension = pathinfo( $fileName, PATHINFO_EXTENSION );

            if( count( $restrictions ) > 0 )
            {
                if( empty( $extension ) || !in_array( $extension, $restrictions ))
                {
                    return false;
                }
            }

            /**
             * Sanitize file name to avoid directory traversal
             */
            $filePath = $path . sanitize_file_name( $fileName );

            if( file_exists( $filePath ))
            {
                unlink( $filePath );

                return true;
            }

            return false;
        }
    }
}

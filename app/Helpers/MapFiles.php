<?php

namespace SmartGeoGMap\Helpers;

class MapFiles {

	private string $smartGeoGMapDataPath = '';
	private string $smartGeoGMapSnazzyPath = '';

	private LoggerAdapter $logger;

	public function __construct( LoggerAdapter $logger = null ) {
		$this->logger = $logger;

		$uploadBaseDir = isset( wp_upload_dir()['basedir'] )
			? wp_upload_dir()['basedir']
			: DIRECTORY_SEPARATOR . 'uploads';

		$this->smartGeoGMapDataPath = $uploadBaseDir . DIRECTORY_SEPARATOR . Constants::SMARTGEOGMAP_DATA_FOLDER . DIRECTORY_SEPARATOR;
		$this->smartGeoGMapSnazzyPath = $uploadBaseDir . DIRECTORY_SEPARATOR . Constants::SMARTGEOGMAP_SNAZZY_FOLDER . DIRECTORY_SEPARATOR;
	}

	/**
	 * @return string
	 */
	public function smartGeoGMapManageSnazzyMapFiles(): string {
		$smartgeogmapSnazzyFile = get_option( 'smartgeogmap_snazzy_file' );

		// Deleting files
		if ( ! empty( $_POST['smartgeogmap_delete_snazzy_file'] ) ) {
			if ( ! $this->deleteFile( $smartgeogmapSnazzyFile ) ) {
				return $smartgeogmapSnazzyFile;
			} else {
				if ( WP_DEBUG ) {
					$this->logger->addLog( 'INFO', 'Deleting Snazzy file', [ $smartgeogmapSnazzyFile ] );
				}

				return '';
			}
		}

		if ( ! empty( $_FILES['smartgeogmap_snazzy_file'] ) ) {
			// Preparing file for upload
			$filesData = $this->getFilesData( 'smartgeogmap_snazzy_file' );

			if ( empty ( $filesData ) ) {
				return $smartgeogmapSnazzyFile;
			}

			// Upload files
			$tmpFilePath = $filesData['tmp_name'];

			if ( WP_DEBUG ) {
				$this->logger->addLog( 'INFO',
					'Uploading snazzy file',
					[
						$smartgeogmapSnazzyFile,
						$filesData['name'],
						$this->smartGeoGMapSnazzyPath,
						$filesData,
						$tmpFilePath,
						[ 'json' ]
					] );
			}

			return $this->smartGeoGMapUploadMapFiles( $smartgeogmapSnazzyFile,
				$filesData['name'],
				$this->smartGeoGMapSnazzyPath,
				$filesData,
				$tmpFilePath,
				[ 'json' ] );
		}

		return $smartgeogmapSnazzyFile;
	}

	/**
	 * @return string
	 */
	public function smartGeoGMapManageGeoJSONFiles(): string {

		$smartgeogmapGeoJSONFile = get_option( 'smartgeogmap_geojson_file' );

		if ( WP_DEBUG ) {
			$this->logger->addLog( 'INFO', 'smartGeoGMapManageGeoJSONFiles starting...', [ $smartgeogmapGeoJSONFile ] );
		}

		// Deleting files
		if ( ! empty( $_POST['smartgeogmap_delete_geojson_file'] ) ) {
			return $this->deleteGeoJSONFiles( $smartgeogmapGeoJSONFile );
		}

		// Uploading files
		if ( ! empty( $_FILES['smartgeogmap_geojson_file'] ) ) {
			// Preparing file for upload
			$filesData = $this->getFilesData( 'smartgeogmap_geojson_file' );

			if ( empty ( $filesData ) ) {
				return $smartgeogmapGeoJSONFile;
			}

			return $this->uploadGeoJSONFiles( $filesData, $smartgeogmapGeoJSONFile );
		}

		return $smartgeogmapGeoJSONFile;
	}

	/**
	 * @param string $optionValue
	 * @param string $name
	 * @param string $path
	 * @param array $filesData
	 * @param string $tmpFilePath
	 * @param array $restrictions
	 *
	 * @return string
	 */
	private function smartGeoGMapUploadMapFiles(
		string $optionValue,
		string $name,
		string $path,
		array $filesData,
		string $tmpFilePath,
		array $restrictions = []
	): string {
		/*
		$_FILES
		-------
		 Array (
		[smartgeogmap_snazzy_file] =>
			Array (
				[name] => snazzymap.json
				[full_path] => snazzymap.json
				[type] => application/json
				[tmp_name] => /tmp/phpZtVmP1
				[error] => 0
				[size] => 3564
			))
		 */

		/**
		 * Sanitize file name to avoid directory traversal
		 */
		$filePath = $this->getSanitizedFilePath( $name, $path );

		/**
		 * Check file extension
		 */
		$extension = pathinfo( $filePath, PATHINFO_EXTENSION );

		if ( empty( $extension ) || ! in_array( $extension, $restrictions ) ) {
			return $optionValue;
		}

		if ( ! file_exists( $path ) ) {
			mkdir( $path, 0777, true );
		}

		/**
		 * Move the file
		 */
		if ( ! move_uploaded_file( $tmpFilePath, $filePath ) ) {
			return $optionValue;
		}

		/**
		 * Check Json file content
		 */
		$jsonString = file_get_contents( $filePath );

		$jsonData = json_decode( $jsonString );

		$isValid = json_last_error() == JSON_ERROR_NONE;

		if ( $isValid ) {
			return $filePath;
		} else {
			if ( $this->deleteFile( $filePath ) ) {
				return '';
			} else {
				return $optionValue;
			}
		}
	}

	/**
	 * @param string $path
	 *
	 * @return bool
	 */
	private function deleteFile( string $path = '' ): bool {
		if ( WP_DEBUG ) {
			$this->logger->addLog( 'INFO', 'Check if file path exist before deleting it', [ file_exists( $path ) ] );
		}

		if ( file_exists( $path ) ) {
			unlink( $path );

			return true;
		}

		return false;
	}

	/**
	 * @param string $index
	 *
	 * @return mixed
	 */
	private function getFilesData( string $index ): mixed {
		$filesData = [];
		if ( ! empty ( $_FILES[ $index ] ) ) {
			$filesData = $_FILES[ $index ];
		}

		return $filesData;
	}

	/**
	 * @param mixed $smartgeogmapGeoJSONFile
	 *
	 * @return false|string
	 */
	private function deleteGeoJSONFiles( mixed $smartgeogmapGeoJSONFile ): string|false {
		$files = [];
		foreach ( $_POST['smartgeogmap_delete_geojson_file'] as $geoJSONFileName ) {

			$singleSmartGeoGMapGeoJSONFileToDelete = $this->getSanitizedFilePath( $geoJSONFileName, $this->smartGeoGMapDataPath );

			if ( WP_DEBUG ) {
				$this->logger->addLog( 'INFO',
					'Deleting GeoJSON file',
					[ $geoJSONFileName, $singleSmartGeoGMapGeoJSONFileToDelete ] );
			}

			if ( ! $this->deleteFile( $singleSmartGeoGMapGeoJSONFileToDelete ) ) {
				if ( WP_DEBUG ) {
					$this->logger->addLog( 'ERROR',
						'Deleting GeoJSON file failed!',
						[ $singleSmartGeoGMapGeoJSONFileToDelete ] );
				}
			} else {
				if ( empty ( $files ) ) {
					$files = json_decode( $smartgeogmapGeoJSONFile, true );
				}

				if ( WP_DEBUG ) {
					$this->logger->addLog( 'INFO',
						'File deleted on filesystem!',
						[ $singleSmartGeoGMapGeoJSONFileToDelete, $files ] );
				}

				$indexToDelete = array_search( $singleSmartGeoGMapGeoJSONFileToDelete, $files );

				if ( WP_DEBUG ) {
					$this->logger->addLog( 'INFO', 'Index to delete', [ $indexToDelete ] );
				}

				unset( $files[ $indexToDelete ] );

				if ( WP_DEBUG ) {
					$this->logger->addLog( 'INFO', 'After index deletion', [ $files ] );
				}
			}

			if ( WP_DEBUG ) {
				$this->logger->addLog( 'INFO', 'End another loop - Files are: ', [ $files ] );
			}
		}

		if ( WP_DEBUG ) {
			$this->logger->addLog( 'INFO', 'Final return ', [ $files ] );
		}

		return ( empty( $files ) ? '' : json_encode( array_unique( $files ) ) );
}

	/**
	 * @param mixed $filesData
	 * @param mixed $optionValue
	 *
	 * @return false|string
	 */
	private function uploadGeoJSONFiles( mixed $filesData, mixed $optionValue = []): string|false {
		$files = [];
		foreach ( $filesData['name'] as $index => $name ) {
			if ( ! empty ( $name ) ) {

				$smartgeogmapGeoJSONFile = $this->getSanitizedFilePath( $this->smartGeoGMapDataPath, $name );

				$tmpFilePath = $filesData['tmp_name'][ $index ];

				if ( WP_DEBUG ) {
					$this->logger->addLog( 'INFO', 'Uploading GeoJSON file', [ $name, $smartgeogmapGeoJSONFile ] );
				}

				$files[] = $this->smartGeoGMapUploadMapFiles( $smartgeogmapGeoJSONFile,
					$name,
					$this->smartGeoGMapDataPath,
					$filesData,
					$tmpFilePath,
					[ 'json', 'geojson' ] );
			}
		}

		if ( ! empty ( $optionValue )) {
			$files = array_unique(array_merge($files, json_decode($optionValue, true)), SORT_REGULAR);
		}

		// Remove files in excess including only the first 3 files in $files (the previous ones will be replaced with the new files)
		$totFilesExisting = count( $files );

		if ( WP_DEBUG ) {
			$this->logger->addLog( 'INFO', 'How many files already exist?', [ $totFilesExisting ] );
		}

		if ( $totFilesExisting > Constants::SMARTGEOGMAP_MAX_GEOJSON_ALLOWED ) {
			if ( WP_DEBUG ) {
				$this->logger->addLog( 'INFO', 'Files  before', [ $files ] );
			}

			// Remove surplus files on filesystem
			foreach( $files as $index => $file ) {
				if ( $index > Constants::SMARTGEOGMAP_MAX_GEOJSON_ALLOWED - 1 ) {
					unlink($file);
				}
			}

			$files = array_slice(
				$files,
				0,
				Constants::SMARTGEOGMAP_MAX_GEOJSON_ALLOWED
			);

			if ( WP_DEBUG ) {
				$this->logger->addLog( 'INFO', 'Files  after', [ $files ] );
			}
		}

		return json_encode( $files );
	}

	/**
	 * @param string $name
	 * @param string $path
	 *
	 * @return string
	 */
	private function getSanitizedFilePath( string $name, string $path ): string {
		$cleanFileName = sanitize_file_name( $name );

		return $path . $cleanFileName;
	}
}

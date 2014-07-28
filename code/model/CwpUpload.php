<?php
class CwpUpload_Validator extends Upload_Validator {

	/**
	 * Check if the temporary file has a valid MIME type for it's extension.
	 *
	 * @uses finfo php extension 
	 * @return boolean|null
	 */
	public function isValidMime() {
		$extension = pathinfo($this->tmpFile['name'], PATHINFO_EXTENSION);

		// we can't check filenames without an extension, let them pass validation.
		if(!$extension) return true;

		// if the finfo php extension isn't loaded, we can't complete this check.
		if(!class_exists('finfo')) {
			throw new CwpUpload_Validator_Exception('PHP extension finfo is not loaded');
		}

		$knownMimes = Config::inst()->get('HTTP', 'MimeTypes');
		if(!isset($knownMimes[$extension])) {
			throw new CwpUpload_Validator_Exception(
				sprintf('Could not find a MIME type for extension %s', $extension)
			);
		}

		$expectedMime = $knownMimes[$extension];

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$foundMime = $finfo->file($this->tmpFile['tmp_name']);
		if(!$foundMime) {
			throw new CwpUpload_Validator_Exception(
				sprintf('Could not find a MIME type for file %s', $this->tmpFile['tmp_name'])
			);
		}

		return $this->compareMime($foundMime, $expectedMime);
	}

	/**
	 * Check two MIME types roughly match eachother.
	 *
	 * Before we check MIME types, remove known prefixes "vnd.", "x-" etc.
	 * If there is a suffix, we'll use that to compare. Examples:
	 *
	 * application/x-json = json
	 * application/json = json
	 * application/xhtml+xml = xml
	 * application/xml = xml
	 *
	 * @param string $first The first MIME type to compare to the second
	 * @param string $second The second MIME type to compare to the first
	 * @param string $pattern The regexp pattern to remove matches on MIME type text
	 * @return boolean
	 */
	public function compareMime($first, $second, $pattern = '/.*[\/\.\-\+]/i') {
		return preg_replace($pattern, '', $first) === preg_replace($pattern, '', $second);
	}

	public function validate() {
		if(parent::validate() === false) return false;

		try {
			$result = $this->isValidMime();
			if($result === false) {
				$this->errors[] = _t(
					'File.INVALIDMIME',
					'File extension does not match known MIME type'
				);
				return false;
			}
		} catch(CwpUpload_Validator_Exception $e) {
			$this->errors[] = _t(
				'File.FAILEDMIMECHECK',
				'MIME validation failed: {message}',
				'Argument 1: Message about why MIME type detection failed',
				array('message' => $e->getMessage())
			);
			return false;
		}

		return true;
	}

}

class CwpUpload_Validator_Exception extends Exception {

}


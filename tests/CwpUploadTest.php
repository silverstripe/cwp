<?php
class CwpUploadTest extends SapphireTest {

	public function testInvalidFileExtensionValidatingMimeType() {
		// setup plaintext file with invalid extension
		$tmpFileName = 'UploadTest-testUpload.jpg';
		$tmpFilePath = TEMP_FOLDER . '/' . $tmpFileName;
		$tmpFileContent = '';
		for($i=0; $i<10000; $i++) $tmpFileContent .= '0';
		file_put_contents($tmpFilePath, $tmpFileContent);

		// emulates the $_FILES array
		$tmpFile = array(
			'name' => $tmpFileName,
			'size' => filesize($tmpFilePath),
			'tmp_name' => $tmpFilePath,
			'extension' => 'jpg',
			'error' => UPLOAD_ERR_OK,
		);

		$u = new Upload();
		$result = $u->load($tmpFile);
		$errors = $u->getErrors();
		$this->assertFalse($result, 'Load failed because file extension does not match excepted MIME type');
		$this->assertEquals('File extension does not match known MIME type', $errors[0]);

		unlink($tmpFilePath);
	}

	public function testMimeComparison() {
		$validator = new CwpUpload_Validator();

		$this->assertTrue($validator->compareMime('application/xhtml+xml', 'application/xml'));
		$this->assertTrue($validator->compareMime('application/vnd.text', 'application/text'));
		$this->assertTrue($validator->compareMime('application/vnd.vnd.text', 'application/text'));
		$this->assertTrue($validator->compareMime('application/x-text', 'application/text'));
		$this->assertTrue($validator->compareMime('application/gzip', 'application/gzip'));
		$this->assertTrue($validator->compareMime('application/x-gzip', 'application/gzip'));
		$this->assertFalse($validator->compareMime('application/png', 'application/json'));
		$this->assertFalse($validator->compareMime('text/plain', 'text/json'));
	}

}

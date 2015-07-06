<?php

/**
 * Allows siteconfig to configure synonyms for fulltext search
 * Requires silverstripe/fulltextsearch 1.1.1 or above
 */
class SynonymsSiteConfig extends DataExtension {
	
	private static $db = array(
		'SearchSynonyms' => 'Text', // fulltextsearch synonyms.txt content
	);
	
	public function updateCMSFields(FieldList $fields) {
		// Search synonyms
		$fields->addFieldToTab(
			'Root.FulltextSearch',
			TextareaField::create('SearchSynonyms', _t('CwpConfig.SearchSynonyms', 'Search Synonyms'))
				->setDescription(_t(
					'CwpConfig.SearchSynonyms_Description',
					'Enter as many comma separated synonyms as you wish, where '.
					'each line represents a group of synonyms.<br /> ' .
					'You will need to run Solr_Configure if you make any changes'
				))
		);
	}

	/**
	 * @inheritdoc
	 *
	 * @param ValidationResult $validationResult
	 */
	public function validate(ValidationResult $validationResult) {
		$validator = new SynonymValidator(array(
			'SearchSynonyms',
		));

		$validator->php(array(
			'SearchSynonyms' => $this->owner->SearchSynonyms
		));

		$errors = $validator->getErrors();

		if (is_array($errors) || $errors instanceof Traversable) {
			foreach ($errors as $error) {
				$validationResult->error($error['message']);
			}
		}
	}
}

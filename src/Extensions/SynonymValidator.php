<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Forms\Validator;

class SynonymValidator extends Validator
{
    /**
     * @var array
     */
    protected $fieldNames;

    /**
     * @inheritdoc
     *
     * @param array $fieldNames
     */
    public function __construct(array $fieldNames)
    {
        $this->fieldNames = $fieldNames;

        parent::__construct();
    }

    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return mixed
     */
    public function php($data)
    {
        foreach ($this->fieldNames as $fieldName) {
            if (empty($data[$fieldName])) {
                return;
            }

            $this->validateField($fieldName, $data[$fieldName]);
        }
    }

    /**
     * Validate field values, raising errors if the values are invalid.
     *
     * @param string $fieldName
     * @param mixed $value
     */
    protected function validateField($fieldName, $value)
    {
        if (!$this->validateValue($value)) {
            $this->validationError(
                $fieldName,
                _t(
                    'FullTextSearch.SynonymValidator.InvalidValue',
                    'Synonyms cannot contain words separated by spaces'
                )
            );
        }
    }

    /**
     * Check field values to see that they doesn't contain spaces between words.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function validateValue($value)
    {
        // strip empty lines
        $lines = array_filter(
            explode("\n", $value)
        );

        // strip comments (lines beginning with "#")
        $lines = array_filter($lines, function ($line) {
            $line = trim($line);

            return !empty($line) && $line[0] !== '#';
        });

        // validate each line
        foreach ($lines as $line) {
            if (!$this->validateLine($line)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check each line to see that it doesn't contain spaces between words.
     *
     * @param string $line
     *
     * @return bool
     */
    protected function validateLine($line)
    {
        $line = trim($line);

        $parts = explode(',', $line);
        $parts = array_filter($parts);

        foreach ($parts as $part) {
            if (!$this->validatePart($part)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check each part of the line doesn't contain spaces between words.
     *
     * @param string $part
     *
     * @return bool
     */
    protected function validatePart($part)
    {
        if (strpos($part, '=>') !== false) {
            $subs = explode('=>', $part);
            $subs = array_filter($subs);

            foreach ($subs as $sub) {
                if (!$this->validateNoSpaces($sub)) {
                    return false;
                }
            }

            return true;
        }

        return $this->validateNoSpaces($part);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function validateNoSpaces($value)
    {
        // allow spaces at the beginning and end of the value
        $value = trim($value);

        // does the value contain 1 or more whitespace characters?
        if (preg_match('/\s+/', $value)) {
            return false;
        }

        return true;
    }
}

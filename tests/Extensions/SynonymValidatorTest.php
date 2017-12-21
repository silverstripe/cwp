<?php

namespace CWP\CWP\Tests\Extensions;

use CWP\CWP\Extensions\SynonymValidator;
use SilverStripe\Dev\SapphireTest;

class SynonymValidatorTest extends SapphireTest
{
    /**
     * @var SynonymValidator
     */
    protected $validator;

    protected function setUp()
    {
        parent::setUp();

        $this->validator = new SynonymValidator([
            'Synonyms',
        ]);
    }

    /**
     * @dataProvider validValuesProvider
     */
    public function testItAllowsValidValues($value)
    {
        $this->validator->php([
            'Synonyms' => $value,
        ]);

        $this->assertEmpty($this->validator->getErrors());
    }

    /**
     * @return array
     */
    public function validValuesProvider()
    {
        return [
            ['foo'],
            ['foo,bar,baz'],
            ['foo, bar, baz'],
            [
                '
				foo
				bar
				baz
			'
            ],
            ['foo => bar, baz'],
            [
                '
				# this is a comment, it should be ignored!

				foo, bar, baz
				foo => bar, baz

				# ...as should this.
			'
            ],
        ];
    }

    /**
     * @dataProvider invalidValuesProvider
     *
     * @param string $value
     */
    public function testItDisallowsInvalidValues($value)
    {
        $this->validator->php([
            'Synonyms' => $value,
        ]);

        $this->assertNotEmpty($this->validator->getErrors());
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            ['foo, bar baz, qux'],
            ['foo => bar baz, qux'],
        ];
    }
}

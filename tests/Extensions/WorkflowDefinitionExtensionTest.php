<?php

namespace CWP\CWP\Tests\Extensions;





use WorkflowDefinition;
use SilverStripe\ORM\DB;
use SilverStripe\Core\Config\Config;
use CWP\CWP\Extensions\CwpWorkflowDefinitionExtension;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\FunctionalTest;


/**
 * Tests the data extension {@link: CWPWorkflowDefinitionExtension}
 *
 * @package framework
 * @subpackage tests
 */
class WorkflowDefinitionExtensionTest extends FunctionalTest {

	/**
	 * @var Boolean If set to TRUE, this will force a test database to be generated
	 * in {@link setUp()}. Note that this flag is overruled by the presence of a
	 * {@link $fixture_file}, which always forces a database build.
	 */
	protected $usesDatabase = true;
	
	/**
	 * Tests the config option that controls the creation of a default workflow definition
	 *
	 * @return void
	 */
	public function testCreateDefaultWorkflowTest() {
		DB::quiet();
		
		// test disabling the default workflow definition
		Config::inst()->update(CwpWorkflowDefinitionExtension::class, 'create_default_workflow', false);
		$workflowExtn = Injector::inst()->create(CwpWorkflowDefinitionExtension::class);
		$workflowExtn->requireDefaultRecords();
		$definition = WorkflowDefinition::get()->first();
		$this->assertNull($definition);

		// test enabling the default workflow definition
		Config::inst()->update(CwpWorkflowDefinitionExtension::class, 'create_default_workflow', true);
		$workflowExtn = Injector::inst()->create(CwpWorkflowDefinitionExtension::class);
		$workflowExtn->requireDefaultRecords();
		$definition = WorkflowDefinition::get()->first();
		$this->assertNotNull($definition);
	}
}

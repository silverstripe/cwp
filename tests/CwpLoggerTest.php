<?php
require_once 'Zend/Log/Writer/Abstract.php';

class CwpLoggerTest extends SapphireTest {

	protected $writer = null;

	public function setUp() {
		parent::setUp();

		$this->writer = new CwpLoggerTest_LogWriter('SilverStripe', null, LOG_AUTH);
		SS_Log::add_writer($this->writer, CwpLogger::PRIORITY, '=');

		// ensure the manipulations are being captured, normally called in {@link CwpLogger::onBeforeInit()}
		// but tests will reset this during setting up, so we need to set it back again.
		CwpLogger::bind_manipulation_capture();
	}

	public function testLoggingIn() {
		$this->logInWithPermission('ADMIN');

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('successfully logged in', $message);
	}

	public function testLoggingOut() {
		$this->logInWithPermission('ADMIN');

		$member = Member::get()->filter(array('Email' => 'ADMIN@example.org'))->first();
		$member->logOut();

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('successfully logged out', $message);
	}

	public function testLoggingWriteDoesNotOccurWhenNotLoggedIn() {
		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$message = $this->writer->getLastMessage();
		$this->assertEmpty($message, 'No one is logged in, so nothing was logged');
	}

	public function testLoggingWriteWhenLoggedIn() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('modified', $message);
		$this->assertContains('Group', $message);
	}

	public function testAddMemberToGroupUsingGroupMembersRelation() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$member = new Member(array('FirstName' => 'Joe', 'Email' => 'joe1'));
		$member->write();

		$group->Members()->add($member);

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('added Member "joe1"', $message);
		$this->assertContains('to Group "My group"', $message);
	}

	public function testAddMemberToGroupUsingMemberGroupsRelation() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$member = new Member(array('FirstName' => 'Joe', 'Email' => 'joe2'));
		$member->write();

		$member->Groups()->add($group);

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('added Member "joe2"', $message);
		$this->assertContains('to Group "My group"', $message);
	}

	public function testRemoveMemberFromGroupUsingGroupMembersRelation() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$member = new Member(array('FirstName' => 'Joe', 'Email' => 'joe3'));
		$member->write();

		$group->Members()->add($member);
		$group->Members()->remove($member);

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('removed Member "joe3"', $message);
		$this->assertContains('from Group "My group"', $message);
	}

	public function testRemoveMemberFromGroupUsingMemberGroupsRelation() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$member = new Member(array('FirstName' => 'Joe', 'Email' => 'joe4'));
		$member->write();

		$member->Groups()->add($group);
		$member->Groups()->remove($group);

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('removed Member "joe4"', $message);
		$this->assertContains('from Group "My group"', $message);
	}

	public function tearDown() {
		parent::tearDown();

		SS_Log::remove_writer($this->writer);
		unset($this->writer);
	}

}

class CwpLoggerTest_LogWriter extends Zend_Log_Writer_Abstract {

	protected $messages = array();

	static public function factory($config) {
		return new CwpLoggerTest_LogWriter(null, $config);
	}

	public function _write($event) {
		array_push($this->messages, $event['message']['errstr']);
	}

	public function getLastMessage() {
		return end($this->messages);
	}

	public function getMessages() {
		return $this->messages;
	}

}

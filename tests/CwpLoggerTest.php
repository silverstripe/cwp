<?php
require_once 'Zend/Log/Writer/Abstract.php';

class CwpLoggerTest extends SapphireTest {

	protected $writer = null;

	protected $group, $member = null;

	public function setUp() {
		parent::setUp();

		$this->writer = new CwpLoggerTest_LogWriter('SilverStripe', null, LOG_AUTH);
		SS_Log::add_writer($this->writer, CwpLogger::PRIORITY, '=');
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
		$this->assertNull($message, 'No one is logged in, so nothing was logged');
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

	public function testAddMemberToGroup() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$member = new Member(array('FirstName' => 'Joe', 'Email' => 'joe123'));
		$member->write();

		$group->Members()->add($member);

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('added Member "joe123"', $message);
		$this->assertContains('to Group "My group"', $message);
	}

	public function testRemoveMemberFromGroup() {
		$this->logInWithPermission('ADMIN');

		$group = new Group(array('Title' => 'My group'));
		$group->write();

		$member = new Member(array('FirstName' => 'Joe', 'Email' => 'joe567'));
		$member->write();

		$group->Members()->add($member);
		$group->Members()->remove($member);

		$message = $this->writer->getLastMessage();
		$this->assertContains('ADMIN@example.org', $message);
		$this->assertContains('removed Member "joe567"', $message);
		$this->assertContains('from Group "My group"', $message);
	}

	public function tearDown() {
		parent::tearDown();

		SS_Log::remove_writer($this->writer);
		unset($this->writer);
	}

}

class CwpLoggerTest_LogWriter extends Zend_Log_Writer_Abstract {

	protected $messages;

	static public function factory($config) {
		return new CwpLoggerTest_LogWriter(null, $config);
	}

	public function _write($event) {
		$this->messages[] = $event['message']['errstr'];
	}

	public function getLastMessage() {
		return $this->messages ? end($this->messages) : null;
	}

	public function getMessages() {
		return $this->messages;
	}

}

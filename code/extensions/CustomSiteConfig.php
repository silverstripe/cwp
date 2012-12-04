<?php
/**
 * Adds new global settings.
 */

class CustomSiteConfig extends DataExtension {
	function extraStatics($class = null, $extension = null) {
		return array(
			'db' => array(
				'GACode' => 'Varchar(16)',
				'FacebookURL' => 'Varchar(256)', // multitude of ways to link to Facebook accounts, best to leave it open.
				'TwitterUsername' => 'Varchar(16)', // max length of Twitter username 15
				'AddThisProfileID' => 'Varchar(32)',
				'FooterLogoLink' => 'Varchar(255)',
				'FooterLogoDescription' => 'Varchar(255)'
			),
			'has_one' => array(
				'Logo' => 'Image',
				'FooterLogo' => 'Image'
			)
		);
	}

	function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main', $gaCode = new TextField('GACode', 'Google Analytics account'));
		$gaCode->setRightTitle('Account number to be used all across the site (in the format <strong>UA-XXXXX-X</strong>)');

		$fields->addFieldToTab('Root.SocialMedia', $facebookURL = new TextField('FacebookURL', 'Facebook UID or username'));
		$facebookURL->setRightTitle('Facebook link (everything after the "http://facebook.com/", eg http://facebook.com/<strong>username</strong> or http://facebook.com/<strong>pages/108510539573</strong>)');

		$fields->addFieldToTab('Root.SocialMedia', $twitterUsername = new TextField('TwitterUsername', 'Twitter username'));
		$twitterUsername->setRightTitle('Twitter username (eg, http://twitter.com/<strong>username</strong>)');

		$fields->addFieldToTab('Root.SocialMedia', $addThisID = new TextField('AddThisProfileID', 'AddThis Profile ID'));
		$addThisID->setRightTitle('Profile ID to be used all across the site (in the format <strong>ra-XXXXXXXXXXXXXXXX</strong>)');

		$fields->addFieldToTab('Root.Logos', $logoField = new UploadField('Logo', 'Logo, to appear in the top left.'));
		$logoField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$logoField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos', $footerLogoField = new UploadField('FooterLogo', 'Footer logo, to appear in the bottom right.'));
		$footerLogoField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$footerLogoField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos', $footerLink = new TextField('FooterLogoLink', 'Footer Logo link'));
		$footerLink->setRightTitle('Please include the protocol (ie, http:// or https://) unless it is an internal link.');

		$fields->addFieldToTab('Root.Logos', new TextField('FooterLogoDescription', 'Footer Logo description'));
	}
}

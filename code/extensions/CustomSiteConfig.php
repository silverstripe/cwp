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
				'FooterLogo' => 'Image',
				'FavIcon' => 'File',
				'AppleTouchIcon144' => 'File',
				'AppleTouchIcon114' => 'File',
				'AppleTouchIcon72' => 'File',
				'AppleTouchIcon57' => 'File'
			)
		);
	}

	function updateCMSFields(FieldList $fields) {
		// subsite theme setting is managed in SubsiteAdmin instead
		if(class_exists('Subsite') && Subsite::currentSubsiteID()) {
			$fields->removeByName('Theme');
		}

		$fields->addFieldToTab('Root.Main', $gaCode = new TextField('GACode', 'Google Analytics account'));
		$gaCode->setRightTitle('Account number to be used all across the site (in the format <strong>UA-XXXXX-X</strong>)');

		$fields->addFieldToTab('Root.SocialMedia', $facebookURL = new TextField('FacebookURL', 'Facebook UID or username'));
		$facebookURL->setRightTitle('Facebook link (everything after the "http://facebook.com/", eg http://facebook.com/<strong>username</strong> or http://facebook.com/<strong>pages/108510539573</strong>)');

		$fields->addFieldToTab('Root.SocialMedia', $twitterUsername = new TextField('TwitterUsername', 'Twitter username'));
		$twitterUsername->setRightTitle('Twitter username (eg, http://twitter.com/<strong>username</strong>)');

		$fields->addFieldToTab('Root.SocialMedia', $addThisID = new TextField('AddThisProfileID', 'AddThis Profile ID'));
		$addThisID->setRightTitle('Profile ID to be used all across the site (in the format <strong>ra-XXXXXXXXXXXXXXXX</strong>)');

		$fields->addFieldToTab('Root.Logos/Icons', $logoField = new UploadField('Logo', 'Logo, to appear in the top left.'));
		$logoField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$logoField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos/Icons', $footerLogoField = new UploadField('FooterLogo', 'Footer logo, to appear in the bottom right.'));
		$footerLogoField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$footerLogoField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos/Icons', $footerLink = new TextField('FooterLogoLink', 'Footer Logo link'));
		$footerLink->setRightTitle('Please include the protocol (ie, http:// or https://) unless it is an internal link.');

		$fields->addFieldToTab('Root.Logos/Icons', new TextField('FooterLogoDescription', 'Footer Logo description'));

		$fields->addFieldToTab('Root.Logos/Icons', $favIconField = new UploadField('FavIcon', 'Favicon, in .ico format, dimensions of 16x16, 32x32, or 48x48'));
		$favIconField->getValidator()->setAllowedExtensions(array('ico'));
		$favIconField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos/Icons', $atIcon144 = new UploadField('AppleTouchIcon144', 'Apple Touch Web Clip and Windows 8 Tile Icon (dimensions of 144x144, PNG format)'));
		$atIcon144->getValidator()->setAllowedExtensions(array('png'));
		$atIcon144->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos/Icons', $atIcon114 = new UploadField('AppleTouchIcon114', 'Apple Touch Web Clip Icon (dimensions of 114x114, PNG format)'));
		$atIcon114->getValidator()->setAllowedExtensions(array('png'));
		$atIcon114->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos/Icons', $atIcon72 = new UploadField('AppleTouchIcon72', 'Apple Touch Web Clip Icon (dimensions of 72x72, PNG format)'));
		$atIcon72->getValidator()->setAllowedExtensions(array('png'));
		$atIcon72->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab('Root.Logos/Icons', $atIcon57 = new UploadField('AppleTouchIcon57', 'Apple Touch Web Clip Icon (dimensions of 57x57, PNG format)'));
		$atIcon57->getValidator()->setAllowedExtensions(array('png'));
		$atIcon57->setConfig('allowedMaxFileNumber', 1);
	}
}

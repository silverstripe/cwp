<?php
/**
 * Adds new global settings.
 */

class CustomSiteConfig extends DataExtension {

	private static $db = array(
		'GACode' => 'Varchar(16)',
		'FacebookURL' => 'Varchar(256)', // multitude of ways to link to Facebook accounts, best to leave it open.
		'TwitterUsername' => 'Varchar(16)', // max length of Twitter username 15
		'AddThisProfileID' => 'Varchar(32)',
		'FooterLogoLink' => 'Varchar(255)',
		'FooterLogoDescription' => 'Varchar(255)'
	);

	private static $has_one = array(
		'Logo' => 'Image',
		'LogoRetina' => 'Image',
		'FooterLogo' => 'Image',
		'FooterLogoRetina' => 'Image',
		'FavIcon' => 'File',
		'AppleTouchIcon144' => 'File',
		'AppleTouchIcon114' => 'File',
		'AppleTouchIcon72' => 'File',
		'AppleTouchIcon57' => 'File'
	);

	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldToTab(
			'Root.Main', 
			$gaCode = TextField::create(
				'GACode', 
				_t('CwpConfig.GaField','Google Analytics account')
			)
		);
		$gaCode->setRightTitle(
			_t('CwpConfig.GaFieldDesc','Account number to be used all across the site (in the format <strong>UA-XXXXX-X</strong>)')
		);

		$fields->findOrMakeTab(
			'Root.SocialMedia',
			_t('CustomSiteConfig.SocialMediaTab', 'Social Media')
		);

		$fields->addFieldToTab(
			'Root.SocialMedia', 
			$facebookURL = TextField::create(
				'FacebookURL', 
				_t('CwpConfig.FbField','Facebook UID or username')
			)
		);
		$facebookURL->setRightTitle(
			_t(
				'CwpConfig.FbFieldDesc',
				'Facebook link (everything after the "http://facebook.com/", eg http://facebook.com/<strong>username</strong> or http://facebook.com/<strong>pages/108510539573</strong>)'
			)
		);

		$fields->addFieldToTab(
			'Root.SocialMedia', 
			$twitterUsername = TextField::create(
				'TwitterUsername', 
				_t('CwpConfig.TwitterField','Twitter username')
			)
		);
		$twitterUsername->setRightTitle(
			_t('CwpConfig.TwitterFieldDesc','Twitter username (eg, http://twitter.com/<strong>username</strong>)')
		);

		$fields->addFieldToTab(
			'Root.SocialMedia', 
			$addThisID = TextField::create(
				'AddThisProfileID', 
				_t('CwpConfig.AddThisField','AddThis Profile ID')
			)
		);
		$addThisID->setRightTitle(
			_t('CwpConfig.AddThisFieldDesc','Profile ID to be used all across the site (in the format <strong>ra-XXXXXXXXXXXXXXXX</strong>)')
		);

		$fields->findOrMakeTab(
			'Root.LogosIcons',
			_t('CustomSiteConfig.LogosIconsTab', 'Logos/Icons')
		);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $logoField = UploadField::create(
			 	'Logo', 
			 	_t('CwpConfig.LogoUploadField','Logo, to appear in the top left')
			 )
		);
		$logoField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$logoField->setConfig('allowedMaxFileNumber', 1);
		
		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $logoRetinaField = UploadField::create(
			 	'LogoRetina', 
			 	_t(
			 		'CwpConfig.LogoRetinaUploadField',
			 		'High resolution logo, to appear in the top left (recommended twice the height and width of the standard logo)'
			 	)
			 )
		);
		$logoRetinaField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$logoRetinaField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $footerLogoField = UploadField::create(
			 	'FooterLogo', 
			 	_t('CwpConfig.FooterLogoField','Footer logo, to appear in the footer')
			 )
		);
		$footerLogoField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$footerLogoField->setConfig('allowedMaxFileNumber', 1);
		
		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $footerLogoRetinaField = UploadField::create(
			 	'FooterLogoRetina', 
			 	_t('CwpConfig.FooterLogoRetinaField','High resolution footer logo (recommended twice the height and width of the standard footer logo)')
			 )
		);
		$footerLogoRetinaField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$footerLogoRetinaField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $footerLink = TextField::create(
			 	'FooterLogoLink', 
			 	_t('CwpConfig.FooterLogoLinkField','Footer Logo link')
			 )
		);
		$footerLink->setRightTitle(
			_t('CwpConfig.FooterLogoLinkDesc','Please include the protocol (ie, http:// or https://) unless it is an internal link.')
		);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 TextField::create(
			 	'FooterLogoDescription', 
			 	_t('CwpConfig.FooterLogoDescField','Footer Logo description')
			 )
		);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $favIconField = UploadField::create(
			 	'FavIcon', 
			 	_t('CwpConfig.FavIconField','Favicon, in .ico format, dimensions of 16x16, 32x32, or 48x48')
			 )
		);
		$favIconField->getValidator()->setAllowedExtensions(array('ico'));
		$favIconField->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $atIcon144 = UploadField::create(
			 	'AppleTouchIcon144', 
			 	_t('CwpConfig.AppleIconField144','Apple Touch Web Clip and Windows 8 Tile Icon (dimensions of 144x144, PNG format)')
			 )
		);
		$atIcon144->getValidator()->setAllowedExtensions(array('png'));
		$atIcon144->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $atIcon114 = UploadField::create(
			 	'AppleTouchIcon114', 
			 	_t('CwpConfig.AppleIconField114','Apple Touch Web Clip Icon (dimensions of 114x114, PNG format)')
			 )
		);
		$atIcon114->getValidator()->setAllowedExtensions(array('png'));
		$atIcon114->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $atIcon72 = UploadField::create(
			 	'AppleTouchIcon72', 
			 	_t('CwpConfig.AppleIconField72','Apple Touch Web Clip Icon (dimensions of 72x72, PNG format)')
			 )
		);
		$atIcon72->getValidator()->setAllowedExtensions(array('png'));
		$atIcon72->setConfig('allowedMaxFileNumber', 1);

		$fields->addFieldToTab(
			'Root.LogosIcons',
			 $atIcon57 = UploadField::create(
			 	'AppleTouchIcon57', 
			 	_t('CwpConfig.AppleIconField57','Apple Touch Web Clip Icon (dimensions of 57x57, PNG format)')
			 )
		);
		$atIcon57->getValidator()->setAllowedExtensions(array('png'));
		$atIcon57->setConfig('allowedMaxFileNumber', 1);
	}

}

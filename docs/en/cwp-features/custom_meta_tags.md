# Custom Meta Tags

Out the box, your site will include two fields per page for meta tags: one for the description and one for custom
tags. The custom fields are defined by entering in the HTML that you would like outputted. While this is the most
flexible system for custom meta tags, you may want to add extra specific fields for things like author, copyright,
date of publication, etc.

To do this, define the fields that you'd like specified on your page type and add the fields to the CMS view:

	:::php
	class Publication extends Page {
		private static $db = array(
			'MetaAuthor' => 'Varchar(255)',
			'MetaCopyright' => 'Varchar(255)'
		);
		
		...
		
		public function getCMSFields() {
			$fields = parent::getCMSFields();
			
			$metaField = $fields->fieldByName('Root.Main.Metadata');
			$metaField->push(TextareaField::create('MetaAuthor', 'Author'));
			$metaField->push(TextareaField::create('MetaCopyright', 'Copyright'));
			
			return $fields;
		}
		
		...
	}

If you run dev/build?flush=all and then browse to your page type, you'll see the fields you just defined in the
expandable Meta Tags area on the main Page edit view.

To display them, you'll need to override the MetaTags function in your page type:

	:::php
	class Publication extends Page {
		...
		
		public function MetaTags($includeTitle = true) {
			$tags = parent::MetaTags($includeTitle);
			
			if ($this->MetaAuthor) {
				$tags .= "<meta name=\"author\" content=\"" . Convert::raw2att($this->MetaAuthor) . "\" />\n";
			}
			if ($this->MetaCopyright) {
				$tags .= "<meta name=\"copyright\" content=\"" . Convert::raw2att($this->MetaCopyright) . "\" />\n";
			}
			
			return $tags;
		}
	}

That will take all of the tags that the Page::MetaTags() function defines and then add our custom ones on.

We could automatically generate some of our own easily enough:

	:::php
	class Publication extends Page {
		...
		
		public function MetaTags($includeTitle = true) {
			$tags = $parent->MetaTags($includeTitle);
			
			...
			
			$tags .= "<meta name=\"last-modified\" content=\"" . date('Y-m-d@G:i:s T', strtotime($this->LastEdited)) . "\" />\n";
			
			return $tags;
		}
	}
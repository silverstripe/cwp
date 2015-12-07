title: Adding an allowed extension for file upload
summary: Customising the file extensions allowed to be uploaded by CMS users.

# Adding an allowed extension for file upload

By default, CMS editors will only be able to upload a file with an extension in the `File.allowed_extensions` config
setting.

CMS editors can see the current extensions allowed by going into the CMS "Files" section, hitting the "Upload" button
and clicking "Show allowed extensions".

To allow someone to upload a file extension that does not appear in this list, you will need to add some code to
support this. In this example, we'll allow files with the `.sspak` extension to be uploaded.

In your `mysite/_config/config.yml` file, add the following to register the new extension:

	File:
	  allowed_extensions:
	    - 'sspak'

Additionally, you will need to add the MIME type of `.sspak` files into the `HTTP.MimeTypes` config setting, as uploads
will have extra checks to ensure the file content matches the uploaded extension, and that's done using the MIME type.

To find the MIME type of the file, first locate an example of an `.sspak` file, and run the following command line
utility to get the MIME type:

	file -i /path/to/my/file.sspak

Note: OS X requires the argument `-i` in the above example to be `-I` instead.

The output will be something like this:

	file.sspak: application/x-tar; charset=binary

You'll want the `application/x-tar` part in the output. Given that, once again open `mysite/_config/config.yml`
and add the following to register the new MIME type:

	HTTP:
	  MimeTypes:
	    'sspak': 'application/x-tar'

This will globally allow the new extension to be uploaded, this covers all instances of `UploadField` used in the CMS,
as well as the frontend of your website.

For reference, a [MIME type list](http://www.iana.org/assignments/media-types/media-types.xhtml) can be found on the
IANA website.


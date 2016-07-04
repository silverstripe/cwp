title: Infrastructural considerations
summary: Aspects of the CWP server environment infrastructure to be aware of when developing SilverStripe CMS for CWP.

# Infrastructural considerations

## HTTP Request time limit

The CWP "Gateway" server which fronts all CWP instances
has a HTTP request timeout limit of 60 seconds.

All HTTP requests to CWP environments are affected by this limit. Any request that exceeds this limit will continue to be processed on the back-end server, however the CWP "Gateway" server will generate a 504 (Gateway Timeout) error. 

<div class="warning" markdown='1'>
Your publicly accessible URLs should never take a long time to process, as this leaves your instance open to denial of
service attacks. You should definitely hide these behind a login or a captcha, or use caching and other optimisations
to bring down the processing time.
</div>

The request time limit on the platform is set to 120s at which point a 503 error will be returned. This is
to prevent overloading of the shared parts of the infrastructure. However your underlying instance process will still
be running - without a way to return any output to requester.

The preferred way to handle your long-running processes is via the 
[queuedjobs](https://github.com/silverstripe-australia/silverstripe-queuedjobs) module. 
You can extend the time limit of a PHP process is to use the SilverStripe Framework APIs `increase_time_limit_to`.

Consider using [caching](how_tos/caching) to speed up request execution.

## PHP configuration

CWP instances are running PHP 5.6 (see Debian "Jessie" [packages](https://packages.debian.org/jessie/)).

The default `memory_limit` configuration is 128 MB. You can increase this to 256 MB
with `ini_set('memory_limit', '256M');` in your code.
Please call this on a per-script basis. Increasing the limit for all requests increases the likelihood of server instability with high traffic.
If you have a script which requires more than 256 MB, we typically recommend making it a task, runnable from a cron job on a schedule.
Please raise a ticket via [Service Desk](https://www.cwp.govt.nz/service-desk) for help with this.

## PHP extensions

Environments within a CWP instance are turnkey deployments of a standardised environment. For security and
supportability reasons we do not allow the installation of binaries, PHP extensions or other deviations from the
standard environment that are not encapsulated within the PHP code deployed into the instance.

These PHP extensions are part of the standard environment, and can be relied on to be available:

* curl
* gd
* mbstring
* mcrypt
* tidy

## Webserver

CWP instances are running Apache 2.4 (see Debian "Jessie" [packages](https://packages.debian.org/jessie/)).
Note that there's other [caching infrastructure](/how_tos/caching) in front of CWP instances.

## Database

CWP is running on MariaDB 10.0 (see Debian "Jessie" [packages](https://packages.debian.org/jessie/)).
For local development, you can also choose MySQL 5.6.

## Hosting video

CWP instances do not provide built in hosting of video content, and we recommend you do not attempt to do so.

Instead, we recommend hosting video on a third-party service, such as vimeo.com. They provide a simple, turn-key
solution optimised for hosting video that is easily integrated with CWP instances.

Since the resource allocated to a CWP instance is directly related to the cost per month for an instance, we have
optimised the network bandwidth allocated to an instance for hosting standard HTML content and regular files such as
pdfs, docs, etc. Video files are much larger than most other assets, and exceed this network bandwidth. Attempting to
host video files will cause severely degraded performance for your other users.

If you do need to host video within CWP, please contact us to have a quote provided for a custom instance with
sufficient bandwidth for hosting. You will also need to provide your own solution for other elements of video hosting,
such as:

1. Transcoding the video to the variety of formats needed by different web-enabled devices
1. A player that provides the necessary controls and accessibility extensions to the devices built-in video playing
support

## Other features

 * [Varnish and Incapsula caching](how_tos/caching)
 * [Outgoing HTTP proxy](/how_tos/external_http_requests_with_proxy)
 * [WKHTMLTOPDF](http://wkhtmltopdf.org/) is available in version 0.12.1.1.
 * [Solr search](/features/solr_search)
 * [Apache Tika](/features/solr_search/searching_documents)

## Process for new infrastructure features

Where your business requirements necessitate a server-side feature that is not currently present, there are several
options available:

* Wrapping of the feature as a web application hosted outside the CWP infrastructure (either at your own cost or
through an external provider)
* Integration of feature as a CWP standard feature, either through directly funded work or through the co-fund pool
(we are unlikely to accept requests to integrate features that duplicate functionality already present within CWP)

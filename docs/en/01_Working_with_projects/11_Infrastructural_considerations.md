title: Infrastructural considerations
summary: Aspects of the CWP server environment infrastructure to be aware of when developing SilverStripe CMS for CWP.

# Infrastructural considerations

## Overview

The high level CWP infrastructure is outlined on cwp.govt.nz.
More detail is available through a solution architecture document on request
to participating agencies. See [technical and architecture information](https://www.cwp.govt.nz/about/technical-and-architecture-information/).
Please review our [Performance Guide](/performance-guide/index)
for recommendations on how to use the available infrastructure efficiently.

## HTTP request time limit

The PHP execution limit (`max_execution_time`) is 30 seconds,
after which a 503 (Service Unavailable) error will be returned. 

The CWP "Gateway" server which fronts all CWP stacks
has a HTTP request timeout limit of 120 seconds, after which it will
generate a 504 (Gateway Timeout) error.
This is preventing overloading of the shared parts of the infrastructure.

<div class="alert alert-warning" markdown='1'>
Your publicly accessible URLs should never take a long time to process, as this leaves your environment open to denial of
service attacks. You should definitely hide these behind a login or a captcha, or use caching and other optimisations
to bring down the processing time.
</div>

The preferred way to handle your long-running processes is via the 
[queuedjobs](https://github.com/symbiote/silverstripe-queuedjobs) module. 
You can extend the time limit of a PHP process by using the SilverStripe Framework APIs `\SilverStripe\Core\Environment::increaseTimeLimitTo()`.

Consider using [caching](/performance-guide/caching) to speed up request execution.

## PHP configuration

CWP environments are running PHP 5.6 (see Debian "Jessie" [packages](https://packages.debian.org/jessie/)).

The default `memory_limit` configuration is 128 MB. You can increase this to 256 MB
with `ini_set('memory_limit', '256M');` in your code.
Please call this on a per-script basis. Increasing the limit for all requests increases the likelihood of server instability with high traffic.
If you have a script which requires more than 256 MB, we typically recommend making it a task, runnable from a cron job on a schedule.
Please raise a ticket via the [CWP Service Desk](https://www.cwp.govt.nz/service-desk) for help with this.

## PHP extensions

Environments within a CWP stack are turnkey deployments of a standardised environment. For security and
supportability reasons we don't allow the installation of binaries, PHP extensions or other deviations from the
standard environment that are not encapsulated within the PHP code deployed into the environment.

These PHP extensions are part of the standard environment, and can be relied on to be available:

* curl
* gd
* mbstring
* mcrypt
* tidy

## Webserver

CWP environments are running Apache 2.4 (see Debian "Jessie" [packages](https://packages.debian.org/jessie/)).
Note that there's other [caching infrastructure](/performance_guide/caching) in front of your CWP environment.

## Database

CWP is running on MariaDB 10.0 (see Debian "Jessie" [packages](https://packages.debian.org/jessie/)).
For local development, you can also choose MySQL 5.6.

## Hosting video

CWP stacks don't provide built-in hosting of video content, and we recommend you don't attempt to do so.

Instead, we recommend hosting video on a third-party service, such as vimeo.com. They provide a simple, turn-key
solution optimised for hosting video that is easily integrated with CWP environments.

Since the resource allocated to a CWP environment is directly related to the cost per month for a stack, we have
optimised the network bandwidth allocated to an environment for hosting standard HTML content and regular files such as
pdfs, docs, etc. Video files are much larger than most other assets, and exceed this network bandwidth. Attempting to
host video files will cause severely degraded performance for your other users.

If you do need to host video within CWP, please contact us to have a quote provided for a custom stack with
sufficient bandwidth for hosting. You will also need to provide your own solution for other elements of video hosting,
such as:

1. Transcoding the video to the variety of formats needed by different web-enabled devices
2. A player that provides the necessary controls and accessibility extensions to the devices' built-in video playing
support

## Other features

 * [Varnish and Incapsula caching](/performance_guide/http_caching)
 * [Outgoing HTTP proxy](/how_tos/external_http_requests_with_proxy)
 * [WKHTMLTOPDF](http://wkhtmltopdf.org/) is available in series 0.12.4.
 * [Solr search](/features/solr_search)
 * [Apache Tika](/features/solr_search/searching_documents)

## Process for new infrastructure features

Where your business requirements necessitate a server-side feature that is not currently present, there are several
options available:

* Wrapping of the feature as a web application hosted outside the CWP infrastructure (either at your own cost or
through an external provider)
* Integration of the feature as a CWP standard feature, either through directly funded work or through the co-fund pool
(we are unlikely to accept requests to integrate features that duplicate functionality already present within CWP)

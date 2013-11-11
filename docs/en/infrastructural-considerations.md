<!--
title: Infrastructural considerations
pagenumber: 7
-->

# Infrastructural considerations

## PHP execution time limit

The default execution limit on the PHP side is 30s. However it is possible to extend that time programmatically. When
doing so, one has to consider the implications to an instance, and to the platform.

<div class="warning" markdown='1'>
Your publicly accessible URLs should never take a long time to process, as this leaves your instance open to denial of
service attacks. You should definitely hide these behind a login or a captcha, or use caching and other optimisations
to bring down the processing time.
</div>

The request time limit on the platform is set to 120s at which point a 503 error will be returned. This is
to prevent overloading of the shared parts of the infrastructure. However your underlying instance process will still
be running - without a way to return any output to requester.

Preferred way to handle your long-running processes is via the queuedjobs module. The preferred way to extend the time
limit of a PHP process is to use the SilverStripe Framework API's `increase_time_limit_to`.

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

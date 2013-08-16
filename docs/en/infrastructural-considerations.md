<!--
title: Infrastructural considerations
pagenumber: 6
-->

# PHP execution time limit

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

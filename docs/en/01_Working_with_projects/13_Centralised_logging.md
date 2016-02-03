title: Centralised logging
summary: Describes how to use CWP centralised logging
introduction: Describes how to use CWP centralised logging

# Centralised logging

The logs for each instance you have on CWP are collected and stored in a
centralised installation of Graylog.

You can access Graylog using your CWP log-in at the following URL:
[https://logs.cwp.govt.nz/](https://logs.cwp.govt.nz/).

We provide a Graylog "stream" for each instance environment. Streams are where
you can view and query the stored logs. These include Apache, PHP, and any
custom logging you want to write.

## Logging custom events

In addition to the standard logging events from Apache, PHP etc, you may wish
to send some of your own messages to Graylog.

The following code in your `mysite/_config.php` will configure `SS_Log` to send
events to the syslog of the server, which will then be forwarded to Graylog:

    $sysLogWriter = new SS_SysLogWriter();
    SS_Log::add_writer($sysLogWriter, SS_LOG::DEBUG, '<=');

Now when you call `SS_Log::log()` the event will be pushed to Graylog:

	SS_Log::log('Something seems to have happened', SS_Log::DEBUG);

You may wish to create your own subclass of `SS_LogErrorFileFormatter` to format
the specific log line that will be sent.

For more information, see [logging in SilverStripe documentation](https://docs.silverstripe.org/en/3.1/developer_guides/debugging/error_handling/).

## Searching

Each search requires a time period to search (default is last 5 minutes) and
query string. The query string uses Graylog's query syntax which you can find
more about by reading [Graylog documentation](http://docs.graylog.org/en/latest/pages/queries.html).

To get you started with Graylog there are some predefined searches you can
select from the top right corner. These are:

* Apache Access Logs
* PHP Errors (Notice, Warning, Fatal)

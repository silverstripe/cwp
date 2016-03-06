title: Centralised logging
summary: Describes how to use CWP centralised logging
introduction: Describes how to use CWP centralised logging

# Centralised logging

The logs for each instance you have on CWP are collected and stored in a
centralised installation of Graylog.

You can access Graylog using your CWP log-in at the following URL:
[https://logs.cwp.govt.nz/](https://logs.cwp.govt.nz/).

We provide a stream for each instance environment. Streams are where
you can view and query the stored logs. These include Apache, PHP, and any
custom events that you want to log.

## Searching

Each search requires a time period to search (default is last 5 minutes) and
query string. The query string uses Graylog's query syntax which you can find
more about by reading [Graylog documentation](http://docs.graylog.org/en/latest/pages/queries.html).

To get you started with Graylog there are some predefined searches you can
select from the top right corner. These are:

* Apache Access Logs
* PHP Errors (Notice, Warning, Fatal)

Following are a couple of examples on search queries:

 - Find web requests for the url "/about-us/"

    `http_url:"/about-us/"`

 - Find web requests that begins with "/about-us/"

    `http_url:\/about-us\/*`

    Note that the following characters needs to be escaped with a backslash:

    `&& || : \ / + - ! ( ) { } [ ] ^ " ~ * ?`

 - Find web requests that resulted in a 5xx error response
 
    `http_response:>=500`

 - Find web requests that resulted in a 4xx error response

    `http_response:(>=400 AND <500)`
   

## Analysis of logs

Graylog provides several tools to analyse your search results. To analyse a 
field from your search results, expand the field in the search sidebar and click
on the button of the analysis you want to perform.
![search analysis](/_images/logs/search_analysis.png)

### Field statistics

You can compute different statistics on your fields, to help you better summarize and 
understand the data in them.

The statistical information consist of: total, mean, minimum, maximum, standard
deviation, variance, sum, and cardinality. On non-numeric fields, you can only
see the total amount of messages containing that field, and the cardinality of
the field, i.e. the number of unique values it has.

![field_statistics](/_images/logs/field_statistics.png)

### Quick values
You can use quick values to help you find out the distribution of values for a field. 
Alongside a graphic representation of the common values contained in a field, 
Graylog will display a table with all different values, allowing you to see the
number of times they appear. You can include any value in your search query by
clicking on the magnifying glass icon located in the value row.
![quick values](/_images/logs/quick_values.png)

### Field graphs
You can create field graphs for any numeric field, by clicking on the Generate
chart button in the search sidebar. Using the options in the Customize menu on
top of the field graph, you can change the statistical function used in the 
graph, the kind of graph to use to represent the values, the graph
interpolation, as well as the time resolution.

![field graphs](/_images/logs/field_graph.png)

For more information see [Graylog analysis documentation](http://docs.graylog.org/en/1.2/pages/queries.html#analysis).

## Logging custom events

In addition to the standard logging events from Apache, PHP etc, you may wish
to send some of your own messages to Graylog.

The following code in your `mysite/_config.php` will configure `SS_Log` to send
events to the syslog of the server, which will then be forwarded to Graylog:

    $sysLogWriter = new SS_SysLogWriter();
    SS_Log::add_writer($sysLogWriter, SS_Log::NOTICE, '<=');

Now when you call `SS_Log::log()` the event will be pushed to Graylog:

	SS_Log::log('Something seems to have happened', SS_Log::NOTICE);

You may wish to create your own subclass of `SS_LogErrorFileFormatter` to format
the specific log line that will be sent.

For more information, see [logging in SilverStripe documentation](https://docs.silverstripe.org/en/3.1/developer_guides/debugging/error_handling/).

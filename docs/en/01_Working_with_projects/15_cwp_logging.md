# How to use CWP logging

When trying to identify the source of an issue or problem with your website, you will find yourself wanting to look at the server logs to try and find the root cause of your problem. This guide will help you with the CWP logging system and how to use it to get the information you need.

**Location:** https://logs.cwp.govt.nz/

## Introduction

CWP use Graylog as an internal logging collection and display dashboard. This has a lot of built in functionality that can be used for searching logs which you can find here. http://docs.graylog.org/en/2.4/pages/queries.html

CWP sends almost every server log into this system so you won’t just be dealing with PHP / SilverStripe logs, you will also be seeing infrastructure and system logs.

### Log types

```filter
log_type:”apache”
log_type:”SilverStripe_log”
```

When searching through logs, it can often be a good idea to restrict your search based on a specific log type. This helps to remove all the non-related logs from your view and find the logs you are searching for a bit easier.

#### Useful log types

- `SilverStripe_log` - SilverStripe Application logs
- `apache` - Apache access logs
- `apache-error` - Apache error logs
- `php` - PHP error logs
- `postfix/error` - Email error logs
- `postfix/bounce` - Email bounce logs


### Finding errors

Most of the time you will be searching through logs to trying and find the source of an error / problem you are having. Below are some tips on how to use Graylog’s search tool to help find your logs.

#### HTTP response codes

```filter
log_type:apache AND http_response:500
```

One easy way to find issues relating to your website may be via the response codes (e.g. Client has reported 500 errors on pages). You can filter requests to the webserver by response codes to help identify pages throwing errors.

#### SilverStripe errors

```filter
log_type:SilverStripe_log
```

Finding SilverStripe logs is as easy as defining the log_type filter to the defined log identifier for your codebase.

https://github.com/silverstripe/cwp-core/blob/master/_config/logging.yml#L13

#### Excluding log types

```filter
NOT log_type:apache AND NOT log_type:cron
```

Sometimes you just want to search a time period of a reported fault for any errors / issues during that time frame. Doing this usually results in a lot of logs that are not required (e.g. postfix, apache, cron). You can use the Search filter to remove specific log types from a search.

### Helpful search queries

Below is a list of useful search queries to get you started.

#### Long loading pages (requests longer than 10 seconds)

```filter
log_type:apache AND http_resp_usec:>10000000
```

#### Large assets / pages (requests larger than 1mb)

```filter
log_type:apache AND http_bytes:>1000000
```

#### Identifying 404s (missing pages / assets)

```filter
log_type:apache AND http_response:404
```

#### Filter requests made by IP

```filter
log_type:apache AND http_clientip:”x.x.x.x”
```

#### Filter requests made by User agent

```filter
log_type:apache AND http_agent:”Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)”
```

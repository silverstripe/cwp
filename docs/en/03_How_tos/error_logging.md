title: Error logging
summary: How to set up email error logging in CWP environments.

# Error logging

Basic recipe is configured to send all logs to syslog, which are accessible through the
[centralised logging system](../01_Working_with_projects/13_Centralised_logging.md).

To send logs to email (in addition to syslog) add the following to your `mysite/_config.php`:

```php
// log errors and warnings
SS_Log::add_writer(new SS_LogEmailWriter('admin@domain.com'), SS_Log::WARN, '<=');
```

Please note this is only able to capture events that occur after the Framework has bootstrapped successfully.
PHP parse errors and segmentation faults are sent to the centralised logging system bypassing the `SS_Log`.


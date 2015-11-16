<!--
title: Error logging
-->

# Error logging

A CWP environment can seem like a black box when it comes to errors. The recommended method of viewing error logs is by adding a log writer in your mysite/_config.php:

```php
// log errors and warnings
SS_Log::add_writer(new SS_LogEmailWriter('admin@domain.com'), SS_Log::WARN, '<=');
```

You may need to raise a General Support request if the error is not capturable by SS_Log, e.g. memory limit exceeded errors, or access logs.
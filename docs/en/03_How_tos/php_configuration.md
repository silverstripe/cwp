title: PHP Configuration
summary: Details of the PHP version being used on CWP environments.

# PHP Configuration
Your php.ini uses a standard configuration.

A few items of note:

## PHP Version
Environments are running PHP 5.6. Some environments may have not been upgraded yet and will be running PHP 5.3.3.

## Memory Limit
memory_limit = 128M
The default memory limit is 128 MB. You can increase this to 256 MB using:

ini_set('memory_limit', '256M');

Please call this on a per-script basis. Increasing the limit for all requests increases the likelihood of server instability with high traffic.

If you have a script which requires more than 256 MB, we typically recommend making it a task, runnable from a cron job on a schedule.
Please raise a General Support Request for help with this.

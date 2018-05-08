title: Inspecting the audit log
summary: How to search through the audit log

# Inspecting the audit log

All CWP projects based on the installer (or using the cwp-core module) include the
[silverstripe/auditor module](https://github.com/silverstripe/silverstripe-auditor) which collect such security-related
events as:

* Login attempts (failed and successful)
* Logouts
* Page manipulations that may potentially affect the live site
* Security-related changes such as Members being added to groups or permission changes.

To inspect the audit log, proceed to the [centralised logging](https://logs.cwp.govt.nz/) system, select the stream
related to your environment and search for:

	log_type:SilverStripe_audit

See the [centralised logging system](../01_Working_with_projects/13_Centralised_logging.md) for more information on working
with Graylog.

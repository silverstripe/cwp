title: Maintenance screen
summary: How to add an "under maintenance" for deployments and server outages.

# Maintenance screen

In some situations it is necessary to display a temporary error or maintenance screen, in order to provide a
fallback page when an environment is unavailable.

In order to ensure that this error page is available, it's necessary to create *ErrorPages* in the CMS with
the appropriate error codes. Setup the following (as below) with the codes 500 and 503. This generates the
`assets/error-500.html` and `assets/error-503.html`files necessary.

![Creating an error page](/_images/creating-an-error-page.png)

These pages will be displayed to the user in the following situations:

* [During server error or outage](#during-server-error-or-outage-2)
* [During Deployment](#during-deployment-2)

## Error pages during server error or outage

In the event that the destination environment is completely unavailable, the error-500.html page will be served directly
from the gateway. This will also respond to most general server errors.

This page and its assets will be updated regularly to ensure that a cached backup of all necessary files are available.

Note that this page is normally created by default during install.

## Error pages during Deployment

During the course of certain deployment activities Deploynaut will display the error-503.html page for the duration
of the process.

![Default maintenance screen](/_images/default-maintenance-screen.jpg)

From the technical perspective, Deploynaut creates temporary `.htaccess` and `maintenance.html` files. It assumes that
the codebase comes with `.htaccess`, so this is renamed and stored for later retrieval. Websites must not create their
own `maintenance.html` however as this will cause deployments to fail or the file to be destroyed. The maintenance page
will either be uploaded from Deploynaut template, or created from `assets/error-503.html` (if available).

`.htaccess` is then used to redirect all requests to the maintenance page. After the process has completed (or failed)
the former `.htaccess` is restored and `maintenance.html` removed.


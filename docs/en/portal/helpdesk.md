# Helpdesk

The helpdesk site is the main method of interacting with your instances and requested that deployments or work being
carried out on them.

## Access

Every user on the CWP platform has access to the helpdesk and is able to make requests. If any request is deemed
"dangerous" (possible to cause an outage) or requires a financial expenditure from the partipating agency, then the
request is sent to a technical contact for approval before any action is taken.

## Raising a ticket

To make a request, you must raise a ticket. To do this, log in to the helpdesk, select the ticket category from the top
right, and press the "Create Ticket" button in the central navigation. This will display a form with all the fields
relevant for that request. Fill these in and click the "Submit Report" button. This will email the user and the CWP
team with the new ticket. You can track progress on all your outstanding tickets with the "View Tickets" button.

## Ticket categories

### Deploy UAT to production

This ticket is used to deploy the exact code (not page content or files) that exist on the UAT environment to the
production environment. In other words, update the live site.

This is deemed a "dangerous" action and requires the approval of a technical contact.

### General

This is used for all tickets that don't fall into the other categories.

### Add Additional Test Environment

This is used to create a new test environment inside the requested instance. This should be used in the case that an
extra test environment is necessary for development - one development team might be working on an different feature
from the main development team, so require a separate testing environment to work on.

This will incur additional costs and requires the approval of a technical contact.

### Alter domains

This is used if an instance should be responding to different domains that it currently is. Please note that this will
not take care of the DNS, that is left up to the agency to manage. This just controls which sites CWP will serve up to
visitors based on the domain they're asking to browse.

### Request new instance

This is used to create an entirely new instance controlled by the participating agency. This requires a substantial
amount of information and is usually filled out with assistance from a representative of the service provider, at least
for an agency's first instance.

This will incur ongoing costs and requires the approval of the agency-wide technical contact.

### Transfer database and assets

This is used to syncronise the content (page content and files) between environments within an instance. This is
commonly used when wanting to work with the production content on the UAT environment, or if the content has been
entered on the UAT environment to be "deployed" to the production environment.

## Category ID

Many of the tickets require the "Instance ID" to be specified. This is the unique identifier that each instance is
given when it is created. It is usually, but not always, the primary domain name of the instance. It can be found on
the portal for that instance.
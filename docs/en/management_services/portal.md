# Portal

The portal site is the first port of call of the entire CWP Management Services. It contains a high-level overview
of your instances as well as links to the other parts of the Management Services.

## Instances

When you log on to the portal you will see a menu entry for each agency that you have access to at least one instance
of. For agency-wide users this will always only be a single agency. For per-instance users, this may be more than one
if they happen to have access to more than one agencies' instances (only really likely in the case of a development
agency).

Beneath each agency is a page for each instance. This contains the unique instance ID for that instance (used when
referencing the instance on the helpdesk) as well as sub-pages containing reports and user lists.

### Reporting

Each instance has a page containing a high-level report that summarises the health of the instance and how much of its
server's resources it is currently using. If its usage reaches certain thresholds then recommendations will be made
about a potential upgrade or downgrade, either to make the site better able to handle its increasing traffic load or to
save money by not buying excess resources that are sitting idle.

The areas covered by the report are storage (hard drive space, used by site content and files), memory (short-term
memory used while serving the site) and CPU load (processing power used when serving the site). For each of these you
can see an average usage, any alerts and a summary.

At the bottom is a list of all the occurrences of site outages. This list will contain the time that the event was
first noticed by the automatic testing, the time it was detected to have ended, as well as some more information about
what type of outage it was.

### Users

Each instance has a page containing a list of users that currently have access to that instance. This includes all the
agency-wide users, as well as any other users that have access to that specific instance (for example, external
developers and testers).

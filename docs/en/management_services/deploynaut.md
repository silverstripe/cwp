# Deploynaut overview

Deploynaut is the deployment management system that CWP uses to manage deployments to the different instances.

This documentation provides only an overview of Deploynaut, for a more thorough explaining of its capabilities and
step-by-step guides see the developer documentation.

## Access

The access to deploy to UAT as well as any additional environments is given to PTCs, ITCs, PA Managers and Instance Managers as
part of the Management Services account.

## Deployments

Each instance is tied to a primary repository, and it is only from this repository that deployments are possible. A user
that has access to deployments can choose a Gitlab revision to deploy and schedule it. The deployment is scheduled in a
queue and will be performed as soon as a backend worker becomes available.

To roll a deployment back, choose a historical revision from the dropdown.

Production deployments are only requestable via helpdesk and are enacted by the platform operator upon explicit
confirmation from ITC (or PTC).

## Historic data

Deploynaut stores a list of builds that have been deployed on each instance, and the times that it was deployed there.
It also stores all the historic builds. This makes it easy to roll back to a previous version or the last-known working
version very quickly.

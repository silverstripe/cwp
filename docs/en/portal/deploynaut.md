# Deploynaut

Deploynaut is the deployment management system that CWP uses to manage deployments to the different instances.

This documentation provides only an overview of Deploynaut, for a more thorough explaining of its capabilities and
step-by-step guides see the developer documentation.

## Access

Like Gitlab, the technical contact is given an account for Deploynaut and controls the users and who has access to
deploy which sites.

If a technical contact loses access and needs their password reset they can request this through the helpdesk.

## Deployments

A user that has access to make deployments can perform an instant deployment to the UAT environment from the latest
version of the code in Gitlab. A deployment the production environment cannot be done by any user via Deploynaut,
regardless of access level. They must be requested through the helpdesk and get the approval of the techincal contact.

## Historic data

Deploynaut stores a list of builds that have been deployed on each instance, and the times that it was deployed there.
It also stores all the historic builds. This makes it easy to roll back to a previous version or the last-known working
version very quickly.
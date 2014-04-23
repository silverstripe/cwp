<!--
title: Deploying code
pagenumber: 7
-->

# Deploying code

This section will walk you through the deployment of a code release onto an enviornment.

## Overview

CWP comes with a deployment system allowing you to push releasess of code onto environments. You can access
that system by going to [deploy.cwp.govt.nz](http://deploy.cwp.govt.nz). You'll be asked for access details to get in,
which you should have already been given.

Once logged in, click through to an instance. At the top in the "Environments" table you'll see a list of available
environments along with extra information: build currently deployed and your deploy permission status.

Under "Repository" you will see information about the repository currently hooked up to this instance. One instance
can only ever have one repository assigned to it regardless of the number of environments it has.

Below, under "Public key", you can see a deployment key. One such key is generated for every instance and is used for
establishing trust between Gitlab (the code repository) and Deploynaut.

At the very bottom you will see one or more tables listing revisions found in the repository along with detected
tags and information on the environments currently running given revision.

To access the deployment history click through to the environment and see the "Deploy history" table at the very
bottom.

## Deploy key

Deploynaut needs to be able to access your repositories. This is done using private-public keypair - access is granted
by setting up the public key on the selected repositories in Gitlab. You will need to deal with the keys if you have not
requested a repository during the instance creation or if you have dependencies on private repositories.

The public key can be found in the Deploynaut interface under the "Public key" section.

![Deploynaut - project key](_images/deploynaut-project-key.jpg)

It's content is not secret (there is a private counterpart that only the server knows) so proceed to Gitlab
to add it to all your repositories that need to be included in the deployment.

If you have already been set up with a repository you should have an instance key visible in the interface. Add
it by clicking "enable" button next to it.

![Gitlab - associating project key with a private module](_images/gitlab-enable-key.jpg )

<div class="notice" markdown='1'>
You will only see the deployment key if you are the owner of the repository. Check the "Team" tab to see who the owner
is. Currently, if you are not the owner, you will need to ask the person to do it for you. It's a one-off task.
</div>

If you have opted for an empty instance you will need to add a "New deploy key" instead and paste the public key hash
as seen in Deploynaut.

When including private repositories remember they have to have a "private" flag set on them in the `composer.json`
file. See [working with modules](working-with-modules) for more information.

## Fetching changes

To get the latest changes available in the repository hit the "Fetch latest changes" button. This is an equivalent of a
`git fetch origin` on you local machine. After a short moment you should see new tags, branches and commits coming
through.

## Deploying

Depending on your permission level you will have access to deploy to different environments. For example Technical
Staff can freely deploy to UAT and test environments, but not to production.

To deploy, choose an environment under "Environments". Under "Deploy a new release" select the revision and
press "Deploy to {environment name}".

A new window will appear with the console output of the deployment process. Depending on the availability of workers the
process may start immediately or may be queued. As a general guideline it should take no longer than a minute or two
to deploy.

You can save the URL with the console output and revisit it later to see how the deployment is progressing. Revisting
the URL will not cause the deployment to restart.

Most of the deployment is performed as a transaction. The code is uploaded into a secondary directory before being
rotated with the original code. If the deployment fails at any point it will be rolled back without causing changes to
the site. If the deployment fails due to "unauthorised" errors, check if your project and modules have the deployment
key added as described above and that the private modules have the "private" flag set.

For the duration of the deployment a maintenance screen will be put up using `.htaccess` substitution. The webserver
will return a 503 error during that time.

## Deploying to production site

When viewing your project on the Deploynaut you'll see that "Can you deploy?" is set to "No" for prod environments.  We
restrict the live deployments to the Service Desk team at the moment. Before deploying we will do a little smoke test
and also take backups.

In order for you to deploy to the production site you'll need to create a new ticket on
[helpdesk.cwp.govt.nz](http://helpdesk.cwp.govt.nz) to request the deployment. The deployment will push the revision
currently running on UAT and deploy it to production.

When creating a ticket in the Service Desk choose **Deploy UAT to production**. The Service Desk staff will be in touch
regarding your deployment request.

## Tagging your code

A good release practice is to tag a certain Git revision to a version number each time you are doing a release.

This is done by tagging a release from the developer's machine and pushing tags into Gitlab. They will be picked up
automatically by Deploynaut. To get started, first check which tags are already available:

	git tag

If you get no output, there's no tags.

Let's create a new tag. You can name the tag anything, but a typical scheme involves using version numbers. It's a good
idea to establish a versioning scheme that is known to everyone in the team - you can for example use [semantic
versioning](http://semver.org/). It's also a good idea to create annotated tags so the information about the person
doing the release is retained.

Create a new annotated tag called 1.0:

	git tag -a 1.0 -m "First release."

Tags don't get pushed automatically when you use `git push` - you need to request this specifically:

	git push origin --tags

Now when you go back to [deploy.cwp.govt.nz](http://deploy.cwp.govt.nz) and press "Fetch latest changes" you'll see
a new option appearing on the deploy screen: "Deploy a tagged release". This makes it much simpler to choose the right
revision to deploy.

## Maintenance screen

Deploynaut has an automated capability to put up a maintenance screen during deployments. See [maintenance
screen](cwp-features/maintenance_screen) for further information on how to control it.

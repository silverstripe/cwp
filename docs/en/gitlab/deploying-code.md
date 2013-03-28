# Deploying code

This section covers how to deploy your site code onto an instance.

CWP comes with a deployment system allowing you to push code yourself onto UAT instances. You can access that system
by going to [deploy.cwp.govt.nz](http://deploy.cwp.govt.nz). You'll be asked for access details to get in, which you
should have already been given. Enter those to access the deploy site.

## deploy.cwp.govt.nz overview

Once you've logged into [deploy.cwp.govt.nz](http://deploy.cwp.govt.nz), you'll see a list of instances. Click into an
instance and you'll find the environments that code can be deployed to, as well as a table of revisions from your Gitlab
repository for that instance.

Next to the environment name you'll see whether you can deploy "Can you deploy?" as well as "Build currently deployed"
which gives you a quick summary of what code is currently on the instance and whether you have permission to deploy
a release.

The table will show your recent commits, as well as any release tags (see "Tagging your code" below for how to create
a release tag.)

## Deploying to UAT site

Under "Environments", go to **uat**.

Under "Deploy a new release" select a build from the dropdown then click **Deploy to uat** to start the deployment.
A new window will appear with console output of the deployment process. The deployment process may take some time.

You can also see the deployment history for that instance in the "Deploy history" table.

## Deploying to production site

When viewing your project on deploy.cwp.govt.nz you'll see that "Can you deploy?" is set to "No" for prod environments.

In order for you to deploy to the production site, you'll need to create a new ticket on [helpdesk.cwp.govt.nz](http://helpdesk.cwp.govt.nz)
to request the deployment. The deployment will take a copy of UAT and copy it to production.

When creating a ticket on the helpdesk, choose **Deploy UAT to production** as the project, fill out the appropriate
fields and submit the ticket. The CWP administration team will be in touch regarding your deployment request.

## Tagging your code

Prior to deployment to a site, the best practise is to tag a certain Git revision to a version number. To do that, we'll
use Git's built-in tagging system and push the tag back so the deployment site can see it.

Start by going to your dev environment and going to where you've checked out your Git repo.

From there, let's see which tags we have:

	git tag

If you get no output, there's no tags.

Let's create a new tag. You can name the tag anything, but a typical scheme involves version numbers starting at 0.1.

Create a new tag called 0.1:

	git tag 0.1

Tags don't get pushed automatically when you use `git push`, so we need to push the tags to Gitlab so that the
deploy.cwp.govt.nz site can see it:

	git push --tags

Now when you go back to [deploy.cwp.govt.nz](http://deploy.cwp.govt.nz) you'll see your new tag in the revision table.
From there, you can deploy that tag (see "Deploying to UAT site" above.)
If your tag doesn't appear, you might need to wait a few minutes for the revision list to update.



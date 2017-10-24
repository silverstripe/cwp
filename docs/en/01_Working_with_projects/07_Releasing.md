title: Releasing
summary: Walkthrough for the deployment of a SilverStripe CMS code onto a CWP server environment.

# Releasing

A good release practice is to tag a certain Git revision to a version number each time you are doing a release.

This is done by tagging a release from the developer's machine and pushing tags into Gitlab. They will be picked up
automatically by Deploynaut. To get started, first check which tags are already available:

	git tag

If you get no output, there's no tags.

Let's create a new tag. You can name the tag anything, but a typical scheme involves using version numbers. It's a good
idea to establish a versioning scheme that is known to everyone in the team - you can for example use [semantic
versioning](http://semver.org/). It's also a good idea to create annotated tags so the information about the person
doing the release is retained.

Create a new annotated tag called 1.0.0:

	git tag -a 1.0.0 -m "First release."

Tags don't get pushed automatically when you use `git push` - you need to request this specifically:

	git push origin --tags

When deploying through [CWP Dashboard](http://dash.cwp.govt.nz) you can then select "Deploy a tagged version" (don't forget to "Fetch code" first!)

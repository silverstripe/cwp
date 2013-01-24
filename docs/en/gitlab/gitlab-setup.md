# Gitlab Setup 

This how to is intended for the development agencies. It details the initial process you should follow to configure your Gitlab repository.

## Your Gitlab Repository

When an instance is created you will be given a primary repository on the Gitlab server for the project.

During the deployment process, the UAT and production servers will retrieve the code from the primary repository so all code changes need to be pushed to the primary repository before they can be deployed to the UAT and Production servers.

## Configure Your Gitlab Profile and Primary Project

Once you've logged in to your Gitlab repository (your password would've been e-mailed to your given e-mail address) then you should go to your Gitlab profile and:

* Verify your details are correct
* Add your public SSH key(s)
* Ensure that the correct starting point exists (with the default CWP or CMS recipe)
* Check/create a README.md file, commit and push to the primary repository as required.
* Check/create a LICENSE file, commit and push to the primary repository as required.



# Gitlab Setup 

This how to is intended for the development agencies. It details the initial process you should follow to configure your Gitlab repository.

## Your Gitlab Repository

When an instance is created you will be given a primary repository on the Gitlab server for the project.

During the deployment process, the UAT and production servers will retrieve the code from the primary repository so all code changes need to be pushed to the primary repository before they can be deployed to the UAT and Production servers.

## Configure Your Gitlab Profile and Primary Repository

Once you've logged in to your Gitlab account (your password would've been e-mailed to your given e-mail address) then you should

* Verify your profile details are correct
* Setup your global user name and e-mail
	git config --global user.name "<Your Name>"
	git config --global user.email "<Your E-mail Address"
* Add your public SSH key(s)
* Ensure that the correct starting point exists (with the default CWP or CMS recipe)
* Checkout the primary repository on your local/dev computer
	mkdir <Primary Repo>
	git checkout git@gitlabserver.cwp.govt.nz:<User>/<Primary-Repo>.git <Primary-Repo>
* Create your new LICENSE file
* Commit and push the LICENSE file to the primary repository
	git add LICENSE
	git commit -m "Project License"
	git push -u origin master
* Check the README file, commit and push any changes which are required to the primary repository
	git add README
	git commit -m 'My Commit'
	git push -u origin master


title: Migrating CWP Git repository to GitHub
summary: Steps to ensure self managed GitHub repository works.

## Considerations
Please ensure the below considerations are thought through prior to moving your CWP Git repository into GitHub:
* You will be responsible for ensuring CWP systems are able to access your GitHub repository (access via SSH keys).
* You will be responsible for managing access to your GitHub repository.
* Management of the development team will not work from the CWP dashboard.
* Any support or development work (eg. bugs) by CWP support staff will require access to the GitHub project.
* Where CWP support staff have no access to a GitHub repository, any hotfixes applied to a site will be temporary.
* Repeated outages caused by custom code changes where CWP support staff have no access, may result in the disabling of monitoring systems until resolution of the underlying issue.

## Steps
1. [Create the GitHub private or public repository](https://help.github.com/articles/create-a-repo/) Create the GitHub private or public repository to be associated with the CWP instance.
2. [Locate your Deploy public key in the CWP Dashboard](/dashboard/deploy-keys).
3. Allow access to CWP systems by adding the above deploy key to the repository [starting at Setup step 2](https://developer.github.com/v3/guides/managing-deploy-keys/#deploy-keys).
4. In the CWP dashboard, click the "Edit Stack" button when viewing your stack, and enter the path to your new Git repository in the "Git repository URL" field.

Once saved, you'll need to perform a Fetch Code when setting up your next deployment to update the Git references you can choose from for your deployment.

## Troubleshooting
If an error occurs when attempting to fetch your code, confirm that:

* your stack deploy key was added to your repository in step 2.
* your Git repository URL is correct.
* your Git repository is not behind a firewall that is blocking CWP systems.

Once you've confirmed that the repository access is set up correctly but you are still unable to fetch your code, contact the Service Desk with the stack ID and the repository URL that isn't working for further assistance.

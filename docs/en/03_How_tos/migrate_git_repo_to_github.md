title: Migrating CWP Git repository to GitHub
summary: Steps to ensure self managed GitHub repository works.

## Considerations
Please ensure the below considerations are thought through prior to moving your CWP git repository into GitHub:
* You will need to ensure your instance has been migrated to the newer CWP Dashboard.
* You will be responsible for ensuring CWP systems are able to access your GitHub repository (access via SSH keys).
* You will be responsible for managing access to your GitHub repository.
* Management of the development team will not work from the CWP dashboard.
* Any support or development work (eg. bugs) by CWP support staff will require access to the GitHub project.
* Where CWP support staff have no access to a GitHub repository, any hotfixes applied to a site will be temporary.
* Repeated outages caused by custom code changes where CWP support staff have no access, may result in the disabling of monitoring systems until resolution of the underlying issue.

## Preparation
1. [Create the GitHub private or public repository](https://help.github.com/articles/create-a-repo/) Create the GitHub private or public repository to be associated with the CWP instance.
2. [Locate your Deploy public key in the CWP Dashboard](/dashboard/deploy-keys).
3. Allow access to CWP systems by adding the above deploy key to the repository [starting at Setup step 2](https://developer.github.com/v3/guides/managing-deploy-keys/#deploy-keys).

## Requesting repository migration to GitHub
Currently migration is managed through the CWP Service Desk.

Create a new CWP Service Desk request to [move a Git repository to a self managed GitHub Git repository](https://www.cwp.govt.nz/service-desk/requests/?target=set_project.php%3Fproject_id%3D23%3B59%26redirect_bug%3D1).

Once the instance manager has approved the request to migrate the repository to GitHub, CWP support staff will update the deployment services to reference the external repository.

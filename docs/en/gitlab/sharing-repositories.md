# Sharing Repositories With Others

This how to will show you how to share a repository with other Gitlab users.

## Allow Others to View Your Repositories

You can add any user of the Gitlab site to one of your repositories.

If you have additional files you wish to share with others, [create a new repository](./creating-repositories.md) (note that changes to locked repositories by third parties require merge requests).

Locate the repository that contains the files you wish to share and go to the Team tab.

There are 2 options available to handle permissions

![Team Memberships](_images/gitlab-team-home.png)

1. Import team from another project

 * This will allow you to import copy the team permissions from another project you have created

 ![Team Memberships](_images/gitlab-team-copypermissions.png)

 * Select the project to copy the permissions from the Project drop down box

2. New Team Member

 This will allow you to assign permissions to the repository to another Gitlab user

 ![Team Memberships](_images/gitlab-team-newuser.png)

 * Either type the name of the user or select from the drop down box
 * Select the access level required

 1. Guest		
  * Create new issue
  * Leave comments
  * Write on project wall

 2. Reporter (Guest plus)
  * Pull project code
  * Download project
  * Create a code snippet

 3. Developer (Reporter plus)
  * Create new merge request
  * Create new branches
  * Push to non-protected branches
  * Remove non-protected branches
  * Add tags
  * Write a wiki

 4. Master (Developer plus)
  * Add new team members
  * Push to protected branches
  * Remove protected branches
  * Push with force option
  * Edit project
  * Add Deploy Keys to project
  * Configure Project Hooks


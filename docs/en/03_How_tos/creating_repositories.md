title: Creating a project/repository
summary: How to create a new GitLab repository and grant access.

# Creating a project/repository

The below relates to the use of a Gitlab CWP hosted repository. If you have [migrated to a Github Git repository](/working_with_projects/setting_up_your_project/#making-your-first-project-commit-2), [please refer to the Github documentation](https://help.github.com/).

In Gitlab, a **Project** is also considered to be a repository.

Create a new one by clicking the **New Project** button in the Gitlab **Dashboard**.

![Gitlab New Project button on dashboard](/_images/gitlab-new-project.jpg)

## Assigning access to the project

The **Team** tab in your project view in Gitlab allows you to add new team members, import an entire team of other
users to the project, or modify existing team member permissions to the project.

![Gitlab Team tab for changing project access](/_images/gitlab-team-access.jpg)

There are different levels of access a user can have to your project.
[Gitlab permissions help](https://gitlab.cwp.govt.nz/help/permissions/permissions.md) has more information on the levels of permission
you can give users.

## Making the project public

Unless you don't want others to see it, you can create your project public by going to **Edit** tab while
viewing your project in Gitlab and checking the **Public clone access** checkbox.

This will mean anyone can `git checkout` your project.

It will also be listed on the [Gitlab Public Projects](http://gitlab.cwp.govt.nz/public) list.

![Setting public access in project settings](/_images/gitlab-public-project-setting.jpg)

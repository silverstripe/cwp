# Gitlab Setup

This documentation describes how to setup Git in your local development environment, and how to access the Gitlab admin
interface for managing code repositories.

It's assumed you're familiar with Git. If not, we recommend reading through tutorials on using Git, available online.
The [Pro Git](http://git-scm.com/book) book is a good reference to start with.

## Accessing Gitlab

Gitlab is available by accessing [http://gitlab.cwp.govt.nz](http://gitlab.cwp.govt.nz).

Once you're there, you'll be asked for an email and password. These details should've been emailed to you, so you can
enter these details now.

## Installing Git

If you're on Mac OS X, one way to get Git installed is to get Xcode with command line tools component included. Git will
be included in that package.

On Linux, depending on your flavour, the package manager should have Git available so you can install it.  On Debian or
Ubuntu Linux `apt-get install git` should be enough to get you started.

On Windows install [mysysgit](http://msysgit.github.com/) which provides Git support on Windows.

## Create an SSH public key

Git uses public-key cryptography for authorisation of users. You will need to generate a key pair for use with your
Gitlab account.

Start by checking if you don't already have a public key by opening `~/.ssh/id_rsa.pub`.  If the file exists, you
already have one, in which case you can skip this step. If not, let's create one:

	$ ssh-keygen -t rsa

You can leave default answers to most of the questions, but we recommend selecting a passphrase for your key.

Once that's done, you'll have two new files at `~/.ssh`. `id_rsa` contains your private key and should be kept secret.
`id_rsa.pub` is your public key and should be used with Gitlab.

Installing msysgit on Windows will give you access to `ssh-keygen.exe` which works similarly to the Unix style
equivalent.

## Entering your SSH key into Gitlab

Upon accessing Gitlab, you'll find a **Dashboard** page containing a summary of activity.

Open up **Profile** by hoving over your avatar and accessing **My profile**

Your SSH key needs to be entered into Gitlab so you have authorisation to checkout and commit code to your
repositories. Click the **Add Public Key** button.

![Enter SSH key](_images/gitlab-ssh-key.jpg)

Enter the contents of your public key (`~/.ssh/id_rsa.pub`) into the **Key** field.

Hit **Save**.

## Configuring Git

Setup your global user name and e-mail:

	git config --global user.name "<Your Name>"
	git config --global user.email "<Your E-mail Address"

These will identify you in code commits.

## Checking out your repository

When accessing Gitlab, you'll see a page like this. On the right hand side is a listing of your projects you have
access to. Access a project from here to find more information including the repository details:

![Gitlab projects](_images/gitlab-projects.jpg)

![Gitlab project repository URL](_images/gitlab-project-repo-url.jpg)

Now that you have the repository URL for the project, you can check it out into your environment with the following
command:

	git checkout <url> /path/to/webroot/myproject

Replace `/path/to...` with the path on your computer where you wish to store the project code.

## Your first commit to the repository

`cd` into the path where you checked out your repository.

Create a new empty README file and commit it:

	git add README
	git commit -m 'Adding README file'
	git push -u origin master

You've just pushed your first commit to Gitlab. Congratulations!

If you go back to the project page in Gitlab, and access the **Commits** tab you'll see your change.

## Where to from here?

[Setting up your project](../gitlab/setting-up-your-project) documentation will help you get started setting up
SilverStripe CMS and framework code, along with default templates.


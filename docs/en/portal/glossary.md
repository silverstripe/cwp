# Glossary

There are a lot of words used in the CWP documentation and architecture that have very specific meanings. These
meanings are defined here.

## Technical

 * **CMS:** See *Content Managment System*.
 * **Content Managment System:** Software used to edit a website by adding, editing and removing pages, files and other
 content.
 * **Deploy:** The act of moving a version of the website from development (ie, accessible only to those working on it)
to *UAT* (accessible to internal testers), or from UAT to *Production* (accessible to the all the website's users).
 * **Deploynaut:** Deployment software that is used to automate the process of moving code between *instances*.
 * **Disaster Recovery:** Restoring a website after it is brought offline for whatever reason.
 * **DR:** See *Disaster Recovery*.
 * **Environment:** A single installation of the website. The usual two are *UAT* and *production*.
 * **Git:** The version control software that CWP uses to store website code. Allows multiple users and teams to collaborate
on a single project. See *Repository*.
 * **Gitlab:** The repository management software that CWP uses.
 * **Instance:** A group of *environments* for a single website. Will consist of at least two, *UAT* and *Production*,
 but can contain more.
 * **Live:**  An informal way of referring to the *Production* environment.
 * **Platform:** An informal way of referring to the Common Web Platform.
 * **Production:** The *environment* that hosts the version of the website that is accessible to all the website's
users. Usually this means the general public, but access may be restricted in the case of an intranet or other private
site.
 * **Repository:** A location in which all the code responsible for running a site is stored. CWP uses *Git*, running
in the *Gitlab* system.
 * **Test:** An informal way of referring to the *UAT* environment.
 * **UAT:** User Acceptance Testing. Used to refer to the *environment* that is accessible only to a sites' internal
testers. A version of the website will be deployed here for testing before it is deployed to *production*.

## Agencies
 * **LA:** See *Participating Agency*.
 * **Lead Agency:** The primary agency that interacts with the *service provider*. This is the Department of Internal
Affairs.
 * **PA:** See *Participating Agency*.
 * **Participating Agency:** An agency signed up to use the Common Web Platform. May have one or more websites hosted
on the platform.
 * **Service Provider:** The company responsible for running the Common Web Platform. This is SilverStripe.

## Roles
 * **DIA Senior Responsible Officer:** 
 * **DIA online service delivery manager:** 
 * **DIA product manager:** 
 * **DIA lead relationship manager:** 
 * **SilverStripe business owner:** 
 * **SilverStripe business relationship manager:** 
 * **SilverStripe Solution Specialist:** 
 * **SilverStripe system administration team:** 
 * **Revera business development manager:** 
 * **PA Sponsor:** The highest point of escalation inside a participating agency.
 * **PA Relationship Manager:** Primary contact at Participating Agency. Represents the agency at the operational
review board. Access to reports about all of the agency's instances. Can approve requests for new instances.
 * **Instance primary contact:** Responsible for technical aspect of a website instance. Has access to reports about an
instance's performance. Can approve requests for deployments and other work. Manages access to the portal features.
 * **Instance CMS administrator:** Responsible for content and access for a website instance. Has full control over CMS
admin interface, including the ability to control other users' access to the admin interface. Can request deployments
and other work.
title: How to access CWP tool ports if you have a firewall 
summary: Ensuring you have access to the correct ports to work with the CWP external tools and sites.

CWP uses a selection of tools and code repository tools that you will need to ensure you can access from your local development environment.

These are:

 * *.github.com - ports 80, 443, 9418 (SilverStripe CMS code is here)
 * *.packagist.org - ports 80, 443 (Composer uses this to determine which code to install)
 * *.cwp.govt.nz - ports 80, 443 (CWP GitLab, Deployment tools, UAT servers etc)

\* refers to that the firewall should allow access to all subdomain websites for the domain name (a "wildcard"). 
For example, CWP has gitlab.cwp.govt.nz, deploy.cwp.govt.nz  etc.

You may need to talk internally to your Network or ICT team to ensure you can access these ports and sites.

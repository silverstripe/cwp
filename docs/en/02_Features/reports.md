title: CMS reports
summary: Useful default reports in the CMS and how to create them.

# CMS Reports

## Default reports

### Summary statistics report

Summary statistics report gives you access to metrics that will help you determine if your site fits on the given
stack size. The most important number here is "Total live page count, across all translations and subsites", which
can be compared directly with the "Max pages in CMS" listed in the stack size specifications.

To look at the report, go to the "Reports" section and select "Summary statistics" from the list.

### Site-wide content report

The site-wide content report shows "All content, page and files from across all subsites" in the CMS, 
so that an administrator can get a quick overview of the status of all content across site(s).

To look at the report, go to the "Reports" section and select "Site-wide content report" from the list.

## Developing custom reports
Custom reports can be created quickly and easily. A general knowledge of SilverStripe CMS's datamodel and ORM is useful before creating a custom report.

See [Customising site reports](https://docs.silverstripe.org/en/4/developer_guides/customising_the_admin_interface/how_tos/customise_site_reports/) in the Official SilverStripe CMS documentation

# Sharing Assets

Assets can be shared between instances in two ways:

## Initial transfer of assets from another instance

You will need to request the transfer of all assets from one instance to your new instance by submitting a helpdesk
request. Note that the instance has to be one that you have access to - either belonging to your agency if you have
agency-wide access, or an instance you have access to if you have instance-specific access. If not, you must have the
authorisation of the instance-holder.

Visit [http://helpdesk.cwp.govt.nz](http://helpdesk.cwp.govt.nz) and submit a new support request of the "Instance:
Transfer database & assets" category. Note that this will overwrite any existing assets and database (page content)
data that you have on your existing instance. Because of this it's best to do this procedure before any content-loading
has begun on the site.

You can use this same support request category to move assets between UAT and live environments of the same instance.

## Sharing files using Git

To share files between separate instances, such as a taxonomy, the development agency requiring access (destination)
will need to:

 1. Request access to the source Git repository containing the the required files from the responsible (source)
development agency
 1. Clone the repository and move the shared resource/file to the required location.
 1. Update the resource as they are aware of any changes.
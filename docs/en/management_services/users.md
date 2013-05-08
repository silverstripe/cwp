# Users and Access

Some of the Management Services require login, which should have already been provided to you.

The Management Services access is always understood as access to Portal, Helpdesk and Deploynaut jointly. There is no
possibility to provide access just for one of these subsystems.

On the other hand, Gitlab and CMS administrative panels are self-managed and treated separately from Management
Services. Docs are publicly visible.

## Management Services Roles

There are four roles applicable to the users of the Management Services.

Agency-wide roles:

* **PTC (Primary Technical Contact)**: the highest level of access. Apart from all other actions available in the system,
This role can approve sensitive requests for all agency's instances, as well as create new Management Services users.
This role also gets initial access to Gitlab, can create Gitlab users, and gets CMS credentials to all instances.
* **PA Manager**: can file helpdesk requests for all PA instances, but sensitive requests have to be approved by a PTC
or ITC. Can deploy to UAT.

Instance roles:

* **ITC (Instance Technical Contact)**: an instance-specific counterpart of ITC. Can approve all sensitive requests
pertaining to the specific instance, gets initial access to Gitlab, can create Gitlab users, and gets CMS credentials
to the instance.
* **Instance Manager**: an instance-specific counterpart of a PA manager. Sensitive requests for the instance need to
be approved by the ITC. Can deploy to UAT.

## Other roles

There are also other roles which are not represented on the Management Services in any way. They are self-managed in the
sense that the user accounts have to be maintained by the users themselves.

* **Gitlab users**: PTC and ITC are given initial accounts on Gitlab with the ability to create more users. Contact your
ITC (or PTC) if you need an account.
* **CMS users**: include CMS administrators, editors, publishers etc. The first administrative account is created by
PTC or ITC using the provided credentials, further accounts can be created by nominated administrators.

## Creating/removing Management Services users

Management Services users can be maintained through the [Helpdesk](http://helpdesk.cwp.govt.nz). Requests can be made to
add a new user, change instance access, remove users, reset a users's password etc.

## Note on Helpdesk access

All users have the ability to request actions through the helpdesk. The permission to execute the action will be checked
by the helpdesk operator when the ticket is being resolved. The operator might also seek approval from the ITC (or PTC
if ITC is not defined, or not contactable) when certain sensitive actions are being requested, or seek additional
confirmation from the requester.

title: Mail deliverability
summary: What to add in your DNS SPF record to ensure mail deliverability when sending email from a CWP server.

# Mail deliverability

If you wish to send mail from your stack as coming from your own domain, for example from info@example.com,
the receiving mail server might mark your emails as SPAM unless you make the following changes.

The mail server will typically look up your DNS information and look for SPF to check legitimacy.
You will need to update your DNS for your domain name. Add:

```
include:cwp.govt.nz
```

to the SPF record, this will inherit the CWP configuration.

Please feel free to create a support ticket in the [CWP Service Desk](https://www.cwp.govt.nz/service-desk/new-request/), if you need any help with this configuration.




<!--
title: Mail deliverability
-->

# Mail deliverability

If you wish to send mail from your instance as coming from your own domain, for example From: info@example.com,
the receiving mail server might mark your emails as SPAM unless you make the following changes.

The mail server will typically look up your DNS information and look for SPF to check legitimacy.
You will need to update your DNS for your domain name. Add:

```
include:cwp.govt.nz
```

to the SPF record, this will inherit the CWP configuration.

Please feel free to make a General Support request if you need any help with this configuration.


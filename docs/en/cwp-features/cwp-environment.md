# CWP Environment

This document describes the environment present on CWP instances.

## Available constants

The following [SilverStripe constants and globals](https://www.cwp.govt.nz/guides/core-technical-documentation/framework/en/topics/environment-management)
are set by default.

|Constant/Global|Guaranteed value|
|-|-|
|SS_ENVIRONMENT_TYPE|"live" on production, "test" on others|
|SS_DATABASE_SERVER|-|
|SS_DATABASE_USERNAME|-|
|SS_DATABASE_NAME|"SS_cwp"|
|SS_DATABASE_PASSWORD|-|
|SS_DEFAULT_ADMIN_USERNAME|-|
|SS_DEFAULT_ADMIN_PASSWORD|-|
|$_FILE_TO_URL_MAPPING|"http://<instance-id>.cwp.govt.nz"|

The following additional constants and globals are also configured.

|Constant/Global|Description|Guaranteed value|
|-|-|-|
|SS_STATIC_BASE_URL|Base URL for use by the static publisher (with trailing slash)|"http://<instance-id>.cwp.govt.nz/"|
|SS_OUTBOUND_PROXY|Proxy hostname to use for outbound HTTP(S) requests|-|
|SS_OUTBOUND_PROXY_PORT|Proxy port|-|
|CWP_ENVIRONMENT|CWP Environment|"prod", "uat", or "test"|
|CWP_SECURE_DOMAIN|Domain to use for CMS redirects, must have SSL certificate installed.|"<instance-id>.cwp.govt.nz"|
|DOCVERT_USERNAME|Document converter configuration|-|
|DOCVERT_URL|Document converter configuration|-|
|DOCVERT_PASSWORD|Document converter configuration|-|
|SOLR_SERVER|Solr configuration|-|
|SOLR_PORT|Solr configuration|-|
|SOLR_MODE|Solr configuration|-|
|SOLR_PATH|Solr configuration|-|
|SOLR_REMOTEPATH|Solr configuration|-|
|SOLR_INDEXSTORE_PATH|Solr configuration|-|
|SS_SESSION_KEY|Secret key used for hybrid sessions|-|
|CWP_URANDOM_TOKEN_1|1st random 24-character alphanumeric (A-Z, a-z, 0-9) token for your custom use|-|
|CWP_URANDOM_TOKEN_2|As above, 2nd token|-|
|CWP_URANDOM_TOKEN_3|As above, 3rd token|-|

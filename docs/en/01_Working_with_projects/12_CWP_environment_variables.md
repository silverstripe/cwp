title: CWP environment variables
summary: Describes the environment variables present on CWP instances.
introduction: Describes the environment variables present on CWP instances.

# CWP environment variables

## Available environment variables (PHP constants)

The following [SilverStripe CMS constants and globals](https://docs.silverstripe.org/en/3.2/getting_started/environment_management/)
are set by default on CWP environments.

|Constant/Global|Guaranteed value|
|-|-|
|SS_ENVIRONMENT_TYPE|"live" on production, "test" on others|
|SS_DATABASE_SERVER|-|
|SS_DATABASE_USERNAME|-|
|SS_DATABASE_NAME|"SS_cwp"|
|SS_DATABASE_PASSWORD|-|
|SS_DEFAULT_ADMIN_USERNAME|-|
|SS_DEFAULT_ADMIN_PASSWORD|-|
|$_FILE_TO_URL_MAPPING|"http://INSTANCEID-ENV.cwp.govt.nz"|

The following additional constants and globals are also configured.

|Constant/Global|Description|Guaranteed value|
|-|-|-|
|CWP_ENVIRONMENT|CWP Environment|"prod", "uat", "dr", "uatdr" or "test"|
|CWP_INSTANCE_DR_TYPE|DR type this instance is configured for|"backup", "passive", or "active"|
|CWP_URANDOM_TOKEN_1|Random 24-character alphanumeric (A-Z, a-z, 0-9) token, free for your custom use|-|
|CWP_URANDOM_TOKEN_2|As above, 2nd token|-|
|CWP_URANDOM_TOKEN_3|As above, 3rd token|-|
|SS_STATIC_BASE_URL|Base URL for use with the static publisher (includes trailing slash)|"http://INSTANCEID-ENV.cwp.govt.nz/"|
|SS_OUTBOUND_PROXY|Proxy domain to use for outbound HTTP(S) requests|-|
|SS_OUTBOUND_PROXY_PORT|Proxy port|-|
|CWP_SECURE_DOMAIN|Default domain used for secure redirects, used by the recipe|-|
|CWP_IP_BYPASS_BASICAUTH|Originating internal IPs allowed to bypass the BasicAuth, used by the recipe on uat and test|-|
|SS_SESSION_KEY|Secret key used by hybrid session module|-|
|DOCVERT_USERNAME|Document converter configuration|-|
|DOCVERT_URL|Document converter configuration|-|
|DOCVERT_PASSWORD|Document converter configuration|-|
|SOLR_SERVER|Solr configuration|-|
|SOLR_PORT|Solr configuration|-|
|SOLR_MODE|Solr configuration|-|
|SOLR_PATH|Solr configuration|-|
|SOLR_REMOTEPATH|Solr configuration|-|
|SOLR_INDEXSTORE_PATH|Solr configuration|-|

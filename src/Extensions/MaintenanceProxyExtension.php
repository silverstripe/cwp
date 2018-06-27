<?php

namespace CWP\CWP\Extension;

use BringYourOwnIdeas\Maintenance\Reports\SiteSummary;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;

/**
 * Used to configure proxy settings for bringyourownideas/silverstripe-maintenance and its related modules
 *
 * @see https://www.cwp.govt.nz/developer-docs/en/2/how_tos/external_http_requests_with_proxy
 */
class MaintenanceProxyExtension extends Extension
{
    /**
     * Configures required environment settings for Composer's use, applies to
     * {@link \BringYourOwnIdeas\Maintenance\Util\ComposerLoader} and is applied before ComposerLoaderExtension in
     * bringyourownideas/silverstripe-composer-update-checker to ensure the proxy information is set before Composer
     * is created
     */
    public function onAfterBuild()
    {
        // Provide access for Composer's StreamContextFactory, since it creates its own stream context
        if ($proxy = $this->getCwpProxy()) {
            $_SERVER['CGI_HTTP_PROXY'] = $proxy;
        }
    }

    /**
     * Provide proxy options for {@link \BringYourOwnIdeas\Maintenance\Util\ApiLoader} instances to use in
     * their Guzzle clients
     *
     * @param array $options
     */
    public function updateClientOptions(&$options)
    {
        if ($proxy = $this->getCwpProxy()) {
            $options['proxy'] = $proxy;
        }
    }

    /**
     * Returns a formatted CWP proxy string, e.g. `tcp://proxy.cwp.govt.nz:1234`
     *
     * @return string
     */
    protected function getCwpProxy()
    {
        if (!Environment::getEnv('SS_OUTBOUND_PROXY') || !Environment::getEnv('SS_OUTBOUND_PROXY_PORT')) {
            return '';
        }

        return sprintf(
            'tcp://%s:%d',
            Environment::getEnv('SS_OUTBOUND_PROXY'),
            Environment::getEnv('SS_OUTBOUND_PROXY_PORT')
        );
    }
}

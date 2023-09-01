<?php

namespace CloudCrm;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class CustomRemoteWebDriver extends RemoteWebDriver
{
    /**
     * Set capabilities of the RemoteWebDriver.
     *
     * @param DesiredCapabilities|array $capabilities The desired capabilities
     */
    public function setCapabilities($capabilities)
    {
        $this->capabilities = $capabilities;
    }
}
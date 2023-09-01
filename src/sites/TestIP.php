<?php

namespace CloudCrm\sites;

use CloudCrm\CloudCrmSelenium;
use Facebook\WebDriver\WebDriverBy;

class TestIP extends CloudCrmSelenium
{
    protected $site = 'https://2ip.ru/';
    protected $site_login = 'https://2ip.ru';

    protected function echoText()
    {
        echo "The session is '" . $this->driver->getSessionID() . "'\n";
        echo "The title is '" . $this->driver->getTitle() . "'\n";
        echo "The current URI is '" . $this->driver->getCurrentURL() . "'\n";
        echo "The current IP is '" . $this->driver->findElement(
                WebDriverBy::xpath('//div[@id="d_clip_button"]/span')
            )->getText() . "'\n";
        echo "Operating system '" . $this->driver->findElement(
                WebDriverBy::xpath(
                    '//div[contains(text(), "Операционная система")]/../div[@class = "ip-icon-label"]'
                )
            )->getText() . "'\n";
        echo "Your browser '" . $this->driver->findElement(
                WebDriverBy::xpath('//div[contains(text(), "Ваш браузер")]/../div[@class = "ip-icon-label"]')
            )->getText() . "'\n";
        echo "There are you from '" . $this->driver->findElement(
                WebDriverBy::xpath('//div[contains(text(), "Ваш браузер")]/../../div[4]/div[2]/a')
            )->getText() . "'\n";
    }

    public function run()
    {
        $this->driver->get($this->site);
        $this->echoText();
        $this->quit();
    }
}
<?php


namespace CloudCrm;

use Exception;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;


/**
 * Class DWSSelenium
 * @package DWS\Site
 */
abstract class CloudCrmSelenium
{

    /**
     * @var RemoteWebDriver
     */
    protected $driver;
    /**
     * @var string
     */
    protected $sessionID;
    /**
     * @var Data
     */
    protected $data;
    protected $site;
    protected $site_login;
    protected $session_array = [];
    protected $command = array();
    protected $code = 0;
    protected $message = 'Done';
    protected $input = 'php://input';
    protected $count_screenshot = 0;
    protected $wait;
    protected $browser = 'chrome';
    protected $browser_v = '104.0';
    protected $connection_timeout_in_ms = 180000;
    protected $request_timeout_in_ms = 86400000;
    protected $coefficient = 1;
    protected $timezone = 'Europe/Moscow';
    protected $time_start = 0;
    protected $time_last = 0;
    protected $quantityTrySee = 0;
    protected $site_check_get_url = true;
    protected $proxy_name;

    /**
     * @var string
     */
    private $dir_cache = '';
    protected string $type_connect = 'none';

    public function __construct()
    {
        $this->time_start = microtime(true);
        $this->time_last = microtime(true);
        if (method_exists($this, 'setParams')) {
            $this->setParams();
        }
        try {
            $this->driver = $this->connect();
            if ($this->type_connect === 'create') {

                if (method_exists($this, 'beforeGet')) {
                    $this->beforeGet();
                }

                $this->driver->get($this->site);
            }
        } catch (Exception $e) {
            $this->errorException($e);
            exit;
        }
    }

    protected function connect()
    {

        $capabilities = DesiredCapabilities::chrome();

        $capabilities->setCapability('browserName', 'chrome');
        $capabilities->setCapability('version', '104.0');
        $capabilities->setCapability('platformName', 'Linux');
        $localhost = 'localhost';
        $driver = RemoteWebDriver::create(
            'http://' . $localhost . ':4444', DesiredCapabilities::chrome()
        );
        $this->sessionID = $driver->getSessionID();
        $this->driver = $driver;
        $this->type_connect = 'create';

        return $driver;
    }


    abstract protected function run();

    public function start()
    {
        try {
            return $this->run();
        } catch (Exception $e) {
            $this->errorException($e);
            return false;
        }
    }
    public function quit()
    {
        $this->driver->quit();
    }

    /**
     * @param Exception $e
     * @param string $type
     */
    protected function errorException($e, $type = 'PHP Error'): void
    {
        $e_m = $e->getMessage();
        echo PHP_EOL;
        echo '====================' . PHP_EOL;
        echo $type . PHP_EOL;
        echo '====================' . PHP_EOL;
        echo 'Message: ' . print_r(mb_substr($e_m, 0, mb_strpos($e_m, "\n")), true) . PHP_EOL;
        echo 'Session: ' . print_r($this->sessionID, true) . PHP_EOL;
        echo 'Site: ' . print_r($this->get_class_name(), true) . PHP_EOL;
        echo 'Trace: ' . PHP_EOL . $this->tab_print_r($this->getExceptionTraceAsString($e, false)) . PHP_EOL;
        echo '====================' . PHP_EOL;
        echo PHP_EOL;
        $this->takeScreenshot();
    }
}
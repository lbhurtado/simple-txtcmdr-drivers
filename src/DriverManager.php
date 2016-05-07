<?php

namespace LBHurtado\SMS;

use LBHurtado\SMS\Drivers\Telerivet;
use LBHurtado\SMS\Drivers\Smart;
use LBHurtado\SMS\Drivers\Sun;
use SimpleSoftwareIO\SMS\DriverManager as BaseDriverManager;

class DriverManager extends BaseDriverManager
{
    /**
     * Create an instance of the telerivet driver
     *
     * @return Telerivet
     */
    public function createTelerivetDriver(){
        $config = $this->app['config']->get('sms.telerivet', []);
        $driver = new Telerivet($config['api_key'], $config['project_id']);

        return $driver;
    }

    /**
     * Create an instance of the smart driver
     *
     * @return Telerivet
     */
    public function createSmartDriver(){
        $config = $this->app['config']->get('sms.smart', []);
        $driver = new Smart($config['token'], $config['wsdl'], $config['service']);

        return $driver;
    }

    /**
     * Create an instance of the sun driver
     *
     * @return Sun
     */
    public function createSunDriver(){
        $config = $this->app['config']->get('sms.sun', []);
        $driver = new Sun($config['user'], $config['pass'], $config['mask'], $config['login_url']);

        return $driver;
    }
}
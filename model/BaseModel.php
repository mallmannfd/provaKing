<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 02/07/18
 * Time: 21:54
 */

namespace Unipago\model;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BaseModel
{
    /**
     * @var Logger
     */
    protected $reportLogger;

    /**
     * @var Logger
     */
    protected $errorLogger;

    public function __construct()
    {
        $this->setReportLogger();
        $this->setErrorLogger();
    }

    public function setReportLogger()
    {
        $log = new Logger('report');
        $log->pushHandler(new StreamHandler('logs/report.log', Logger::INFO));

        $this->reportLogger = $log;
    }

    public function setErrorLogger()
    {
        $log = new Logger('error');
        $log->pushHandler(new StreamHandler('logs/error.log', Logger::INFO));
        $this->errorLogger = $log;
    }
}

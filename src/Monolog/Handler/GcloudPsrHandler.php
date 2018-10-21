<?php

namespace Softspring\GcloudIntegrationBundle\Monolog\Handler;

use Google\Cloud\Logging\Logger;
use Google\Cloud\Logging\PsrLogger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger as MonologLogger;

class GcloudPsrHandler extends AbstractProcessingHandler
{
    protected static $mapLevel = [
        MonologLogger::DEBUG => Logger::DEBUG,
        MonologLogger::INFO => Logger::INFO,
        MonologLogger::NOTICE => Logger::NOTICE,
        MonologLogger::WARNING => Logger::WARNING,
        MonologLogger::ERROR => Logger::ERROR,
        MonologLogger::CRITICAL => Logger::EMERGENCY,
        MonologLogger::ALERT => Logger::ALERT,
        MonologLogger::EMERGENCY => Logger::EMERGENCY,
    ];

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var array
     */
    protected $messageOptions;

    /**
     * GcloudPsrHandler constructor.
     *
     * @param int       $level
     * @param bool      $bubble
     * @param PsrLogger $logger
     * @param array     $messageOptions
     */
    public function __construct($level = Logger::DEBUG, $bubble = true, PsrLogger $logger, $messageOptions = [])
    {
        parent::__construct($level, $bubble);
        $this->logger = $logger;
        $this->messageOptions = $messageOptions;
    }

    /**
     * @param array $record
     */
    public function write(array $record)
    {
        $message = (string) $record['formatted'];

        $options = $this->messageOptions;
        $options['severity'] = $this->mapLevel($record['level']);

        $this->logger->write($message, $options);
    }

    /**
     * @param int $level
     *
     * @return int
     */
    protected function mapLevel($level)
    {
        return self::$mapLevel[$level];
    }
}
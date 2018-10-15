<?php
/**
 * @author https://github.com/websvcPT
 * 
 * @file Logs.php
 * @creation Apr 22, 2017 
 */

namespace PhpMonologWrapper;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Logs {

	const DEBUG = 100;
    const INFO = 200;
    const NOTICE = 250;
    const WARNING = 300;
    const ERROR = 400;
    const CRITICAL = 500;
    const ALERT = 550;
    const EMERGENCY = 600;
	public $levels = array(
        self::DEBUG     => 'DEBUG',
        self::INFO      => 'INFO',
        self::NOTICE    => 'NOTICE',
        self::WARNING   => 'WARNING',
        self::ERROR     => 'ERROR',
        self::CRITICAL  => 'CRITICAL',
        self::ALERT     => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    );

	/**
	 * The monolog logger
	 * @var type
	 */
	private $logger;
	private $logFile = '/tmp/logger.log';
	private $loggerLevel = 'INFO';
	private $toStderr = false;

	/**
	 * initializes log class default values
	 */
	function __construct( $name='logger', array $options = array(), array $handlers = array(), array $processors = array() ){

		if( !empty($options)){
			foreach ($options as $key => $value) {
				$this->{$key} = $value;
			}
		}

		$this->logger = new Logger($name, $handlers, $processors );
		if(!$this->toStderr){
			$this->logger->pushHandler(new StreamHandler($this->logFile, $this->getLevelValue($this->loggerLevel)));
		}

	}

	/**
	 * Returns the INT value of a level
	 * 
	 * @param string $NAME
	 * @return integer level int val
	 * @throws \InvalidArgumentException
	 */
	public function getLevelValue($NAME){
		$levelsReverse = array_flip($this->levels);
		if( !array_key_exists($NAME, $levelsReverse)){
			throw new \InvalidArgumentException('Level "'.$NAME.'" is not defined, use one of: '.implode(', ', array_keys($levelsReverse)));
		}
		return $levelsReverse[$NAME];
	}


	/**
	 * Add a log record
	 * 
	 * @param integer $level
	 * @param string $message
	 * @param array $context
	 * @return Boolean
	 */
	public function addLog($level='INFO', $message='-', $context=[]){
		$level = $this->getLevelValue($level);
		return $this->logger->addRecord($level, $message, $context);
	}

}

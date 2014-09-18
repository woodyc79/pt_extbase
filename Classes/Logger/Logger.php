<?php
/***************************************************************
 *  Copyright (C) 2014 punkt.de GmbH
 *  Authors: el_equipo <opiuqe_le@punkt.de>
 *
 *  This script is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser General Public License as published
 *  by the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Lesser General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *  Tx_PtExtbase_Logger_Logger
 *
 */
class Tx_PtExtbase_Logger_Logger implements t3lib_singleton {

	/**
	 * @var Tx_PtDpppBase_Utility_ExtensionConfiguration
	 */
	protected $extensionConfiguration;

	/**
	 * @var t3lib_log_Logger
	 */
	protected $logger;


	/**
	 * @var string
	 */
	protected $logFilePath;


	/**
	 * @var string
	 */
	protected $exceptionDirectory;


	/**
	 * @var string
	 */
	protected $defaultLogComponent;

	/**
	 * @param Tx_PtDpppBase_Utility_ExtensionConfiguration $extensionConfiguration
	 * @return void
	 */
	public function injectExtensionConfiguration(Tx_PtDpppBase_Utility_ExtensionConfiguration $extensionConfiguration) {
		$this->extensionConfiguration = $extensionConfiguration;
	}



	/**
	 * @param string $logFilePath
	 * @param string $exceptionDirectory
	 */
	public function __construct() {
		$this->defaultLogComponent = __CLASS__;
	}



	public function initializeObject() {
		$this->configureLogger();
	}


	/**
	 * @param string $logFilePath
	 * @param string $exceptionDirectory
	 */
	public function configureLogger($logFilePath = '', $exceptionDirectory = '') {

		$this->logFilePath = $logFilePath;
		$this->exceptionDirectory = $exceptionDirectory;

		if(!$this->logFilePath) {
			$this->logFilePath = $this->extensionConfiguration->getKeyFromExtensionConfiguration('pt_dppp_base', 'logFilePath');
		}

		if(!$this->exceptionDirectory) {
			$path_parts = pathinfo($this->logFilePath);
			$this->exceptionDirectory = realpath($path_parts['dirname'] . '/Exceptions/') . '/';
		}

		$GLOBALS['TYPO3_CONF_VARS']['LOG']['Tx']['writerConfiguration'] = array(
				t3lib_log_Level::INFO => array(
				'Tx_PtExtbase_Logger_Writer_FileWriter' => array(
					'logFile' => $this->logFilePath
				)
			)
		);
	}


	/**
	 * @param string $logComponent
	 * @return t3lib_log_Logger
	 */
	protected function getLogger($logComponent) {
		if($logComponent === NULL) $logComponent = $this->defaultLogComponent;
		return $this->logger = t3lib_div::makeInstance('t3lib_log_LogManager')->getLogger($logComponent);
	}


	/**
	 * Shortcut to log a CRITICAL record.
	 *
	 * @param string $message Log message.
	 * @param array $data Additional data to log
	 * @param string $logComponent
	 */
	public function critical($message, $logComponent = NULL, array $data = array()) {
		$this->getLogger($logComponent)->critical($message, $data);
	}



	/**
	 * Shortcut to log an ERROR record.
	 *
	 * @param string $message Log message.
	 * @param array $data Additional data to log
	 * @param string $logComponent
	 */
	public function error($message, $logComponent = NULL, array $data = array()) {
		$this->getLogger($logComponent)->error($message, $data);
	}



	/**
	 * Shortcut to log an WARN record.
	 *
	 * @param string $message Log message.
	 * @param array $data Additional data to log
	 * @param string $logComponent
	 */
	public function warning($message, $logComponent = NULL, array $data = array()) {
		$this->getLogger($logComponent)->warning($message, $data);
	}



	/**
	 * Shortcut to log an INFORMATION record.
	 *
	 * @param string $message Log message.
	 * @param array $data Additional data to log
	 * @param string $logComponent
	 */
	public function info($message, $logComponent = NULL, array $data = array()) {
		$this->getLogger($logComponent)->info($message, $data);
	}



	/**
	 * Shortcut to log a DEBUG record.
	 *
	 * @param string $message Log message.
	 * @param array $data Additional data to log
	 * @param string $logComponent
	 */
	public function debug($message, $logComponent = NULL, array $data = array()) {
		$this->getLogger($logComponent)->debug($message, $data);
	}



	/**
	 * @param integer $level
	 * @param string $message
	 * @param array $data
	 * @param string $logComponent
	 */
	public function log($level, $message, $logComponent = NULL, array $data = array()) {
		$this->getLogger($logComponent)->log($level, $message, $data);
	}


	/**
	 * Writes information about the given exception into the log.
	 *
	 * @param \Exception $exception The exception to log
	 * @param null $logComponent
	 * @param array $additionalData Additional data to log
	 * @return void
	 * @api
	 */
	public function logException(\Exception $exception, $logComponent = NULL, array $additionalData = array()) {
		$backTrace = $exception->getTrace();
		$message = $this->getExceptionLogMessage($exception);

		if ($exception->getPrevious() !== NULL) {
			$additionalData['previousException'] = $this->getExceptionLogMessage($exception->getPrevious());
		}

		if (!file_exists($this->exceptionDirectory)) mkdir($this->exceptionDirectory);

		if (file_exists($this->exceptionDirectory) && is_dir($this->exceptionDirectory) && is_writable($this->exceptionDirectory)) {

			$referenceCode = ($exception->getCode() > 0 ? $exception->getCode() . '.' : '') . date('YmdHis', $_SERVER['REQUEST_TIME']) . substr(md5(rand()), 0, 6);
			$exceptionDumpPathAndFilename = $this->exceptionDirectory . $referenceCode . '.txt';
			file_put_contents($exceptionDumpPathAndFilename, $message . PHP_EOL . PHP_EOL . $this->getBacktraceCode($backTrace,1));
			$message .= ' - See also: ' . basename($exceptionDumpPathAndFilename);
		} else {
			$this->warning(sprintf('Could not write exception backtrace into %s because the directory could not be created or is not writable.', $this->exceptionDirectory), $logComponent, array());
		}

		$this->critical($message, $logComponent, $additionalData);
	}


	/**
	 * @param \Exception $exception
	 * @return string
	 */
	protected function getExceptionLogMessage(\Exception $exception) {
		$exceptionCodeNumber = ($exception->getCode() > 0) ? ' #' . $exception->getCode() : '';
		$backTrace = $exception->getTrace();
		$line = isset($backTrace[0]['line']) ? ' in line ' . $backTrace[0]['line'] . ' of ' . $backTrace[0]['file'] : '';
		return 'Uncaught exception' . $exceptionCodeNumber . $line . ': ' . $exception->getMessage();
	}


	/**
	 * Renders some backtrace
	 *
	 * @param array $trace The trace
	 * @return string Backtrace information
	 */
	protected function getBacktraceCode(array $trace) {
		$backtraceCode = '';
		if (count($trace)) {
			foreach ($trace as $index => $step) {
				$class = isset($step['class']) ? $step['class'] . '::' : '';

				$arguments = '';
				if (isset($step['args']) && is_array($step['args'])) {
					foreach ($step['args'] as $argument) {
							$arguments .= (strlen($arguments) === 0) ? '' : ', ';
						if (is_object($argument)) {
								$arguments .= get_class($argument);
						} elseif (is_string($argument)) {
								$arguments .= '"' . $argument . '"';
						} elseif (is_numeric($argument)) {
								$arguments .= (string)$argument;
						} elseif (is_bool($argument)) {
								$arguments .= ($argument === TRUE ? 'TRUE' : 'FALSE');
						} elseif (is_array($argument)) {
								$arguments .= 'array|' . count($argument) . '|';
						} else {
								$arguments .= gettype($argument);
						}
					}
				}

				$backtraceCode .= sprintf('%03d', (count($trace) - $index)) . ' ' . $class . $step['function'] . '(' . $arguments . ')';

				$backtraceCode .= PHP_EOL;
			}
		}

		return $backtraceCode;
	}
}
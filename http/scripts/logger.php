<?php

    $defaultLogFile = '/var/log/escape/php.log';

    class Logger {

        public static function debug($message) {
            Logger::log('Debug', $message);
        }

        public static function error($message) {
            Logger::log('Error', $message);
        }

        public static function log($level, $message) {
            global $defaultLogFile;
            $date = date("y-m-d H:m:s");
            $result = "[{$date}] [{$level}] {$_SERVER['REMOTE_ADDR']} {$message}".PHP_EOL;

            if (!file_exists($defaultLogFile)) {

                if (!file_exists(dirname($defaultLogFile))) {
                    mkdir(dirname($defaultLogFile));
                }

                $myfile = fopen($defaultLogFile, "w");

                fclose($myfile);
            }

            error_log($result, 3, $defaultLogFile);

        }
    }
 ?>

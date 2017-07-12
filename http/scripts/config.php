<?php
    require_once 'logger.php';

    // This script will load the config file and store it in
    // $GLOBALS['config']

    $defaultConfigFile = '/var/opt/escape/config.ini';

    //echo "executing init.php...";
    // Will always result to true since globals are not system wide (they are per user)
    if (!array_key_exists('configLoaded', $GLOBALS)) {
        
        if (file_exists($defaultConfigFile)) {
            Logger::debug('Parsing config from '.$defaultConfigFile.'...');
            $result = parse_ini_file($defaultConfigFile);

            if ($result) {

                $GLOBALS['config'] = $result;
                Logger::debug('Config file has been parsed from '.$defaultConfigFile);
                $GLOBALS['configLoaded'] = true; // This needs to be set for the session.
            } else {
                Logger::debug('Failed to parse config file at '.$defaultConfigFile);
            }

        } else {
            Logger::debug("Could not find config file at {$defaultConfigFile}");
        }

    } else {
        Logger::debug('Config file has already been loaded, skipping.');
    }

 ?>

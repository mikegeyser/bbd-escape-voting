#!/bin/bash

source utils/bash-ini-parser
cfg_parser 'config.ini'
cfg_section_logging
echo $logFile

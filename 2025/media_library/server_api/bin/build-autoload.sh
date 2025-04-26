#!/bin/bash
####
# @author stev leibelt <artodeto@bazzline.net>
# @since 2014-04-18
####

# moving to project root
SCRIPT_PATH=$(cd $(dirname "$0"); pwd)
cd "$SCRIPT_PATH/../"

# building autoload
composer dumpautoload --optimize

exit 0

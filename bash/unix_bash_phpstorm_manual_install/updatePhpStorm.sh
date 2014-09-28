#!/bin/bash

ENVIRONMENT='production'

#todo
#source from script path
#implement clean up (pack previous version, remove old version if user answered questions with yes)

source step-01-get-name-and-path.sh
source step-02-upack-and-cd-into-new-directory.sh
source step-03-installing-new-version.sh

step01 "$@"
step02 "$@"
step03 "$@"

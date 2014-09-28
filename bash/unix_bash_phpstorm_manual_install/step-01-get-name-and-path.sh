#!/bin/bash

function step01()
{
    SCRIPT_NAME=$(basename $0)

    if [ "$#" != 1 ]; then
        echo 'Usage: '$SCRIPT_NAME' <path to new version>'
        exit 1
    fi

    echo 'step 01 - started'

    NEW_VERSION_REALPATH=$(realpath "$1");

    if [ ! -f "$NEW_VERSION_REALPATH" ]; then
        echo 'Provided file path does not exists: "'$NEW_VERSION_REALPATH'"'
        exit 1
    fi

    if [[ ${#ENVIRONMENT} = 0 ]]; then
        echo 'Real path: "'$NEW_VERSION_REALPATH'"'
    fi

    echo 'step 01 - finished'
}

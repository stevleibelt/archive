#!/bin/bash

function step02()
{
    echo 'step 02 - started'

    #for test purpose
    if [[ ${#ENVIRONMENT} = 0 ]]; then
        echo $0' test environment'
        NEW_VERSION_REALPATH="/path/to/PhpStorm-x.y.z.tar.gz"
    fi

    CWD=$(dirname $(realpath $0))
    NEW_VERSION_DIRECTORY=$(dirname $NEW_VERSION_REALPATH)
    NEW_VERSION_FILE=$(basename $NEW_VERSION_REALPATH)

    #for test purpose
    if [[ ${#ENVIRONMENT} = 0 ]]; then
        echo 'cwd: "'$CWD'"'
        echo 'new version directory: "'$NEW_VERSION_DIRECTORY'"'
        echo 'new version file: "'$NEW_VERSION_FILE'"'
    fi

    cd $NEW_VERSION_DIRECTORY

    echo 'unpacking file '$NEW_VERSION_FILE

    tar -xzf "$NEW_VERSION_FILE"

    SOURCE_DIRECTORY=$(realpath $(ls -t | head --lines=1))

    echo 'step 02 - finished'
}

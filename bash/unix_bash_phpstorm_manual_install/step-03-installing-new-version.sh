#!/bin/bash

#reshape variable namings
function step03()
{
    echo 'step 03 - started'

    _step03SetUpVariables "$@"
    _step03Install "$@"
    _step03Linking "$@"

    echo 'step 03 - finished'
}

function _step03SetUpVariables()
{
    #todo remove it or move it in a way that it is not anoying
    #for test purpose
    if [[ ${#ENVIRONMENT} = 0 ]]; then
        echo $0' test environment'
        NEW_VERSION_FILE='PhpStorm-x.y.z.tar.gz'
        SOURCE_DIRECTORY='/path/to/PhpStorm-xyz.abc'
        echo 'new version file: '$NEW_VERSION_FILE
    fi

    LENGTH_OF_NEW_VERSION_PREFIX=$(expr length "PhpStrom-")
    LENGTH_OF_NEW_VERSION_SUFFIX=$(expr length ".tar.gz")
    LENGTH_OF_NEW_VERSION=$(expr length $NEW_VERSION_FILE)
    START_POSITION=$LENGTH_OF_NEW_VERSION_PREFIX
    LENGTH_OF_THE_SUBSTRING=$(($LENGTH_OF_NEW_VERSION-$LENGTH_OF_NEW_VERSION_PREFIX-$LENGTH_OF_NEW_VERSION_SUFFIX))

    #todo remove it or move it in a way that it is not anoying
    #for test purpose
    if [[ ${#ENVIRONMENT} = 0 ]]; then
        echo "LENGTH_OF_NEW_VERSION: "$LENGTH_OF_NEW_VERSION
        echo "LENGTH_OF_NEW_VERSION_PREFIX: "$LENGTH_OF_NEW_VERSION_PREFIX
        echo "LENGTH_OF_NEW_VERSION_SUFFIX: "$LENGTH_OF_NEW_VERSION_SUFFIX
        echo "START_POSITION: "$START_POSITION
        echo "LENGTH_OF_THE_SUBSTRING: "$LENGTH_OF_THE_SUBSTRING
    fi
    NEW_VERSION_NUMBER=${NEW_VERSION_FILE:$START_POSITION:$LENGTH_OF_THE_SUBSTRING}
    PATH_TO_INSTALL='/opt/phpstorm-'$NEW_VERSION_NUMBER
}

function _step03Install()
{
    echo 'installing version: '$NEW_VERSION_NUMBER
    echo 'source: '$SOURCE_DIRECTORY
    echo 'destination: '$PATH_TO_INSTALL

    #todo - mkdir only if not exists
    sudo mv "$SOURCE_DIRECTORY" "$PATH_TO_INSTALL"
    sudo chmod -R 750 "$PATH_TO_INSTALL"
    sudo chgrp -R developer "$PATH_TO_INSTALL"
}

function _step03Linking()
{
    echo 'linking to new version'

    #todo - only link if cp and creation didn't throw an error
    sudo rm "/opt/phpstorm"
    sudo ln -s "$PATH_TO_INSTALL" '/opt/phpstorm'
}

#!/bin/bash
########
# This is the file for debian linux if you call target.
# http://www.cyberciti.biz/tips/linux-debian-package-management-cheat-sheet.html
#
# @author stev leibelt
# @since 2013-01-12
########

function target_clean() {
  sudo apt-get clean
  return 0
}

function target_install()
{
  if [ ! $# -gt 0 ]
    then
      echo "You have to provide at least one package to install."
      return 1
  else
    sudo apt-get install $@
  fi
}

function target_manual()
{
  echo 'this is the arch environment to maintain your system'
  return 0
}

function target_search()
{
  if [ ! $# -gt 0 ]
    then
      echo "You have to provide at least one search term."
      return 1
  else
    apt-cache search $@
    return 0
  fi
}

function target_uninstall()
{
  if [ ! $# -gt 0 ]
    then
      echo "You have to provide at least one package name."
      return 0
  else
    sudo apt-get remove $@
    return 0;
  fi
}

function target_update()
{
  sudo apt-get update
  return 0
}

function target_upgrade()
{
  sudo apt-get upgrade
  return 0
}

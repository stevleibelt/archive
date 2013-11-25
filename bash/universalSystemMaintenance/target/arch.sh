#!/bin/bash
########
# This is the file for arch linux if you call target
#
# @author stev leibelt
# @since 2013-01-12
########

function target_clean() {
  sudo pacman -Sc
  return 0
}

function target_install()
{
  if [ ! $# -gt 0 ]
    then
      echo "You have to provide at least one package to install."
      return 1
  else
    sudo pacman -S $@
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
    pacman -Q $@
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
    sudo pacman -Rs $@
    return 0;
  fi
}

function target_update()
{
  sudo pacman -Sy
}

function target_upgrade()
{
  sudo pacman -Syu
  return 0
}

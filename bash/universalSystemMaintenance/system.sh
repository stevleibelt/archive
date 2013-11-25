#!/bin/bash
########
# This is the central script. You should add an alias to your 
#  bashrc like "alias system=/path/to/system.sh"
#
# @author stev leibelt
# @since 2013-01-12
########
function net_bazzline_system_maintenance()
{
  if [ $# -eq 0 ]; then
    echo "You have to provide a target, try manual." 
    return 1
  fi

  #define variables
  PATH_BASE=$PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE
  PATH_TO_TARGETS=$PATH_BASE'/target'
 
  #check system integrity
  if [ -z $PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE ]; then
    echo 'Define PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE in your .bashrc'
    echo 'Change to the directory of this tool and execute install.sh'
    return 1
  fi

  if [ -z $NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET ]; then
    echo 'Define NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET in your .bashrc'
    echo 'Change to the directory of this tool and execute install.sh'
    return 1
  else
    FILE_TARGET=$NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET
  fi

  if [ ! -f $PATH_TO_TARGETS'/'$FILE_TARGET'.sh' ]; then
    echo $FILE_TAGET'.sh is missing'
    return 1
  else
    source $PATH_TO_TARGETS'/'$FILE_TARGET'.sh'
  fi

  #call target based on argument
  case $1 in
    'update') target_update ${@:2};;
    'upgrade') target_upgrade ${@:2};;
    'clean') target_clean ${@:2};;
    'uninstall') target_uninstall ${@:2};;
    'install') target_install ${@:2};;
    'search') target_search ${@:2};;
    'manual') target_manual ${@:2};;
  esac
}

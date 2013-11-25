#!/bin/bash
########
# This is the install script.
# Execute it when the main script is not running.
# You don't have to call the install script as long as you
#  do the steps on your own (and based on your environment)
#
# In general this script is doing the following steps.
# Add the variable PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE in your 
#  .bashrc file
# Add (if you want to) a alias to your .bashrc
# Sets a softlink from the provided autcomplete.sh to 
#  /etc/bash_completion.d
#
# @author stev leibelt
# @since 2013-01-13
########

clear

#validate if install.sh is executed in the project directory
if [ ! -f system.sh ]; then
  echo 'system.sh not found'
  echo 'The install script should be executed in the base path.'
  echo 'Please change into the base path and try again.'
  exit 1
fi

echo 'Enter "y" if you want to adapt .bashrc.'
echo 'If not all the changes you have to do are printed out.'
echo '(y/n)'

read CHOICE

if [ ! -z $CHOICE ] && [ $CHOICE = 'y' ]; then
  ADAPT_BASHRC=1
fi

#validate if .bashrc can be found
if [ ! -z $ADAPT_BASHRC ] && [ ! -f $HOME'/.bashrc' ]; then
  echo 'Can not find .bashrc.'
  exit 1
fi

DIR_SELF=$(cd $(dirname "$0"); pwd)

#set PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE
if [ ! -z $ADAPT_BASHRC ]; then
  echo '#net_bazzline_system_maintenance start' >> $HOME'/.bashrc'
  echo '' >> $HOME'/.bashrc'

  echo PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE=$DIR_SELF >> $HOME'/.bashrc'
  echo "source \$PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE'/system.sh'" >> $HOME'/.bashrc'
else
  echo 'Add PATH_NET_BAZZLINE_SYSTEM_MAINTENANCE to your bashrc.'
  echo ''
fi

#set NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET
if [ ! -z $ADAPT_BASHRC ]; then
  echo 'What is your current distribution?'
  echo '(arch/debian)'
  read CHOICE

  if [ ! -z $CHOICE ] && [ $CHOICE = 'arch' ] || [ $CHOICE = 'debian' ]; then
    echo "NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET=$CHOICE" >> $HOME'/.bashrc'
  else
    echo 'Invalid target provided.'
    echo 'NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET not set!'
    exit 1
  fi
else
  echo 'Add NET_BAZZLINE_SYSTEM_MAINTENANCE_TARGET to your bashrc.'
  echo 'Available targets are arch or debian.'
  echo ''
fi

if [ ! -z $ADAPT_BASHRC ]; then
  #set alias
  echo 'Do you want to add an alias for net_bazzline_system_maintenance to your .bashrc?'
  echo '(y/n)'
  read CHOICE

  if [ ! -z $CHOICE ] && [ $CHOICE = 'y' ]; then
    echo 'Insert a alias (e.g. system).'
    read ALIAS

    if [ ! -z $ALIAS ]; then
      echo 'Adding "'$ALIAS'" as alias into .bashrc.'
      echo "alias $ALIAS='net_bazzline_system_maintenance';" >> $HOME'/.bashrc'
    else
      echo 'No alias provided.'
    fi
  fi
else
  echo 'Since net_bazzline_system_maintenance i recommend to add an alias for that.'
  echo ''
fi

#link autocomplete.sh
echo 'Do you want to create softlink into /etc/bash_completion.d/?'
echo '(y/n)'
read CHOICE

if [ ! -z $CHOICE ] && [ $CHOICE = 'y' ]; then
  echo 'Adding softlink.'
  sudo ln -s "$DIR_SELF/autocomplete.sh" /etc/bash_completion.d/net_bazzline_system_maintenance.sh

  if [ ! -z $ADAPT_BASHRC ]; then
    echo 'complete -F _net_bazzline_system_maintenance net_bazzline_system_maintenance' >> $HOME'/.bashrc'
  else 
    echo 'Add following line to your .bashrc'
    echo 'complete -F _net_bazzline_system_maintenance net_bazzline_system_maintenance'
  fi

  if [ ! -z $ALIAS ]; then
    if [ ! -z $ADAPT_BASHRC ]; then
      echo complete -F _net_bazzline_system_maintenance $ALIAS >> $HOME'/.bashrc'
    else
      echo 'Add following line to your .bashrc'
      echo 'complete -F _net_bazzline_system_maintenance '$ALIAS
    fi
  fi
fi

#finished with adaptation of bash
if [ ! -z $ADAPT_BASHRC ]; then
  echo '' >> $HOME'/.bashrc'
  echo '#net_bazzline_system_maintenance end' >> $HOME'/.bashrc'
fi

echo 'Installation done. Reload your shell.'

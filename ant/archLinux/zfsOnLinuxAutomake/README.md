# Better Alternative

There is a better way of dealing with zfsonlinux on arch linux out there.  
It is explained in the [official arch linux wiki](https://wiki.archlinux.org/index.php/ZFS)

# linux_arch_zfsonlinux_automake

This is a apache ant based build to easily install the aur arch linux package for zfs on linux.

## Manual
NAME
        ant - automake for zfsonlinx files of aur.archlinux.org
SYNOPSIS
        ant [OPTION]
DESCRIPTION
        Uninstalls current installed packages, download, build and install newest available packages.

        Following options are available.

        clean
            Removes existing sources and directories.

        init
            Executes clean.
            Creates directories and download sources.

        make
            Executes init and uninstall
            Make packes from available sources and installs the packages.

        uninstall
            Uninstalls installed packages.

        manual
            Prints out this manual.

        self-update
            Updates ant code.

        system-full-upgrade
            Runs all ant targets and also pacman -Syu to do all within one call.
AUTHOR  
        Written by Stev Leibelt

REPORTING BUGS
        artodeto@arcor.de

SEE ALSO
        artodeto.bazzline.net

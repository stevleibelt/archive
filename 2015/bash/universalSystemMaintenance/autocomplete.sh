_net_bazzline_system_maintenance()
{
  #define local variables
  local cur prev opts
  COMPREPLY=()
  cur="${COMP_WORDS[COMP_CWORD]}"
  prev="${COMP_WORDS[COMP_CWORD-1]}"
  opts="clean search uninstall install update upgrade manual"

  COMPREPLY=( $(compgen -W "${opts}" ${cur}) )
  return 0
}

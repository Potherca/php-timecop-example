#!/usr/bin/env bash

set -o errexit -o errtrace -o nounset -o pipefail

create_timecop_php_module() {
  local installPath timecopDirectory

  readonly installPath="${1?One parameter required: <install-path>}"
  readonly timecopDirectory="${installPath}/php-timecop"

  if [[ ! -d "${installPath}" ]];then
    mkdir -p "${installPath}"
  fi

  if [[ ! -d "${timecopDirectory}" ]];then
    git clone https://github.com/hnw/php-timecop.git "${timecopDirectory}"
  fi

  cd "${installPath}/php-timecop"

  phpize
  ./configure --prefix="${installPath}"
  make
}

if [[ "${BASH_SOURCE[0]}" != "$0" ]]; then
  export -f create_timecop_php_module
else
  create_timecop_php_module "${@}"
  exit $?
fi

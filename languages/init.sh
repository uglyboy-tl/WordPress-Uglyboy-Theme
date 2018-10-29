#!/bin/bash

find ../ -iname "*.php" > files.tmp
xgettext -L PHP -i -k__ -k_e -s -n --from-code=UTF-8 -f files.tmp -o messages.pot
rm files.tmp
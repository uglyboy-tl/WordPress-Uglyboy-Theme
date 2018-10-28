#!/bin/bash

find ../ -iname "*.php" > files.tmp
xgettext --language=PHP --indent --keyword=__ --keyword=_e --keyword=__ngettext:1,2 -s -n --from-code=UTF-8 -f files.tmp -o messages.pot
rm files.tmp
msgmerge zh_CN.po messages.pot -o zh_CN.po
msgfmt -c -v zh_CN.po -o zh_CN.mo
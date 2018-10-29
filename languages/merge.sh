#!/bin/bash

msgmerge zh_CN.po messages.pot -o zh_CN.po
msgfmt -c -v zh_CN.po -o zh_CN.mo
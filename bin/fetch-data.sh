#!/usr/bin/env bash

rm -Rf ../data
curl -L --output ../data.zip https://github.com/atom/autocomplete-html/archive/master.zip
unzip ../data.zip
rm ../data.zip
mkdir ../data
mv ../autocomplete-html-master/completions.json ../data/completions.json
mv ../autocomplete-html-master/LICENSE.md ../data/LICENSE.md
rm -Rf ../autocomplete-html-master

#!/bin/bash

# Generate ctags for vendor folder
ctags -f vendor.tags \
    -R \
    --totals=yes \
    --fields=+aimS \
    --languages=php \
    --regex-PHP='/abstract class ([^ ]*)/\1/c/' \
    --regex-PHP='/interface ([^ ]*)/\1/c/' \
    vendor/

# Generate ctags for the rest of the project.
ctags -f tags \
    -R \
    --totals=yes \
    --fields=+aimS \
    --languages=php \
    --regex-PHP='/abstract class ([^ ]*)/\1/c/' \
    --regex-PHP='/interface ([^ ]*)/\1/c/' \
    src/

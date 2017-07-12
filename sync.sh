#!/bin/bash

rm -fr /srv/http/evert/
rsync -a --progress http/* /srv/http/evert/

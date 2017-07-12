#!/bin/bash

rm -fr /srv/http/evert/
rsync -a --progress ~/github/escape/http/* /srv/http/evert/

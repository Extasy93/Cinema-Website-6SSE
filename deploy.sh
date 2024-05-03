#!/bin/bash

# Deploy via le proxy
docker build -t cinema-projet .
docker run -d --restart=always --name cinema-projet cinema-projet
exit 0

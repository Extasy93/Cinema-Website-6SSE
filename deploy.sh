#!/bin/bash

# Deploy via le proxy
docker build -t cinema-projet .
docker run -d --network=host --restart=always --name cinema-projet cinema-projet
exit 0

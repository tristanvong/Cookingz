#!/bin/bash

php artisan serve &
PHP_PID=$!

npm run dev &
NPM_PID=$!

trap "kill $PHP_PID $NPM_PID; exit" SIGINT

wait $PHP_PID
wait $NPM_PID
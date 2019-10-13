#!/bin/bash
set -xv
./phone.pl < $1
sort -k 3 --field-separator=',' < phone.txt > phone.csv
more phone.csv
head -40 phone.csv | enscript -Grb 'Phone Transactions'
more PhoneCtl.txt
enscript -G PhoneCtl.txt

#!/bin/bash
set -xv
./elec.pl < $1
#sort -k 3 --field-separator=',' < elec.txt > elec.csv
#more elec.csv
head -40 elec.csv | enscript -Grb 'Electricity Transactions'
#more ElecCtl.txt
enscript -Gr ElecCtl.txt
`mail -s "Electricity Transactions" -a elec.csv rob@crothall.co.za < "Electricity transactions are attached"`
`mail -s "Electricity Control Report" -a ElecCtl.txt rob@crothall.co.za < "Electricity Control Report is attached"`

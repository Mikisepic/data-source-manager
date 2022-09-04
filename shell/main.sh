#!/usr/bin/bash
CUSER=CUSER
CPASS=CPASS
CENDPOINT=https://grid5.mif.vu.lt/cloud3/RPC2

VM_TEMPLATE_ID=1737 # ID for Ubuntu 20.04
VM_NAME="MAG_VM"

CVMREZ=$(onetemplate instantiate $VM_TEMPLATE_ID --name $VM_NAME  --user $CUSER --password $CPASS --endpoint $CENDPOINT)
CVMID=$(echo $CVMREZ |cut -d ' ' -f 3) 
echo $CVMID
echo "Waiting for VM to RUN 30 sec."
sleep 30

$(onevm show $CVMID --user $CUSER --password $CPASS  --endpoint $CENDPOINT >$CVMID.txt)
CSSH_CON=$(cat $CVMID.txt | grep CONNECT\_INFO1| cut -d '=' -f 2 | tr -d '"'|sed 's/'$CUSER'/root/')
CSSH_PRIP=$(cat $CVMID.txt | grep PRIVATE\_IP| cut -d '=' -f 2 | tr -d '"')

echo "Connection string: $CSSH_CON"
echo "Local IP: $CSSH_PRIP"

SHOW_VMS=$(onevm list --user $CUSER --password $CPASS --endpoint $CENDPOINT)
echo "$SHOW_VMS"
exit 0

#!/bin/bash

# TO BE RUN FROM ROOT AS PART OF INSTALL

echo "#!/bin/bash
rootDir=$PWD" > $PWD/control/accesspoint/accesspoint.sh
echo "$(cat $PWD/control/accesspoint/accesspoint.sh.template)" >> $PWD/control/accesspoint/accesspoint.sh
sudo chmod 774 $PWD/control/accesspoint/accesspoint.sh

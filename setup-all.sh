#!/bin/sh
cd "$(dirname "$(readlink -f "${0}")")"

for script in *; do
	if [ -e "${script}/setup.sh" ]; then
		cd ${script}
		chmod 755 ./setup.sh
		./setup.sh
		cd ..
	fi
done

exit 0

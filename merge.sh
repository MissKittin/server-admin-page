#!/bin/sh
cd "$(dirname "$(readlink -f "${0}")")"
[ -e './merged' ] || mkdir ./merged

for dir in *; do
	if [ -d "${dir}" ] && [ ! "${dir}" = 'merged' ]; then
		find ${dir} -type d | while read source; do
			destination="./merged$(echo -n "${source}" | sed 's/'"${dir}"'//g')"
			if [ ! "${destination}" = './merged' ] && [ ! -e "${destination}" ]; then
				mkdir ${destination}
				chmod $(stat -c '%a' "./${source}") ${destination}
			fi
		done
		find ${dir} -type f | while read source; do
			destination="./merged$(echo -n "${source}" | sed 's/'"${dir}"'//g')"
			if [ -e "${destination}" ]; then
				echo " ! conflict detected: ${dir} ./${source} ${destination}"
			else
				mv ./${source} ${destination}
			fi
		done
		find ${dir} -type l | while read source; do
			destination="./merged$(echo -n "${source}" | sed 's/'"${dir}"'//g')"
			mv ./${source} ${destination}
		done
	fi
done

exit 0

#!/bin/sh

target_dir=$1

array_uniq=(`ls -l $target_dir | awk '{print $5}' | sort | uniq`)
rename=${target_dir}_dir
mkdir ./$rename

for i in "${array_uniq[@]}"
	do
		mkdir ./$rename/$i
		array=(`ls -l $target_dir | awk '$5 == '$i'' | awk '{print $9}' | sort`)
		for j in "${array[@]}"
			do
				mv ./$target_dir/$j ./$rename/$i/
			done
	done


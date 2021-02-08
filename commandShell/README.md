## Gọi command Shell bằng php:
- `shell_exec('command shell');`
- Ví dụ: `shell_exec('sudo -S adduser user1');`

## Add a User to a Group (or Second Group) on Linux
- Tạo user và group:
	- `useradd -G examplegroup exampleusername`

- Thêm người dùng mới, chỉ định vào 1 group
	- `useradd -G groupname exampleusername`

- Thêm group:
	- `groupadd mynewgroup`

- Removing a user from a group:
	- `deluser user group`

- Thêm người dùng hiện có vào group:
	- `usermod -a -G examplegroup exampleusername`

- Thay đổi nhóm chính (Primary key):
	- `usermod -g groupname username`
(Ở đây sử dụng -g, khi sử dụng -G nó sẽ là secondary group)

- Xem group khác của usermod
	- `groups exampleusername`

- Thêm user vào nhiều group
	- `usermod -a -G group1,group2,group3 exampleusername`



## File
- Đổi permission file:
	- `chmod($file, 0775);`

- Đổi owner user name file:
	- `echo chown($fn, "www-data");`


- Đổi owner user name file:
	- `chgrp($fn, "www-data");`

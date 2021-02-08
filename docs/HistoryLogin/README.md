### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới HistoryLogin
###### 1. [Lấy toàn bộ HistoryLogin theo email](#1. Lấy toàn bộ HistoryLogin theo email)
###### 2. [Thêm 1 HistoryLogin mới](#2. Thêm 1 HistoryLogin mới)
###### 3. [Xóa HistoryLogin theo id](#3. Xóa HistoryLogin theo id)
###### 4. [Xóa HistoryLogin theo email](#4. Xóa HistoryLogin theo email)

**********************************

## Danh sách các API liên quan tới HistoryLogin
## 1. Lấy toàn bộ HistoryLogin theo email
* **URL:** [{API_ROOT}/historylogin/{email}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Dữ liệu trả về:
    
  ```
	[
	    {
		"id": int,
		"email": string,
		"ip": string,
		"location": string,
		"machineName": string,
		"machineVer": string,
		"browserName": string,
		"browserVer": string,
    "dateTime": datetime
	    },
	    {
		"id": int,
		"email": string,
		"ip": string,
		"location": string,
		"machineName": string,
		"machineVer": string,
		"browserName": string,
		"browserVer": string,
    "dateTime": datetime
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"id": "1",
    "email": "ngocanittc@gmail.com",
    "ip": "116.105.23.234",
    "location": "",
    "machineName": "Windows",
    "machineVer": "10",
    "browserName": "Edge",
    "browserVer": "80.0.361.48",
    "dateTime": "2020-02-11 14:54:37"
	    },
	    {
		"id": "2",
    "email": "ngoc.anittc@gmail.com",
    "ip": "116.105.23.234",
    "location": "",
    "machineName": "Windows",
    "machineVer": "8",
    "browserName": "Edge",
    "browserVer": "80.0.361.48",
    "dateTime": "2020-02-11 14:54:37"
	    },
	    ...
	]
  ```


## <a name="2"></a>2. Thêm 1 HistoryLogin mới
* **URL:** [{API_ROOT}/historylogin](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"email": string,
		"ip": string,
		"location": string,
		"machineName": string,
		"machineVer": string,
		"browserName": string,
		"browserVer": string
	}
```

### Dữ liệu trả về:
```
	{
	       "id": int,
        "email": string,
        "ip": string,
        "location": string,
        "machineName": string,
        "machineVer": string,
        "browserName": string,
        "browserVer": string
	}
```

##### Ví dụ: 
```
	{
		"id": "1",
    "email": "ngocanittc@gmail.com",
    "ip": "116.105.23.234",
    "location": "",
    "machineName": "Windows",
    "machineVer": "10",
    "browserName": "Edge",
    "browserVer": "80.0.361.48"
	}
```

## <a name="3"></a>3. Xóa HistoryLogin theo id
* **URL:** [{API_ROOT}/historylogin/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của HistoryLogin cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/historylogin/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500

## <a name="4"></a>4. Xóa HistoryLogin theo email
* **URL:** [{API_ROOT}/deletehistoryloginbyemail](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào email của HistoryLogin cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/deletehistoryloginbyemail

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500

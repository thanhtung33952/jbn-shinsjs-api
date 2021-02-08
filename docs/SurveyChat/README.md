### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới Survey Chat
###### 1. [Lấy toàn bộ Survey Chat](#1. Lấy toàn bộ Survey Chat)
###### 2. [Thêm 1 Survey Chat mới](#2. Thêm 1 Survey Chat mới)

**********************************

## Danh sách các API liên quan tới Survey Chat
## 1. Lấy toàn bộ Survey Chat
* **URL:** [{API_ROOT}/surveychats](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Truyền param survey_id trên url
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/surveychats?survey_id={id}&limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
	        "sender": int,
	        "lastName": string,
	        "firstName": string,
	        "is_builder": int,
	        "message": string,
	        "created": datetime
	    },
	    {
	        "sender": int,
	        "lastName": string,
	        "firstName": string,
	        "is_builder": int,
	        "message": string,
	        "created": datetime
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
	        "sender": "11",
	        "lastName": "abc",
	        "firstName": "cde",
	        "is_builder": "1",
	        "message": "hello",
	        "created": "2019-12-13 02:07:50"
	    },
	    {
	        "sender": "11",
	        "lastName": "abc",
	        "firstName": "cde",
	        "is_builder": "1",
	        "message": "test",
	        "created": "2019-12-13 02:07:51"
	    },
	    ...
	]
  ```


## <a name="2"></a>2. Thêm 1 Survey Chat mới
* **URL:** [{API_ROOT}/surveychat](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	        "survey_id": int,
	        "sender": int,
			"is_builder": int,
	        "message": string
	}
```

### Dữ liệu trả về:
```
	{
	        "survey_id": int,
	        "sender": int,
			"is_builder": int,
	        "message": string,
	        "id": int
	}
```

##### Ví dụ: 
```
	{
	        "survey_id": "20",
	        "sender": "11",
	        "is_builder": "1",
	        "message":"hello",
	        "id": "503"
	}
```

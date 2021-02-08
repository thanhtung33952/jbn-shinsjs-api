### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới Comment Survey
###### 1. [Lấy toàn bộ Comment Survey](#1. Lấy toàn bộ Comment Survey)
###### 2. [Thêm 1 Comment Survey mới](#2. Thêm 1 Comment Survey mới)
###### 3. [Xóa Comment Survey](#3. Xóa Comment Survey)
###### 4. [Cập nhật  Comment Survey theo id comment](#4. Cập nhật  Comment Survey theo id comment)


**********************************

## Danh sách các API liên quan tới Comment Survey
## 1. Lấy toàn bộ Comment Survey
* **URL:** [{API_ROOT}/commentsurveys](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/commentsurveys?surveyId={id}&limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
	        "surveyId": int,
	        "userId": string,
	        "comment": string,
	        "created": datetime
	    },
	    {
	        "surveyId": int,
	        "userId": string,
	        "comment": string,
	        "created": datetime
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
	        "surveyId": "1",
	        "userId": "12",
	        "comment": "Test cmt user 1",
	        "created": "2019-08-15 12:50:22"
	    },
	    {
	        "surveyId": "1",
	        "userId": "11",
	        "comment": "Test cmt user 1",
	        "created": "2019-08-15 12:50:22"
	    },
	    ...
	]
  ```


## <a name="2"></a>2. Thêm 1 Comment Survey mới
* **URL:** [{API_ROOT}/commentsurvey](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	        "surveyId": int,
	        "userId": string,
	        "comment": string
	}
```

### Dữ liệu trả về:
```
	{
	        "surveyId": int,
	        "userId": string,
	        "comment": string,
	        "id": int
	}
```

##### Ví dụ: 
```
	{
	        "surveyId": "1",
	        "userId": "12",
	        "comment": "Hello",
	        "id": "503"
	}
```


## <a name="3"></a>3. Xóa Comment Survey
* **URL:** [{API_ROOT}/commentsurvey/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của Comment Survey cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/commentsurvey/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500



## <a name="4"></a>4. Cập nhật  Comment Survey theo id comment
* **URL:** [{API_ROOT}/commentsurvey/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
id là id của comment
```
	{
		"userId": string,
		"comment": string
	}
```

### Dữ liệu trả về:
```
	{
		"userId": string,
		"comment": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"userId": "12",
		"comment": "Hello",
		"id": "1"
	}
```

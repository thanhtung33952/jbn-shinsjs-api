### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới creditApprovalLog
###### 1. [Lấy toàn bộ creditApprovalLog](#1. Lấy toàn bộ creditApprovalLog)
###### 2. [Lấy thông tin creditApprovalLog từ id](#2. Lấy thông tin creditApprovalLog từ id)
###### 3. [Thêm 1 creditApprovalLog mới](#3. Thêm 1 creditApprovalLog mới)

**********************************

## Danh sách các API liên quan tới creditApprovalLog
## 1. Lấy toàn bộ creditApprovalLog
* **URL:** [{API_ROOT}/creditapprovallogs](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/creditapprovallogs?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
	        "company_id": int,
	        "date": datetime,
	        "description": string,
	        "name": string
	    },
	    {
	        "company_id": int,
	        "date": datetime,
	        "description": string,
	        "name": string
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
	        "company_id": "123",
	        "date": "2018-12-14 18:13:25",
	        "description": "test",
	        "name": "name1"
	    },
	    {
	        "company_id": "12345",
	        "date": "2018-12-14 19:00:08",
	        "description": "test",
	        "name": "name123"
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin creditApprovalLog từ company id
* **URL:** [{API_ROOT}/creditapprovallog/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của company id cần truyền vào

### Dữ liệu trả về:
```
	[
	    {
	        "company_id": int,
	        "date": datetime,
	        "description": string,
	        "name": string
	    },
	    {
	        "company_id": int,
	        "date": datetime,
	        "description": string,
	        "name": string
	    },
	    ...
	]
```

##### Ví dụ: {API_ROOT}/creditapprovallog/2
Dữ liệu trả về:
```
	[
	    {
	        "company_id": "123",
	        "date": "2018-12-14 18:13:25",
	        "description": "test",
	        "name": "name1"
	    },
	    {
	        "company_id": "123",
	        "date": "2018-12-14 19:00:08",
	        "description": "test",
	        "name": "name123"
	    },
	    ...
	]
```

## <a name="3"></a>3. Thêm 1 creditApprovalLog mới
* **URL:** [{API_ROOT}/creditapprovallog](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	        "company_id": int,
	        "description": string,
	        "name": string
	}
```

### Dữ liệu trả về:
```
	{
	        "company_id": int,
	        "date": datetime,
	        "description": string,
	        "name": string
	}
```

##### Ví dụ: 
```
	{
	        "company_id": "123",
	        "date": "2018-12-14 19:00:08",
	        "description": "test",
	        "name": "name123"
	}
```

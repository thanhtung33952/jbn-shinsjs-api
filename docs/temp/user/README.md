### API public

**API_ROOT:** http://153.125.228.20/api/temp/

## Danh sách các API liên quan tới user
###### 1. [Lấy toàn bộ user](#1. Lấy toàn bộ user)
###### 2. [Lấy thông tin user từ user id](#2. Lấy thông tin user từ user id)
###### 3. [Thêm 1 user mới](#3. Thêm 1 user mới)
###### 4. [Cập nhật user theo user id](#4. Cập nhật user theo user id)
###### 5. [Xóa user theo user id](#5. Xóa user theo user id)
###### 6. [Kiểm tra passowrd](#6. Kiểm tra passowrd)
###### 7. [Kiểm tra tồn tại user temp](#7. Kiểm tra tồn tại user temp)

**********************************

## Danh sách các API liên quan tới user
## 1. Lấy toàn bộ user
* **URL:** [{API_ROOT}/users](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/users?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
		"id": int,
		"email": string,
		"lastName": string,
		"firstName": string,
		"password": string,
		"status": int
	},
	    {
		"id": int,
		"email": string,
		"lastName": string,
		"firstName": string,
		"password": string,
		"status": int
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
	        "id": "1",
	        "email": "test@gmail.com",
	        "lastName": "test",
	        "firstName": "a",
	        "password": "",
	        "status": "0"
	    },
	    {
	        "id": "3",
	        "email": "test1@gmail.com",
	        "lastName": "test",
	        "firstName": "a",
	        "password": "123",
	        "status": "0"
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin user từ user id
* **URL:** [{API_ROOT}/user/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của user id cần truyền vào

### Dữ liệu trả về:
```
	{
	    "id": int,
	    "email": string,
	    "lastName": string,
	    "firstName": string,
	    "password": string,
	    "status": int
	}
```

##### Ví dụ: {API_ROOT}/user/2
Dữ liệu trả về:
```
	{
	    "id": "3",
	    "email": "test1@gmail.com",
	    "lastName": "test",
	    "firstName": "a",
	    "password": "123",
	    "status": "0"
	}
```

## <a name="3"></a>3. Thêm 1 user mới
* **URL:** [{API_ROOT}/user](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	    "email": string,
	    "lastName": string,
	    "firstName": string,
	    "companyName": string
	}
```

### Dữ liệu trả về:
```
	{
	    "id": int,
	    "email": string,
	    "lastName": string,
	    "firstName": string,
	    "companyName": string
	}
```

##### Ví dụ: 
```
	{
	    "id": "3",
	    "email": "test1@gmail.com",
	    "lastName": "test",
	    "firstName": "a",
	    "companyName": "Jibannet"
	}
```

## <a name="4"></a>4. Cập nhật user theo user id
* **URL:** [{API_ROOT}/user/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	    "email": string,
	    "lastName": string,
	    "firstName": string,
	    "password": string,
	    "status": int
	}
```

### Dữ liệu trả về:
```
	{
	    "id": int,
	    "email": string,
	    "lastName": string,
	    "firstName": string,
	    "password": string,
	    "status": int
	}
```

##### Ví dụ: 
```
	{
	    "id": "3",
	    "email": "test1@gmail.com",
	    "lastName": "test",
	    "firstName": "a",
	    "password": "123",
	    "status": "0"
	}
```

## <a name="5"></a>5. Xóa user theo user id
* **URL:** [{API_ROOT}/user/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của user cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/user/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500


## <a name="6"></a>6. Kiểm tra passowrd
* **URL:** [{API_ROOT}/user/checkpassword](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
```
	{
	    "password": string
	}
```

### Dữ liệu trả về:
- Trường hợp tồn tại: trả về thông tin user, ví dụ:
```
	{
	    "id": "985ec4c8b0e56d747b1eb3934b36b348",
	    "email": "lenguyendangkhoa.94@gmail.com",
	    "lastName": "test",
	    "firstName": "a",
	    "password": "E1jtdQ",
	    "status": "0"
	}
```
- Trường hợp không tồn tại: trả về **null**


## <a name="7"></a>7. Kiểm tra tồn tại user temp
* **URL:** [{API_ROOT}/user/checkexistuser](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
```
	{
	    "id": string
	}
```
id: là id của user temp
### Dữ liệu trả về:
- Trường hợp tồn tại: trả về code = 200
- Trường hợp không tồn tại: trả về code !=200

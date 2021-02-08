### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới acount
###### 1. [Đăng kí tài khoản](#1. Đăng kí tài khoản)
###### 2. [Đăng nhập tài khoản](#2. Đăng nhập tài khoản)
###### 3. [Quên mật khẩu](#3. Quên mật khẩu)
###### 4. [Kiểm tra mật khẩu tạm](#4. Kiểm tra mật khẩu tạm)
###### 5. [Cập nhật thông tin user](#5. Cập nhật thông tin user)
###### 6. [Lấy thông tin user từ user id](#6. Lấy thông tin user từ user id)
###### 7. [Lấy danh sách users](#7. Lấy danh sách users)
###### 8. [Cập nhật mật khẩu](#8. Cập nhật mật khẩu)
###### 9. [Xóa user theo user id](#9. Xóa user theo user id)
***********************

## 1. Đăng kí tài khoản
* **URL:** [{API_ROOT}/account/register](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
    {
    	"lastName": string,
	"firstName": string,
        "email": string,
        "password": string,
        "companyID": int
    }
```

### Dữ liệu trả về:
```
    {
	"lastName": string,
	"firstName": string,
        "email": string,
        "password": string,
        "companyID": int,
        "id": string
    }
```

###### Ví dụ:
```
    {
        "lastName": "Khoa",
	"firstName": "Le",
	"email": "test@gmail.com",
        "password": "P@ss123",
        "companyID": "1",
        "id": "hnh3sqgbSD"
    }
```


## 2. Đăng nhập tài khoản
* **URL:** [{API_ROOT}/account/login](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
    {
        "email": string,
        "password": string
    }
```

### Dữ liệu trả về:
```
    {
        "id": int,
        "email": string,
        "lastName": string,
        "firstName": string,
        "companyID": int
    }
```
Trường hợp sai email hoặc mật khẩu sẽ trả về false

###### Ví dụ:
```
    {
        "email": "test@gmail.com",
        "password": "P@ss123",
        "lastName": "khoa",
        "firstName": "dang",
        "companyID": "57"
    }
```

## 3. Quên mật khẩu
* **URL:** [{API_ROOT}/account/forgetpassword](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

Gửi thư khôi phục mật khẩu về địa chỉ mail yêu cầu, trường hợp trả về lỗi 500 lý do sai địa chỉ email 
### Tham số:
```
    {
        "email": string
    }
```

### Dữ liệu trả về:
```
    {
        "email": string
    }
```

###### Ví dụ:
```
    {
        "email": "test@gmail.com"
    }
```

## <a name="4"></a>4. Kiểm tra mật khẩu tạm
* **URL:** [{API_ROOT}/account/checkpasswordtemp](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
```
	{
		"userID": string,
		"password": string
	}
```

##### Ví dụ: 
		URL: [{API_ROOT}/account/checkpasswordtemp

### Dữ liệu trả về:
```
	{
		"userID": "1234567890",
		"password": "123456789",
		"result": false
	}

```


## <a name="5"></a>5. Cập nhật thông tin user
* **URL:** [{API_ROOT}/account/infouser](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
    {
        "userID": string,
        "lastName": string,
        "firstName": string,
        "email": string,
        "password": string,
        "companyID": string
    }
```
- Trường hợp chỉ muốn cập nhật mật khẩu
```
	{
	    "userID": string,
	    "password": "string"
	}
```

### Dữ liệu trả về:
```
    {
        "userID": string,
        "lastName": string,
        "firstName": string,
        "email": string,
        "password": string,
        "companyID": string
    }
```

###### Ví dụ:
```
    {
        "userID": "1234567890"
        "lastName": "Khoa",
        "firstName": "Dang",
        "email": "lenguyendangkhoa.94@gmail.com",
        "password": "password",
        "companyID": null
    }
```


## <a name="6"></a>6. Lấy thông tin user từ user id
* **URL:** [{API_ROOT}/account/infouser/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của user id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": string,
		"lastName": string,
		"firstName": string,
		"email": string,
		"password": string,
		"companyID": string
	}
```

##### Ví dụ: {API_ROOT}/infouser/1
Dữ liệu trả về:
```
	{
		"id": "12",
		"lastName": "Khoa",
		"firstName": "Dang",
		"email": "lenguyendangkhoa.94@gmail.com",
		"password": "password",
		"companyID": null
	}
```

## 7. Lấy danh sách users
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
		"userId": string,
		"lastName": string,
		"firstName": string,
		"companyID": int,
		"companyDisplayName": string,
		"group_id": string,
		"email": string
	    },
	    {
		"userId": string,
		"lastName": string,
		"firstName": string,
		"companyID": int,
		"companyDisplayName": string,
		"group_id": string,
		"email": string
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"userId": "11",
		"lastName": "abc",
		"firstName": "cde",
		"companyID": "38",
		"companyDisplayName": "Jibannet",
		"group_id": null,
		"email": "admin@gmail.com"
	    },
	    {
		"userId": "123456789",
		"lastName": "Khoa",
		"firstName": "Le",
		"companyID": "38",
		"companyDisplayName": "Jibannet",
		"group_id": null,
		"email": "admin@gmail.com"
	    },
	    ...
	]
  ```

## <a name="8"></a>8. Cập nhật mật khẩu
* **URL:** [{API_ROOT}/account/updatepassword](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
    {
        "email": string,
        "oldPassword": string,
        "newPassword": string
    }
```
Trường hợp không có oldPassword thì truyền cố định "" cho oldPassword ["oldPassword": ""]

### Dữ liệu trả về:

Trả về code =200 nếu update thành công
Trả về code =500 nếu update thất bại
###### Ví dụ:
```
    {
        "email": "lenguyendangkhoa.94@gmail.com",
        "oldPassword": "password",
        "newPassword": "password1"
    }
```

## <a name="9"></a>9. Xóa user theo user id
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


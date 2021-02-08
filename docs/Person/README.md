### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới Profile
###### 1. [Lấy thông tin Profile từ id](#1. Lấy thông tin Profile từ id)
###### 2. [Thêm 1 Profile mới](#2. Thêm 1 Profile mới)
###### 3. [Cập nhật Profile theo id](#3. Cập nhật Profile theo id)


**********************************

## Danh sách các API liên quan tới Profile


## <a name="1"></a>1. Lấy thông tin Profile từ id
* **URL:** [{API_ROOT}/profile/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của user id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"user_id": int,
		"firstName": string,
		"first_name1": string,
		"lastName": string,
		"last_name1": string,
		"email": string,
		"mobile_phone": string,
		"company_name": string,
		"hire_date": datetime,
		"department": string,
		"position": string,
		"job_title": string,
		"employee_number": string,
		"sjs_id": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string
	}
```

##### Ví dụ: {API_ROOT}/profile/12
Dữ liệu trả về:
```
	{
		"id": "1",
		"user_id": "12",
		"firstName": "test",
		"first_name1": "test",
		"lastName": "test",
		"last_name1": "test",
		"email": "test",
		"mobile_phone": "test",
		"hire_date": "2019-09-09 00:00:00",
		"department": "ABC",
		"position": "TEST",
		"job_title": "TEST",
		"employee_number": "TEST",
		"sjs_id": "123",
		"postalCode": "test",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test"
	}
```



## <a name="2"></a>2. Thêm 1 Profile mới
* **URL:** [{API_ROOT}/profile](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"user_id": int,
		"firstName": string,
		"first_name1": string,
		"lastName": string,
		"last_name1": string,
		"email": string,
		"mobile_phone": string,
		"company_name": string,
		"hire_date": datetime,
		"department": string,
		"position": string,
		"job_title": string,
		"employee_number": string,
		"sjs_id": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string
	}
```

### Dữ liệu trả về:
```
	{
	        "user_id": int,
		"firstName": string,
		"first_name1": string,
		"lastName": string,
		"last_name1": string,
		"email": string,
		"mobile_phone": string,
		"company_name": string,
		"hire_date": datetime,
		"department": string,
		"position": string,
		"job_title": string,
		"employee_number": string,
		"sjs_id": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string
	        "id": int
	}
```

##### Ví dụ: 
```
	{
		"user_id": "12",
		"firstName": "test",
		"first_name1": "test",
		"lastName": "test",
		"last_name1": "test",
		"email": "test",
		"mobile_phone": "test",
		"hire_date": "2019-09-09 00:00:00",
		"department": "ABC",
		"position": "TEST",
		"job_title": "TEST",
		"employee_number": "TEST",
		"sjs_id": "123",
		"postalCode": "test",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
	        "id": "5"
	}
```

## <a name="3"></a>3. Cập nhật Profile theo user id
* **URL:** [{API_ROOT}/profile/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"firstName": string,
		"first_name1": string,
		"lastName": string,
		"last_name1": string,
		"email": string,
		"mobile_phone": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"firstName": string,
		"first_name1": string,
		"lastName": string,
		"last_name1": string,
		"email": string,
		"mobile_phone": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string
	}
```

##### Ví dụ: 
```
	{
		"firstName": "test",
		"first_name1": "test",
		"lastName": "test",
		"last_name1": "test",
		"email": "test",
		"mobile_phone": "test",
		"postalCode": "test",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test"
	}
```

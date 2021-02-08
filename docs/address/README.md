### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới address
###### 1. [Lấy toàn bộ Address](#1. Lấy toàn bộ Address)
###### 2. [Lấy thông tin address từ address id](#2. Lấy thông tin address từ address id)
###### 3. [Thêm 1 address mới](#3. Thêm 1 address mới)
###### 4. [Cập nhật address theo address id](#4. Cập nhật address theo address id)
###### 5. [Xóa address theo address id](#5. Xóa address theo address id)
###### 6. [API search *province*](#6. API search province)
###### 7. [API search *city*](#7. API search city)
###### 8. [API search *street*](#8. API search street)
###### 9. [API search *building*](#9. API search building)

**********************************

## Danh sách các API liên quan tới address
## 1. Lấy toàn bộ Address
* **URL:** [{API_ROOT}/addresses](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/addresses?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
	        "postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double,
	        "id": int
	    },
	    {
		"postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double,
	        "id": int
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
	        "postalCode": "test123",
	        "province": "test",
	        "city": "test",
	        "streetAddress": "test",
	        "buildingName": "test",
	        "latitude": "123.123",
	        "longitute": "123.456",
	        "id": "2"
	    },
	    {
		"postalCode": "test123",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
		"latitude": "123.123",
		"longitute": "123.456",
		"id": "2"
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin address từ address id
* **URL:** [{API_ROOT}/address/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của address id cần truyền vào

### Dữ liệu trả về:
```
	{
		"postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double,
	        "id": int
	}
```

##### Ví dụ: {API_ROOT}/address/2
Dữ liệu trả về:
```
	{
		"postalCode": "test123",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
		"latitude": "123.123",
		"longitute": "123.456",
		"id": "2"
	}
```

## <a name="3"></a>3. Thêm 1 address mới
* **URL:** [{API_ROOT}/address](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double
	}
```

### Dữ liệu trả về:
```
	{
		"postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double,
	        "id": int
	}
```

##### Ví dụ: 
```
	{
		"postalCode": "test123",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
		"latitude": "123.123",
		"longitute": "123.456",
		"id": "2"
	}
```

## <a name="4"></a>4. Cập nhật address theo address id
* **URL:** [{API_ROOT}/address/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double,
	        "id": int
	}
```

### Dữ liệu trả về:
```
	{
		"postalCode": string,
	        "province": string,
	        "city": string,
	        "streetAddress": string,
	        "buildingName": string,
	        "latitude": double,
	        "longitute": double,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"postalCode": "test123",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
		"latitude": "123.123",
		"longitute": "123.456",
		"id": "2"
	}
```

## <a name="5"></a>5. Xóa address theo address id
* **URL:** [{API_ROOT}/address/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của address cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/address/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500


## <a name="6"></a>6. API search province
* **URL:** [{API_ROOT}/address/search/province/{key}](#)
* **Method:** GET
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào key trên url, nếu tìm tất cả ko cần truyền giá trị key

Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

- **limit**: số lượng record trả về
- **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/companyaddress/search/province/{key}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "id": int,
	        "name": string
	    },
	    {
	        "id": int,
	        "name": string
	    },
	    ...
	]
```

##### Ví dụ: 	
	
```
	[
	    {
	        "id": "38",
	        "name": "abc"
	    },
	    {
	        "id": "39",
	        "name": "abcd"
	    },
	    ...
	]
```

## <a name="7"></a>7. API search city
* **URL:** [{API_ROOT}/address/search/city/{key}](#)
* **Method:** GET
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào key trên url, nếu tìm tất cả ko cần truyền giá trị key

Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

- **limit**: số lượng record trả về
- **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/companyaddress/search/city/{key}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "id": int,
	        "name": string
	    },
	    {
	        "id": int,
	        "name": string
	    },
	    ...
	]
```

##### Ví dụ: 	
	
```
	[
	    {
	        "id": "38",
	        "name": "abc"
	    },
	    {
	        "id": "39",
	        "name": "abcd"
	    },
	    ...
	]
```

## <a name="8"></a>8. API search street
* **URL:** [{API_ROOT}/address/search/street/{key}](#)
* **Method:** GET
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào key trên url, nếu tìm tất cả ko cần truyền giá trị key

Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

- **limit**: số lượng record trả về
- **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/companyaddress/search/street/{key}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "id": int,
	        "name": string
	    },
	    {
	        "id": int,
	        "name": string
	    },
	    ...
	]
```

##### Ví dụ: 	
	
```
	[
	    {
	        "id": "38",
	        "name": "abc"
	    },
	    {
	        "id": "39",
	        "name": "abcd"
	    },
	    ...
	]
```

## <a name="9"></a>9. API search building
* **URL:** [{API_ROOT}/address/search/building/{key}](#)
* **Method:** GET
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào key trên url, nếu tìm tất cả ko cần truyền giá trị key

Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

- **limit**: số lượng record trả về
- **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/companyaddress/search/building/{key}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "id": int,
	        "name": string
	    },
	    {
	        "id": int,
	        "name": string
	    },
	    ...
	]
```

##### Ví dụ: 	
	
```
	[
	    {
	        "id": "38",
	        "name": "abc"
	    },
	    {
	        "id": "39",
	        "name": "abcd"
	    },
	    ...
	]
```

### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới BlankAccount
###### 1. [Lấy toàn bộ BlankAccount](#1. Lấy toàn bộ BlankAccount)
###### 2. [Lấy thông tin BlankAccount từ id](#2. Lấy thông tin BlankAccount từ id)
###### 3. [Thêm 1 BlankAccount mới](#3. Thêm 1 BlankAccount mới)
###### 4. [Cập nhật BlankAccount theo id](#4. Cập nhật BlankAccount theo id)
###### 5. [Xóa BlankAccount theo id](#5. Xóa BlankAccount theo id)

**********************************

## Danh sách các API liên quan tới BlankAccount
## 1. Lấy toàn bộ BlankAccount
* **URL:** [{API_ROOT}/blankaccounts](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/blankaccounts?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
		"id": int,
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	    },
	    {
		"id": int,
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"id": "1",
		"bankName": "test1",
		"bankCode": "test1",
		"branchName": "test1",
		"branchCode": "test1",
		"accountClassification": "test1",
		"accountNumber": "test1",
		"accountHolder": "test1"
	    },
	    {
		"id": "2",
		"bankName": "test2",
		"bankCode": "test2",
		"branchName": "test2",
		"branchCode": "test2",
		"accountClassification": "test2",
		"accountNumber": "test2",
		"accountHolder": "test2"
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin BlankAccount từ id
* **URL:** [{API_ROOT}/blankaccount/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của blankaccount id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	}
```

##### Ví dụ: {API_ROOT}/blankaccount/2
Dữ liệu trả về:
```
	{
		"id": "2",
		"bankName": "test2",
		"bankCode": "test2",
		"branchName": "test2",
		"branchCode": "test2",
		"accountClassification": "test2",
		"accountNumber": "test2",
		"accountHolder": "test2"
	}
```

## <a name="3"></a>3. Thêm 1 BlankAccount mới
* **URL:** [{API_ROOT}/blankaccount](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	}
```

### Dữ liệu trả về:
```
	{
	        "id": int,
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	}
```

##### Ví dụ: 
```
	{
		"id": "2",
		"bankName": "test2",
		"bankCode": "test2",
		"branchName": "test2",
		"branchCode": "test2",
		"accountClassification": "test2",
		"accountNumber": "test2",
		"accountHolder": "test2"
	}
```

## <a name="4"></a>4. Cập nhật BlankAccount theo id
* **URL:** [{API_ROOT}/blankaccount/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	}
```

### Dữ liệu trả về:
```
	{
		"id": int,
		"bankName": string,
		"bankCode": string,
		"branchName": string,
		"branchCode": string,
		"accountClassification": string,
		"accountNumber": string,
		"accountHolder": string
	}
```

##### Ví dụ: 
```
	{
		"id": "2",
		"bankName": "test2",
		"bankCode": "test2",
		"branchName": "test2",
		"branchCode": "test2",
		"accountClassification": "test2",
		"accountNumber": "test2",
		"accountHolder": "test2"
	}
```

## <a name="5"></a>5. Xóa BlankAccount theo id
* **URL:** [{API_ROOT}/blankaccount/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của BlankAccount cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/blankaccount/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500

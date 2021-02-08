### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới CostBalance
###### 1. [Lấy thông tin CostBalance từ id](#1. Lấy thông tin CostBalance từ id)
###### 2. [Lấy thông tin costbalancefilter từ User id](#2. Lấy thông tin costbalancefilter từ User id)
###### 3. [Lấy thông tin costbalancefilter từ id](#3. Lấy thông tin costbalancefilter từ id)
###### 4. [Thêm 1 costbalancefilter mới](#4. Thêm 1 costbalancefilter mới)
###### 5. [Cập nhật costbalancefilter mới](#5. Cập nhật costbalancefilter mới)
###### 6. [Xóa costbalancefilter theo id](#6. Xóa costbalancefilter theo id)
###### 7. [Kiểm tra SQL màn hình Costbalance](#7. Kiểm tra SQL màn hình Costbalance)


**********************************

## Danh sách các API liên quan tới CostBalance


## <a name="1"></a>1. Lấy thông tin CostBalance từ id
* **URL:** [{API_ROOT}/costbalance/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
	* {id} là mã của CostBalance cần truyền vào

##### Ví dụ: 
		URL: [{API_ROOT}/costbalance

### Dữ liệu trả về:
```
	[
		{
			"sales_number": int,
			"sales_date": datetime,
			"categories"": string,
			"product_name"": string,
			"property_no": string,
			"quality_certification_company": string,
			"property_name": string,
			"property_address": string,

			"billing_code": string,
			"billing_name": string,
			"sales_approval_date": datetime,
			"sales_staff": string,
			"branch_name": string,
			"excluding_tax": string,
			"tax_included": string,
			"billing_method": string,
			"closing_date": datetime,
			"billing_date": datetime,
			"scheduled_collection_date": datetime,
			"deposit_number": int,
			"payment_day": datetime,
			"deposit_type_1": int,
			"deposit_1": int,
			"deposit_type_2": int,
			"deposit_2": int,
			"commission": int,
			"cooperation_fee": int,
			"deposit_total": int,
			"advance_payment": int,
			"uncollected_balance": int,
			"deposit": int,

			"purchase_number": int,
			"purchase_date": datetime,
			"survey_construction_date": datetime,
			"description": string,
			"payee_code": string,
			"payee_name": string,
			"purchase_approval_date timestamp
			"excluding_tax_1": string,
			"tax_included_1": string,
			"payment_closing_date": datetime,
			"payment_due_date": datetime,
			"payment_number": int,
			"payment_date": datetime,
			"payment_type_1": string,
			"payment_amount_1": int,
			"payment_type_2": string,
			"payment_amount_2": int,
			"total_payment_amount": int,
			"unpaid_balance": int
		},
		...
	]
```

##### Ví dụ: {API_ROOT}/costbalance
Dữ liệu trả về:
```
	[
		{
			...
		},
		...
	]
```

## <a name="2"></a>2. Lấy thông tin costbalancefilter từ User id
* **URL:** [{API_ROOT}/costbalancefilters/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của user id cần truyền vào

### Dữ liệu trả về:
```
	[
	    {
	        "id": string,
	        "content": string,
	        "created": datetime
	    },
	    {
	        "id": string,
	        "content": string,
	        "created": datetime
	    },
	    ...
	]
```

##### Ví dụ: {API_ROOT}/costbalancefilters/2
Dữ liệu trả về:
```
	[
	    {
	        "id": "abcd1234",
	        "userId": "123456789",
	        "content": "xxx"
	    },
	    {
	        "id": "abcd1235",
	        "userId": "123456789",
	        "content": "SELECT * FROM tb_cost_balance_main"
	    },
	    ...
	]
```

## <a name="3"></a>3. Lấy thông tin costbalancefilter từ id
* **URL:** [{API_ROOT}/costbalancefilter/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của id cần truyền vào

### Dữ liệu trả về:
```
	    {
	        "id": string,
	        "content": string,
	        "created": datetime
	    }
```

##### Ví dụ: {API_ROOT}/costbalancefilter/64cc0e4f
Dữ liệu trả về:
```
	[
	    {
	        "id": "abcd1234",
	        "userId": "123456789",
	        "content": "xxx"
	    },
	    {
	        "id": "abcd1235",
	        "userId": "123456789",
	        "content": "SELECT * FROM tb_cost_balance_main"
	    },
	    ...
	]
```

## <a name="4"></a>4. Thêm 1 costbalancefilter mới
* **URL:** [{API_ROOT}/costbalancefilter](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	        "userId": string,
	        "content": string
	}
```

### Dữ liệu trả về:
```
	{
	        "id": string,
	        "userId": string,
	        "content": string
	}
```

##### Ví dụ: 
```
	{
	        "id": "abcd1234",
	        "userId": "123456789",
	        "content": "xxx"
	}
```


## <a name="5"></a>5. Cập nhật costbalancefilter
* **URL:** [{API_ROOT}/costbalancefilter/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của user id cần truyền vào
```
	{
	        "content": string
	}
```

### Dữ liệu trả về:
```
	{
	        "id": int,
	        "content": string
	}
```

##### Ví dụ: 
```
	{
	        "id": "abcd1234",
	        "content": "xxx"
	}
```


## <a name="6"></a>6. Xóa costbalancefilter theo id
* **URL:** [{API_ROOT}/costbalancefilter/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của costbalancefilter cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/costbalancefilter/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500


## <a name="7"></a>7. Kiểm tra SQL màn hình Costbalance
* **URL:** [{API_ROOT}/executesqlcostbalance](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	        "content": string
	}
```

### Dữ liệu trả về:
- Câu query thực thi thành công: **Status code**= 200
- Câu query thực thi không thành công: **Status code** = 500

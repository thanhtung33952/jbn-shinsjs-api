### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới CompanySetting
###### 1. [Lấy toàn bộ CompanySetting](#1. Lấy toàn bộ CompanySetting)
###### 2. [Lấy thông tin CompanySetting từ id](#2. Lấy thông tin CompanySetting từ id)
###### 3. [Thêm 1 CompanySetting mới](#3. Thêm 1 CompanySetting mới)
###### 4. [Cập nhật CompanySetting theo id](#4. Cập nhật CompanySetting theo id)
###### 5. [Xóa CompanySetting theo id](#5. Xóa CompanySetting theo id)
###### 6. [Lấy danh sách CompanySurveys từ company id](#6. Lấy danh sách CompanySurveys từ company id)
**********************************

## Danh sách các API liên quan tới CompanySetting
## 1. Lấy toàn bộ CompanySetting
* **URL:** [{API_ROOT}/companysettings](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/companysettings?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
		"companyId": int,
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double,
			"addressId": int
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
			"bankName": string,
			"bankCode": string,
			"branchName": string,
			"branchCode": string,
			"accountClassification": string,
			"accountNumber": string,
			"accountHolder": string,
			"id": "int"
		},
		"creditApprovalLog": [
			{
		            "id": int,
		            "date": datetime,
		            "description": string,
		            "name": "string
			},
			{
			    "id": int,
			    "date": datetime,
			    "description": string,
			    "name": "string
			},
			...
		]
	    },
	    {
		"companyId": int,
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double,
			"addressId": int
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
			"bankName": string,
			"bankCode": string,
			"branchName": string,
			"branchCode": string,
			"accountClassification": string,
			"accountNumber": string,
			"accountHolder": string,
			"id": "int"
		},
		"creditApprovalLog": [
			{
		            "id": int,
		            "date": datetime,
		            "description": string,
		            "name": "string
			},
			{
		            "id": int,
		            "date": datetime,
		            "description": string,
		            "name": "string
			},
			...
		]
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"companyId": "123",
		"creditLimit": "test",
		"creditStatus": "test",
		"authConfirmScreen": "test",
		"authReceiptDoc": "test",
		"invoiceMailingAddress": {
			"postalCode": "test12345",
			"province": "test",
			"city": "test",
			"streetAddress": "test",
			"buildingName": "test",
			"latitude": "123.123",
			"addressId": "47"
		},
		"personNameInCharge": "test",
		"payer": "test",
		"billingMethod": "test",
		"outputUnit": "test",
		"closingClassificationDate": "2018-11-14 19:15:48",
		"estimatedRecoveryDate": "2018-11-14 19:15:48",
		"businessClassificationDate": "2018-11-14 19:15:48",
		"bankAccount": {
			"bankName": "Name1",
			"bankCode": "test",
			"branchName": "test",
			"branchCode": "test",
			"accountClassification": "test",
			"accountNumber": "test",
			"accountHolder": "test",
			"id": "4"
		},
		"creditApprovalLog": [
			{
		            "id": "4",
		            "date": "2018-12-14 19:00:26",
		            "description": "test",
		            "name": "name123"
			},
			{
		            "id": "3",
		            "date": "2018-12-14 19:00:12",
		            "description": "test",
		            "name": "name123"
			},
			{
		            "id": "2",
		            "date": "2018-12-14 19:00:08",
		            "description": "test",
		            "name": "name123"
			}
		]
	    },
	    {
		"companyId": "12345",
		"creditLimit": "test123",
		"creditStatus": "test123",
		"authConfirmScreen": "test123",
		"authReceiptDoc": "test",
		"invoiceMailingAddress": {
			"postalCode": "test12345",
			"province": "test",
			"city": "test",
			"streetAddress": "test",
			"buildingName": "test",
			"latitude": "123.123",
			"addressId": "47"
		},
		"personNameInCharge": "test",
		"payer": "test",
		"billingMethod": "test",
		"outputUnit": "test",
		"closingClassificationDate": "2018-11-14 19:15:48",
		"estimatedRecoveryDate": "2018-11-14 19:15:48",
		"businessClassificationDate": "2018-11-14 19:15:48",
		"bankAccount": {
			"bankName": "Name1",
			"bankCode": "test",
			"branchName": "test",
			"branchCode": "test",
			"accountClassification": "test",
			"accountNumber": "test",
			"accountHolder": "test",
			"id": "4"
		},
		"creditApprovalLog": [
			{
		            "id": "4",
		            "date": "2018-12-14 19:00:26",
		            "description": "test",
		            "name": "name123"
			},
			{
		            "id": "3",
		            "date": "2018-12-14 19:00:12",
		            "description": "test",
		            "name": "name123"
			},
			{
		            "id": "2",
		            "date": "2018-12-14 19:00:08",
		            "description": "test",
		            "name": "name123"
			}
		]
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin CompanySetting từ id
* **URL:** [{API_ROOT}/companysetting/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của Companyid cần truyền vào

### Dữ liệu trả về:
```
	{
		"companyId": int,
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double,
			"addressId": int
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
		        "bankName": string,
		        "bankCode": string,
		        "branchName": string,
		        "branchCode": string,
		        "accountClassification": string,
		        "accountNumber": string,
		        "accountHolder": string,
		        "id": "int"
		},
		"creditApprovalLog": [
		        {
		            "id": int,
		            "date": datetime,
		            "description": string,
		            "name": "string
		        },
		        {
		            "id": int,
		            "date": datetime,
		            "description": string,
		            "name": "string
		        },
		        ...
		]
	}	
```

##### Ví dụ: {API_ROOT}/CompanySetting/2
Dữ liệu trả về:
```
	{
		"companyId": "12345",
		"creditLimit": "test123",
		"creditStatus": "test123",
		"authConfirmScreen": "test123",
		"authReceiptDoc": "test",
		"invoiceMailingAddress": {
			"postalCode": "test12345",
			"province": "test",
			"city": "test",
			"streetAddress": "test",
			"buildingName": "test",
			"latitude": "123.123",
			"addressId": "47"
		},
		"personNameInCharge": "test",
		"payer": "test",
		"billingMethod": "test",
		"outputUnit": "test",
		"closingClassificationDate": "2018-11-14 19:15:48",
		"estimatedRecoveryDate": "2018-11-14 19:15:48",
		"businessClassificationDate": "2018-11-14 19:15:48",
		"bankAccount": {
		        "bankName": "Name1",
		        "bankCode": "test",
		        "branchName": "test",
		        "branchCode": "test",
		        "accountClassification": "test",
		        "accountNumber": "test",
		        "accountHolder": "test",
		        "id": "4"
		},
		"creditApprovalLog": [
		        {
		            "id": "4",
		            "date": "2018-12-14 19:00:26",
		            "description": "test",
		            "name": "name123"
		        },
		        {
		            "id": "3",
		            "date": "2018-12-14 19:00:12",
		            "description": "test",
		            "name": "name123"
		        },
		        {
		            "id": "2",
		            "date": "2018-12-14 19:00:08",
		            "description": "test",
		            "name": "name123"
		        }
		]
	}
```

## <a name="3"></a>3. Thêm 1 CompanySetting mới
* **URL:** [{API_ROOT}/companysetting](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
Tab: 取引条件
```
	{
		"companyId": int,
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
		        "bankName": string,
		        "bankCode": string,
		        "branchName": string,
		        "branchCode": string,
		        "accountClassification": string,
		        "accountNumber": string,
		        "accountHolder": string,
		}
}
```

Tab: ︎ 指定調査会社
```
	{
		"companyId": int,
		"designated_survey_company_1": string,
		"designated_survey_company_2": string,
		"designated_survey_company_3": string,
		"designated_survey_company_4": string,
		"designated_survey_company_5": string
	}
```
### Dữ liệu trả về:
Tab: 取引条件
```
	{
	        "companyId": int,
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double,
			"addressId": int
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
		        "bankName": string,
		        "bankCode": string,
		        "branchName": string,
		        "branchCode": string,
		        "accountClassification": string,
		        "accountNumber": string,
		        "accountHolder": string,
		        "id": int
		},
		"id": int
	}
```

Tab: ︎ 指定調査会社
```
	{
		"companyId": int,
		"designated_survey_company_1": string,
		"designated_survey_company_2": string,
		"designated_survey_company_3": string,
		"designated_survey_company_4": string,
		"designated_survey_company_5": string,
		"id": int
	}
```
Trường hợp trùng company id, kết quả trả về "id" có giá trị là -1.

##### Ví dụ: 
Tab: 取引条件
```
	{
		"companyId": "12345",
		"creditLimit": "test123",
		"creditStatus": "test123",
		"authConfirmScreen": "test123",
		"authReceiptDoc": "test",
		"invoiceMailingAddress": {
			"postalCode": "test12345",
			"province": "test",
			"city": "test",
			"streetAddress": "test",
			"buildingName": "test",
			"latitude": "123.123",
			"addressId": "47"
		},
		"personNameInCharge": "test",
		"payer": "test",
		"billingMethod": "test",
		"outputUnit": "test",
		"closingClassificationDate": "2018-11-14 19:15:48",
		"estimatedRecoveryDate": "2018-11-14 19:15:48",
		"businessClassificationDate": "2018-11-14 19:15:48",
		"bankAccount": {
		        "bankName": "Name1",
		        "bankCode": "test",
		        "branchName": "test",
		        "branchCode": "test",
		        "accountClassification": "test",
		        "accountNumber": "test",
		        "accountHolder": "test",
		        "id": "4"
		},
	        "id": "123"
	}
```

Tab: ︎ 指定調査会社
```
	{
		"companyId": "123",
		"designated_survey_company_1": "12",
		"designated_survey_company_2": "13",
		"designated_survey_company_3": "14",
		"designated_survey_company_4": "15",
		"designated_survey_company_5": "16",
		"id": "1"
	}
```


## <a name="4"></a>4. Cập nhật CompanySetting theo id
* **URL:** [{API_ROOT}/companysetting/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
Tab: 取引条件
```
	{
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
			"bankName": string,
			"bankCode": string,
			"branchName": string,
			"branchCode": string,
			"accountClassification": string,
			"accountNumber": string,
			"accountHolder": string,
		}
	}
```

Tab: ︎ 指定調査会社
```
	{
		"companyId": int,
		"designated_survey_company_1": string,
		"designated_survey_company_2": string,
		"designated_survey_company_3": string,
		"designated_survey_company_4": string,
		"designated_survey_company_5": string
	}
```
### Dữ liệu trả về:
Tab: 取引条件
```
	{
		"companyId": int,
		"creditLimit": string,
		"creditStatus": string,
		"authConfirmScreen": string,
		"authReceiptDoc": string,
		"invoiceMailingAddress": {
			"postalCode": string,
			"province": string,
			"city": string,
			"streetAddress": string,
			"buildingName": string,
			"latitude": double,
			"longitute": double
		},
		"personNameInCharge": string,
		"payer": string,
		"billingMethod": string,
		"outputUnit": string,
		"closingClassificationDate": datetime,
		"estimatedRecoveryDate": datetime,
		"businessClassificationDate": datetime,
		"bankAccount": {
			"bankName": string,
			"bankCode": string,
			"branchName": string,
			"branchCode": string,
			"accountClassification": string,
			"accountNumber": string,
			"accountHolder": string,
		}
	}
```

Tab: ︎ 指定調査会社
```
	{
		"companyId": int,
		"designated_survey_company_1": string,
		"designated_survey_company_2": string,
		"designated_survey_company_3": string,
		"designated_survey_company_4": string,
		"designated_survey_company_5": string
	}
```
##### Ví dụ: 
Tab: 取引条件
```
	{
		"companyId": "12345",
		"creditLimit": "test123",
		"creditStatus": "test123",
		"authConfirmScreen": "test123",
		"authReceiptDoc": "test",
		"invoiceMailingAddress": {
			"postalCode": "test12345",
			"province": "test",
			"city": "test",
			"streetAddress": "test",
			"buildingName": "test",
			"latitude": "123.123",
			"addressId": "47"
		},
		"personNameInCharge": "test",
		"payer": "test",
		"billingMethod": "test",
		"outputUnit": "test",
		"closingClassificationDate": "2018-11-14 19:15:48",
		"estimatedRecoveryDate": "2018-11-14 19:15:48",
		"businessClassificationDate": "2018-11-14 19:15:48",
		"bankAccount": {
			"bankName": "Name1",
			"bankCode": "test",
			"branchName": "test",
			"branchCode": "test",
			"accountClassification": "test",
			"accountNumber": "test",
			"accountHolder": "test",
			"id": "4"
		}
	}
```

Tab: ︎ 指定調査会社
```
	{
		"companyId": "123",
		"designated_survey_company_1": "12",
		"designated_survey_company_2": "13",
		"designated_survey_company_3": "14",
		"designated_survey_company_4": "15",
		"designated_survey_company_5": "16",
		"id": "1"
	}
```

## <a name="5"></a>5. Xóa CompanySetting theo id
* **URL:** [{API_ROOT}/companysetting/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của CompanySetting cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/companysetting/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500


## <a name="6"></a>6. Lấy danh sách CompanySurveys từ company id
* **URL:** [{API_ROOT}/companysurveys/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của Companyid cần truyền vào

### Dữ liệu trả về:
```
	[
	    {
		"survey_company_id": int,
		"companyDisplayName": string,
		},
	    ...
	]
  ```

##### Ví dụ: {API_ROOT}/companysurveys/2
Dữ liệu trả về:
```
[
    {
        "survey_company_id": "8",
        "companyDisplayName": "Company Survey 1"
    },
    {
        "survey_company_id": "57",
        "companyDisplayName": "Jibangoo"
    },
    ...
]
```

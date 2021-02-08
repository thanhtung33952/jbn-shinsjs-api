### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới company
###### 1. [Lấy toàn bộ Company](#1. Lấy toàn bộ Company)
###### 2. [Lấy thông tin company từ company id](#2. Lấy thông tin company từ company id)
###### 3. [Thêm 1 company mới](#3. Thêm 1 company mới)
###### 4. [Cập nhật company theo company id](#4. Cập nhật company theo company id)
###### 5. [Xóa company theo company id](#5. Xóa company theo company id)
###### 6. [Tìm kiếm company name theo name](#6. Tìm kiếm company name theo name)

**********************************
Những tham số sau có hoặc không có đều được, trường hợp không có, mặc định sẽ lưu là NULL trong database

Name | Param
------- | -------------------
FC加盟店 | fcFranchiseStore
会社の形態 | companyForm
代表者名 | representativeName
資本金 | capital
設立日 | establishmentDate
社員数 | employeesNo
**********************************

## Danh sách các API liên quan tới company
## 1. Lấy toàn bộ Company
* **URL:** [{API_ROOT}/companies](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/companies?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
		"companyId": int,
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"addressID": int,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	    },
	    {
		"companyId": int,
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"addressID": int,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"companyId": "1",
		"companyDisplayName": "test",
		"companyFormalName": "test",
		"phonetic": "test",
		"phoneNumber": "test",
		"faxNumber": "test",
		"representativeEmail": "test",
		"website": "test",
		"contentOfTrans": "test",
		"addressID": "1",
		"postalCode": "test123",
        "province": "province1",
        "city": "city1",
        "streetAddress": "street1",
        "buildingName": "building1",
        "latitude": "123.123",
        "longitute": "123.456"
		"createDate": "2018-12-07 17:05:16",
		"createUserTemp": "123",
		"createUser": "2",
		"fcFranchiseStore": null,
		"companyForm": null,
		"representativeName": null,
		"capital": null,
		"establishmentDate": null,
		"employeesNo": null,
		"contactName": null,
		"contactInformation": null
	    },
	    {
		"companyId": "2",
		"companyDisplayName": "test2",
		"companyFormalName": "test2",
		"phonetic": "test",
		"phoneNumber": "test",
		"faxNumber": "test",
		"representativeEmail": "test",
		"website": "test",
		"contentOfTrans": "test",
		"addressID": "1",
		"postalCode": "test123",
        "province": "province1",
        "city": "city1",
        "streetAddress": "street1",
        "buildingName": "building1",
        "latitude": "123.123",
        "longitute": "123.456"
		"createDate": "2018-12-07 17:06:16",
		"createUserTemp": "123",
		"createUser": "2",
		"fcFranchiseStore": null,
		"companyForm": null,
		"representativeName": null,
		"capital": null,
		"establishmentDate": null,
		"employeesNo": null,
		"contactName": null,
		"contactInformation": null
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin company từ company id
* **URL:** [{API_ROOT}/company/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của company id cần truyền vào

### Dữ liệu trả về:
```
	{
		"companyId": int,
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"addressID": int,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	}
```

##### Ví dụ: {API_ROOT}/company/1
Dữ liệu trả về:
```
	{
		"companyId": "2",
		"companyDisplayName": "test2",
		"companyFormalName": "test2",
		"phonetic": "test",
		"phoneNumber": "test",
		"faxNumber": "test",
		"representativeEmail": "test",
		"website": "test",
		"contentOfTrans": "test",
		"addressID": "1",
		"postalCode": "test123",
        "province": "province1",
        "city": "city1",
        "streetAddress": "street1",
        "buildingName": "building1",
        "latitude": "123.123",
        "longitute": "123.456"
		"createDate": "2018-12-07 17:06:16",
		"createUserTemp": "123",
		"createUser": "2",
		"fcFranchiseStore": null,
		"companyForm": null,
		"representativeName": null,
		"capital": null,
		"establishmentDate": null,
		"employeesNo": null,
		"contactName": null,
		"contactInformation": null
	}
```

## <a name="3"></a>3. Thêm 1 company mới
* **URL:** [{API_ROOT}/company](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	}
```

### Dữ liệu trả về:
```
	{
		"id": int,
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	}
```

##### Ví dụ: 
```
	{
		"id": "2",
		"companyDisplayName": "test2",
		"companyFormalName": "test2",
		"phonetic": "test",
		"phoneNumber": "test",
		"faxNumber": "test",
		"representativeEmail": "test",
		"website": "test",
		"contentOfTrans": "test",
		"postalCode": "test",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
		"latitude": "123.123",
        "longitute": "123.456"
		"createDate": "2018-12-07 17:06:16",
		"createUserTemp": "123",
		"createUser": "2",
		"fcFranchiseStore": null,
		"companyForm": null,
		"representativeName": null,
		"capital": null,
		"establishmentDate": null,
		"employeesNo": null,
		"contactName": null,
		"contactInformation": null
	}
```

## <a name="4"></a>4. Cập nhật company theo company id
* **URL:** [{API_ROOT}/company/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	}
```

### Dữ liệu trả về:
```
	{
		"id": int,
		"companyDisplayName": string,
		"companyFormalName": string,
		"phonetic": string,
		"phoneNumber": string,
		"faxNumber": string,
		"representativeEmail": string,
		"website": string,
		"contentOfTrans": string,
		"postalCode": string,
		"province": string,
		"city": string,
		"streetAddress": string,
		"buildingName": string,
		"latitude": double,
		"longitute": double,
		"createDate": datetime,
		"createUserTemp": string,
		"createUser": string,
		"fcFranchiseStore": string,
		"companyForm": string,
		"representativeName": string,
		"capital": string,
		"establishmentDate": datetime,
		"employeesNo": string,
		"contactName": string,
		"contactInformation": string
	}
```

##### Ví dụ: 
```
	{
		"id": "2",
		"companyDisplayName": "test2",
		"companyFormalName": "test2",
		"phonetic": "test",
		"phoneNumber": "test",
		"faxNumber": "test",
		"representativeEmail": "test",
		"website": "test",
		"contentOfTrans": "test",
		"postalCode": "test",
		"province": "test",
		"city": "test",
		"streetAddress": "test",
		"buildingName": "test",
		"latitude": "123.123",
        "longitute": "123.456"
		"createDate": "2018-12-07 17:06:16",
		"createUserTemp": "123",
		"createUser": "2",
		"fcFranchiseStore": null,
		"companyForm": null,
		"representativeName": null,
		"capital": null,
		"establishmentDate": null,
		"employeesNo": null,
		"contactName": null,
		"contactInformation": null
	}
```

## <a name="5"></a>5. Xóa company theo company id
* **URL:** [{API_ROOT}/company/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của company cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/company/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500


## <a name="6"></a>6. Tìm kiếm company name theo name
* **URL:** [{API_ROOT}/company/search/{name}](#)
* **Method:** GET
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào name trên url, nếu tìm tất cả ko cần truyền giá trị name

Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

- **limit**: số lượng record trả về
- **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/company/search/{name}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "id": int,
	        "name": string,
	        "representativeEmail": string,
	        "contactName": string,
	        "contactInformation": string
	    },
	    {
	        "id": int,
	        "name": string,
	        "representativeEmail": string,
	        "contactName": string,
	        "contactInformation": string
	    },
	    ...
	]
```

##### Ví dụ: 	
	
```
	[
	    {
	        "id": "38",
	        "name": "abc",
	        "representativeEmail": "Jibangoo@gmail.com",
	        "contactName": null,
	        "contactInformation": null
	    },
	    {
	        "id": "39",
	        "name": "abcd",
	        "representativeEmail": "Jibangoo@gmail.com",
	        "contactName": null,
	        "contactInformation": null
	    },
	    ...
	]
```

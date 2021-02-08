### API public

**API_ROOT:** http://153.125.228.20/api/ (Old)
**API_ROOT:** https://jibannet.online/api/ (New)

## Danh sách các API liên quan tới survey
###### 1. [Lấy toàn bộ survey(tất cả hoặc theo userId)](#1. Lấy toàn bộ survey(tất cả hoặc theo userId))
###### 2. [Lấy thông tin survey từ id](#2. Lấy thông tin survey từ id)
###### 3. [Thêm 1 survey mới Public hoặc Draft](#3. Thêm 1 survey mới Public hoặc Draft)
###### 4. [Cập nhật survey theo id Public hoặc Draft](#4. Cập nhật survey theo id Public hoặc Draft)
###### 5. [Xóa survey theo id](#5. Xóa survey theo id)
###### 6. [Cập nhật status survey theo id](#6. Cập nhật status survey theo id)
###### 7. [Lấy số lượng survey theo status-Người tạo](#7. Lấy số lượng survey theo status-Người tạo)
###### 8. [Lấy chi tiết survey theo status-Người tạo](#8. Lấy chi tiết survey theo status-Người tạo)
###### 9. [Lấy số lượng survey theo status public](#9. Lấy số lượng survey theo status public)
###### 10. [Lấy chi tiết survey theo status public](#10. Lấy chi tiết survey theo status public)
###### 11. [Lấy toàn bộ survey map](#11. Lấy toàn bộ survey map)
###### 12. [Lấy số lượng survey map](#12. Lấy số lượng survey map)

**********************************

## Danh sách các API liên quan tới survey
## 1. Lấy toàn bộ survey (tất cả hoặc theo userId)
* **URL:** [{API_ROOT}/surveys](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Muốn lọc các survey thuộc của user nào thì truyền param userId (vd userId=123456789)
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/surveys?userId={userId}&limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
		"id": int,
		"userId": int,
		"a_company_name": string,
		"a_contact_name": string,
		"a_email": string,
		"a_contacts_etc": string,
		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,
		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,
		"scheduled_survey_company": string,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,
		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,
		"slope": int,
		"field_situation": string,
		"height_disorder": int,
		"building_drawing_set": string,
		"site_photo": string,
		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,
		"status": int,
		"statusPublic": int
	    },
	    {
		"id": int,
		"userId": int,
		"a_company_name": string,
		"a_contact_name": string,
		"a_email": string,
		"a_contacts_etc": string,
		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,
		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,
		"scheduled_survey_company": string,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,
		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,
		"slope": int,
		"field_situation": string,
		"height_disorder": int,
		"building_drawing_set": string,
		"site_photo": string,
		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,
		"status": int,
		"statusPublic": int
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"id": "1",
		"userId": "12",
		"a_company_name": "Jibannet",
		"a_contact_name": "Jibannet name",
		"a_email": "test@gmail.com",
		"a_contacts_etc": null,
		"c_company_id": null,
		"c_business_name": null,
		"c_contact_name": null,
		"c_email": null,
		"c_contacts_etc": null,
		"property_name": null,
		"furigana": null,
		"number_of_applications": null,
		"division": null,
		"location_prefecture": null,
		"city_or_county": null,
		"street_address": null,
		"location_information": null,
		"construction_number": null,
		"scheduled_survey_company": null,
		"survey_date": null,
		"first_choice_from": null,
		"first_choice_to": null,
		"first_choice_hour": null,
		"second_choice_from": null,
		"second_choice_to": null,
		"second_choice_hour": null,
		"time_specification": null,
		"survey_method": null,
		"witness": null,
		"final_investigation_company": "Jibannet",
		"final_survey_date": null,
		"proceed_after_survey": "調査・判定結果をお知らせ下さい。結果を見て次に進めます。",
		"collateral_liability_insurance_corporation": null,
		"building_confirmation_application_organization": null,
		"building_structure": null,
		"building_floor_number": null,
		"total_floor_area": null,
		"design_ground_pressure": null,
		"building_division": null,
		"usage_classification": null,
		"basic_shape": null,
		"rooting_depth": null,
		"deep_foundation_available": null,
		"foundation_work_schedule": "1",
		"foundation_work_schedule_date": "2019/01/05",
		"slope": null,
		"field_situation": null,
		"height_disorder": null,
		"building_drawing_set": null,
		"site_photo": null,
		"construction_quotation": null,
		"construction_examination_book": null,
		"construction_report": null,
		"status": "1",
		"statusPublic": "1"
	    },
	    {
		"id": "2",
		"userId": "12",
		"a_company_name": "Jibannet",
		"a_contact_name": "Jibannet name",
		"a_email": "test@gmail.com",
		"a_contacts_etc": null,
		"c_company_id": null,
		"c_business_name": null,
		"c_contact_name": null,
		"c_email": null,
		"c_contacts_etc": null,
		"property_name": null,
		"furigana": null,
		"number_of_applications": null,
		"division": null,
		"location_prefecture": null,
		"city_or_county": null,
		"street_address": null,
		"location_information": null,
		"construction_number": null,
		"scheduled_survey_company": null,
		"survey_date": null,
		"first_choice_from": null,
		"first_choice_to": null,
		"first_choice_hour": null,
		"second_choice_from": null,
		"second_choice_to": null,
		"second_choice_hour": null,
		"time_specification": null,
		"survey_method": null,
		"witness": null,
		"final_investigation_company": "Jibannet",
		"final_survey_date": null,
		"proceed_after_survey": "調査・判定結果をお知らせ下さい。結果を見て次に進めます。",
		"collateral_liability_insurance_corporation": null,
		"building_confirmation_application_organization": null,
		"building_structure": null,
		"building_floor_number": null,
		"total_floor_area": null,
		"design_ground_pressure": null,
		"building_division": null,
		"usage_classification": null,
		"basic_shape": null,
		"rooting_depth": null,
		"deep_foundation_available": null,
		"foundation_work_schedule": "1",
		"foundation_work_schedule_date": "2019/01/05",
		"slope": null,
		"field_situation": null,
		"height_disorder": null,
		"building_drawing_set": null,
		"site_photo": null,
		"construction_quotation": null,
		"construction_examination_book": null,
		"construction_report": null,
		"status": "1",
		"statusPublic": "1"
	    },
	    ...
	]
  ```

## <a name="2"></a>2. Lấy thông tin survey từ id
* **URL:** [{API_ROOT}/survey/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"userId": int,
		"a_company_name": string,
		"a_contact_name": string,
		"a_email": string,
		"a_contacts_etc": string,
		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,
		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,
		"scheduled_survey_company": string,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,
		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,
		"slope": int,
		"field_situation": string,
		"height_disorder": int,
		"building_drawing_set": string,
		"site_photo": string,
		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,
		"status": int,
		"statusPublic": "1"
	}
```

##### Ví dụ: {API_ROOT}/survey/2
Dữ liệu trả về:
```
	{
		"id": "2",
		"userId": "12",
		"a_company_name": "Jibannet",
		"a_contact_name": "Jibannet name",
		"a_email": "test@gmail.com",
		"a_contacts_etc": null,
		"c_company_id": null,
		"c_business_name": null,
		"c_contact_name": null,
		"c_email": null,
		"c_contacts_etc": null,
		"property_name": null,
		"furigana": null,
		"number_of_applications": null,
		"division": null,
		"location_prefecture": null,
		"city_or_county": null,
		"street_address": null,
		"location_information": null,
		"construction_number": null,
		"scheduled_survey_company": null,
		"survey_date": null,
		"first_choice_from": null,
		"first_choice_to": null,
		"first_choice_hour": null,
		"second_choice_from": null,
		"second_choice_to": null,
		"second_choice_hour": null,
		"time_specification": null,
		"survey_method": null,
		"witness": null,
		"final_investigation_company": "Jibannet",
		"final_survey_date": null,
		"proceed_after_survey": "調査・判定結果をお知らせ下さい。結果を見て次に進めます。",
		"collateral_liability_insurance_corporation": null,
		"building_confirmation_application_organization": null,
		"building_structure": null,
		"building_floor_number": null,
		"total_floor_area": null,
		"design_ground_pressure": null,
		"building_division": null,
		"usage_classification": null,
		"basic_shape": null,
		"rooting_depth": null,
		"deep_foundation_available": null,
		"foundation_work_schedule": "1",
		"foundation_work_schedule_date": "2019/01/05",
		"slope": null,
		"field_situation": null,
		"height_disorder": null,
		"building_drawing_set": null,
		"site_photo": null,
		"construction_quotation": null,
		"construction_examination_book": null,
		"construction_report": null,
		"status": "1",
		"statusPublic": "1"
	}
```

## <a name="3"></a>3. Thêm 1 survey mới Public hoặc Draft
* **URL:** [{API_ROOT}/survey](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
Trường hợp lưu nháp (Draft) truyền statusPublic = 0
Trường hợp công khai (Public) truyền statusPublic = 1

```
	{
		"userId": int,
		"a_contacts_etc": string,

		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,

		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,

		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,

		"building_drawing_set": string,
		"site_photo": string,

		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,

		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,

		"slope": int,
		"field_situation": string,
		"height_disorder": int,

		"scheduled_survey_company_id": int,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,

		"statusPublic": int
	}
```

### Dữ liệu trả về:
```
	{
	    "id": int,
		"userId": int,
		"a_contacts_etc": string,
		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,
		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,
		"scheduled_survey_company_id": int,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,
		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,
		"slope": int,
		"field_situation": string,
		"height_disorder": int,
		"building_drawing_set": string,
		"site_photo": string,
		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,
		"status": int,
		"statusPublic": int
	}
```

##### Ví dụ: 
```
	{
		"id": "2",
		"userId": "12",
		"a_contacts_etc": null,
		"c_company_id": null,
		"c_business_name": null,
		"c_contact_name": null,
		"c_email": null,
		"c_contacts_etc": null,
		"property_name": null,
		"furigana": null,
		"number_of_applications": null,
		"division": null,
		"location_prefecture": null,
		"city_or_county": null,
		"street_address": null,
		"location_information": null,
		"construction_number": null,
		"scheduled_survey_company_id": "12",
		"survey_date": null,
		"first_choice_from": null,
		"first_choice_to": null,
		"first_choice_hour": null,
		"second_choice_from": null,
		"second_choice_to": null,
		"second_choice_hour": null,
		"time_specification": null,
		"survey_method": null,
		"witness": null,
		"final_investigation_company": "Jibannet",
		"final_survey_date": null,
		"proceed_after_survey": "調査・判定結果をお知らせ下さい。結果を見て次に進めます。",
		"collateral_liability_insurance_corporation": null,
		"building_confirmation_application_organization": null,
		"building_structure": null,
		"building_floor_number": null,
		"total_floor_area": null,
		"design_ground_pressure": null,
		"building_division": null,
		"usage_classification": null,
		"basic_shape": null,
		"rooting_depth": null,
		"deep_foundation_available": null,
		"foundation_work_schedule": "1",
		"foundation_work_schedule_date": "2019/01/05",
		"slope": null,
		"field_situation": null,
		"height_disorder": null,
		"building_drawing_set": null,
		"site_photo": null,
		"construction_quotation": null,
		"construction_examination_book": null,
		"construction_report": null,
		"status": "1",
		"statusPublic": "0"
	}
```

## <a name="4"></a>4. Cập nhật survey theo id Public hoặc Draft
* **URL:** [{API_ROOT}/survey/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
Trường hợp lưu nháp (Draft) truyền statusPublic = 0
Trường hợp công khai (Public) truyền statusPublic = 1
```
	{
		"userId": int,
		"a_contacts_etc": string,
		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,
		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,
		"scheduled_survey_company_id": int,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,
		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,
		"slope": int,
		"field_situation": string,
		"height_disorder": int,
		"building_drawing_set": string,
		"site_photo": string,
		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,
		"statusPublic": int
	}
```

### Dữ liệu trả về:
```
	{
		"id": int,
		"userId": int,
		"a_contacts_etc": string,
		"c_company_id": int,
		"c_business_name": string,
		"c_contact_name": string,
		"c_email": string,
		"c_contacts_etc": string,
		"property_name": string,
		"furigana": string,
		"number_of_applications": string,
		"division": string,
		"location_prefecture": string,
		"city_or_county": string,
		"street_address": string,
		"location_information": string,
		"construction_number": string,
		"scheduled_survey_company_id": int,
		"survey_date": string,
		"first_choice_from": datetime,
		"first_choice_to": datetime,
		"first_choice_hour": string,
		"second_choice_from": datetime,
		"second_choice_to": datetime,
		"second_choice_hour": string,
		"time_specification": string,
		"survey_method": string,
		"witness": int,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": string,
		"building_confirmation_application_organization": string,
		"building_structure": string,
		"building_floor_number": string,
		"total_floor_area": string,
		"design_ground_pressure": string,
		"building_division": string,
		"usage_classification": string,
		"basic_shape": string,
		"rooting_depth": string,
		"deep_foundation_available": string,
		"foundation_work_schedule": string,
		"foundation_work_schedule_date": date,
		"slope": int,
		"field_situation": string,
		"height_disorder": int,
		"building_drawing_set": string,
		"site_photo": string,
		"construction_quotation": string,
		"construction_examination_book": string,
		"construction_report": string,
		"status": int,
		"statusPublic": int
	}
```

##### Ví dụ: 
```
	{
		"id": "2",
		"userId": "12",
		"a_contacts_etc": null,
		"c_company_id": null,
		"c_business_name": null,
		"c_contact_name": null,
		"c_email": null,
		"c_contacts_etc": null,
		"property_name": null,
		"furigana": null,
		"number_of_applications": null,
		"division": null,
		"location_prefecture": null,
		"city_or_county": null,
		"street_address": null,
		"location_information": null,
		"construction_number": null,
		"scheduled_survey_company_id": "12",
		"survey_date": null,
		"first_choice_from": null,
		"first_choice_to": null,
		"first_choice_hour": null,
		"second_choice_from": null,
		"second_choice_to": null,
		"second_choice_hour": null,
		"time_specification": null,
		"survey_method": null,
		"witness": null,
		"final_investigation_company": string,
		"final_survey_date": datetime,
		"proceed_after_survey": string,
		"collateral_liability_insurance_corporation": null,
		"building_confirmation_application_organization": null,
		"building_structure": null,
		"building_floor_number": null,
		"total_floor_area": null,
		"design_ground_pressure": null,
		"building_division": null,
		"usage_classification": null,
		"basic_shape": null,
		"rooting_depth": null,
		"deep_foundation_available": null,
		"foundation_work_schedule": "1",
		"foundation_work_schedule_date": "2019/01/05",
		"slope": null,
		"field_situation": null,
		"height_disorder": null,
		"building_drawing_set": null,
		"site_photo": null,
		"construction_quotation": null,
		"construction_examination_book": null,
		"construction_report": null,
		"status": "1",
		"statusPublic": "0"
	}
```

## <a name="5"></a>5. Xóa survey theo id
* **URL:** [{API_ROOT}/survey/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của survey cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/survey/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500



## <a name="6"></a>6. Cập nhật status survey theo id
* **URL:** [{API_ROOT}/survey/updatestatus/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"status": int
	}
```

### Dữ liệu trả về:
```
	{
		"status": int
	}
```

##### Ví dụ: 
```
	{
		"status": "2"
	}
```


## <a name="7"></a>7. Lấy số lượng survey theo status-Người tạo
* **URL:** [{API_ROOT}/applicant/totalsurvey](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {statusPublic} là trạng thái draft hoặc public của survey, tương ứng là 0 và 1
* {status} là trạng thái của survey
```
	{
		"userId": int,
		"statusPublic": int,
		"status": int
	}
```

### Dữ liệu trả về:
```
	{
		"total": int
	}
```

##### Ví dụ: {API_ROOT}/applicant/totalsurvey
Dữ liệu trả về:
```
	{
		
		"total": "12"
	}
```


## <a name="8"></a>8. Lấy chi tiết survey theo status-Người tạo
* **URL:** [{API_ROOT}/applicant/detailssurvey](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {statusPublic} là trạng thái draft hoặc public của survey, tương ứng là 0 và 1
* {status} là trạng thái của survey
```
	{
		"userId": int,
		"statusPublic": int,
		"status": int
	}
```

### Dữ liệu trả về:
```
	[
		{
			"id": int,
			"update_date": "2019-08-20 15:49:26"
		},
		{
			"id": int,
			"update_date": "2019-08-20 15:49:26"
		},
		...
	]
```

##### Ví dụ: {API_ROOT}/applicant/detailssurvey
Dữ liệu trả về:
```
	[
		{
			"id": "12",
			"update_date": "2019-08-20 15:49:26"
		},
		{
			"id": "13",
			"update_date": "2019-08-20 15:49:26"
		},
		...
	]
```



## <a name="9"></a>9. Lấy số lượng survey theo status public
* **URL:** [{API_ROOT}/totalsurvey](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"userId": int
	}
```

### Dữ liệu trả về:
```
	{
		"total": int
	}
```

##### Ví dụ: {API_ROOT}/totalsurvey
Dữ liệu trả về:
```
	{
		
		"total": "12"
	}
```


## <a name="10"></a>10. Lấy chi tiết survey theo status public
* **URL:** [{API_ROOT}/detailssurvey](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"userId": int
	}
```

### Dữ liệu trả về:
```
	[
		{
			"id": int,
			"update_date": datetime
		},
		{
			"id": int,
			"update_date": datetime
		},
		...
	]
```

##### Ví dụ: {API_ROOT}/detailssurvey
Dữ liệu trả về:
```
	[
		{
			"id": "12",
			"update_date": "2019-08-20 15:49:26"
		},
		{
			"id": "13",
			"update_date": "2019-08-20 15:49:26"
		},
		...
	]
```

## 11. Lấy toàn bộ survey map
* **URL:** [{API_ROOT}/surveymaps](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"userId": int
	}
```
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/surveymaps?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
		"id": int,
		"location_information": string,
		"statusSurvey": string,
		"property_name": string,
		"c_business_name": string,
		"survey_date": string,
		"street_address": string,
		"survey_method": string,
		"note": string
	    },
	    {
		"id": int,
		"location_information": string,
		"statusSurvey": string,
		"property_name": string,
		"c_business_name": string,
		"survey_date": string,
		"street_address": string,
		"survey_method": string,
		"note": string
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
		"id": "1",
		"location_information": "35.68089,139.76749",
		"statusSurvey": "成立済",
		"property_name": "property name",
		"c_business_name": "Jibannet",
		"survey_date": "0",
		"street_address": "dfgfdgd",
		"survey_method": "semi_automatic",
		"note": null
	    },
	    {
		"id": "2",
		"location_information": "35.68089,139.76749",
		"statusSurvey": "募集中",
		"property_name": null,
		"c_business_name": null,
		"survey_date": "0",
		"street_address": null,
		"survey_method": "semi_automatic",
		"note": null
	    },
	    ...
	]
  ```


## <a name="12"></a>12. Lấy số lượng survey map
* **URL:** [{API_ROOT}/totalsurveymap](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"userId": int
	}
```

### Dữ liệu trả về:
```
	{
		"total": int,
		"totalEstablished": int
	}
```
totalEstablished là: 成立済
##### Ví dụ: {API_ROOT}/totalsurveymap
Dữ liệu trả về:
```
	{
		"total": "46",
		"totalEstablished": "17"
	}
```


### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới SurveyInfo

###### 1. [Lấy thông tin SurveyInfo từ id](#1. Lấy thông tin SurveyInfo từ id)
###### 2. [Thêm 1 SurveyInfo mới](#2. Thêm 1 SurveyInfo mới)
###### 3. [Cập nhật SurveyInfo theo id](#3. Cập nhật SurveyInfo theo id)
###### 4. [Xóa SurveyInfo theo id](#4. Xóa SurveyInfo theo id)

**********************************

## Danh sách các API liên quan tới SurveyInfo

## <a name="1"></a>1. Lấy thông tin SurveyInfo từ id
* **URL:** [{API_ROOT}/surveyinfo/{id}?no={no}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào
* {no} là số page cần truyền vào
* 
### Dữ liệu trả về:
```
	{
		"id": int,
		"survey_id": int,
		"site_name": string,
		"weather": string,
		"remarks": string,
		"measurement_point_no": int,
		"water_level": string,
		"measurement_content": string,
		"phenol_reaction": int,
		
		"survey_name": string,
		"survey_location": string,
		"hole_mouth_elevation": string,
		"survey_date": datetime,
		"final_penetration_depth": string,
		"tester": string,
		"survey_equipment": string,
		"0.25": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string
		},
		...
		"10.00": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		}
	}	
```

##### Ví dụ: {API_ROOT}/surveyinfo/2?no=1
Dữ liệu trả về:
```
	{
		"id": "12",
		"survey_id": "10",
		"site_name": "test",
		"weather": "test",
		"remarks": "test",
		"measurement_point_no": "1",
		"water_level": "test",
		"measurement_content": "test",
		"phenol_reaction": "2",
		
		"survey_name": "小林　裕二　様邸",
		"survey_location": "東京都日野市大字川辺堀之内542-1",
		"hole_mouth_elevation": "KBM ±0.00 m",
		"survey_date": "2020-02-17",
		"final_penetration_depth": "5.55 m",
		"tester": "新留　徹",
		"survey_equipment": "",
		"0.25": {
			"wsw": "testtest",
			"half_revolution": "abc",
			"shari": "1",
			"jari": "1",
			"gully": "1",
			"excavation": "1",
			"ston": "1",
			"sursul": "1",
			"yukuri": "1",
			"jinwali": "1",
			"number_of_hits": "123",
			"idling": "1",
			"sandy_soil": "1",
			"clay_soil": "1",
			"other": "123",
        		"penetration_amount": "1",
        		"nws": "2",
        		"sound_and_feel": "eqwe",
        		"intrusion_status": "貫入",
        		"soil_name": "粘性土",
        		"conversion_N_value": "100",
        		"allowable_bearing_capacity": "< 100"
		},
		...
		"10.00": {
			"wsw": "testtest",
			"half_revolution": "abc",
			"shari": "1",
			"jari": "1",
			"gully": "1",
			"excavation": "1",
			"ston": "1",
			"sursul": "1",
			"yukuri": "1",
			"jinwali": "1",
			"number_of_hits": "123",
			"idling": "1",
			"sandy_soil": "1",
			"clay_soil": "1",
			"other": "123",
        		"penetration_amount": "1",
        		"nws": "2",
        		"sound_and_feel": "eqwe",
        		"intrusion_status": "貫入",
        		"soil_name": "粘性土",
        		"conversion_N_value": "100",
        		"allowable_bearing_capacity": "< 100"
		}
	}
```

## <a name="2"></a>2. Thêm 1 SurveyInfo mới
* **URL:** [{API_ROOT}/surveyinfo](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"survey_id": int,
		"site_name": string,
		"weather": string,
		"remarks": string,
		"measurement_point_no": int,
		"water_level": string,
		"measurement_content": string,
		"phenol_reaction": int,
		
		"survey_name": string,
		"survey_location": string,
		"hole_mouth_elevation": string,
		"survey_date": datetime,
		"final_penetration_depth": string,
		"tester": string,
		"survey_equipment": string,
		"0.25": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		},
		...
		"10.00": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		}
	}

```

### Dữ liệu trả về:
```
	{
		"survey_id": int,
		"site_name": string,
		"weather": string,
		"remarks": string,
		"measurement_point_no": int,
		"water_level": string,
		"measurement_content": string,
		"phenol_reaction": int,
		
		"survey_name": string,
		"survey_location": string,
		"hole_mouth_elevation": string,
		"survey_date": datetime,
		"final_penetration_depth": string,
		"tester": string,
		"survey_equipment": string,
		"0.25": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		},
		...
		"10.00": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		}
	}
```
Trường hợp trùng survey_id, kết quả trả về lỗi 500

##### Ví dụ: 
```
	{
		"survey_id": "12",
		"site_name": "text site name",
		"weather": "晴,雪",
		"remarks": "text remarks",
		"measurement_point_no": "1",
		"water_level": "不明",
		"measurement_content": "新規,再調査",
		"phenol_reaction": "モーターストール",
		
		"survey_name": "小林　裕二　様邸",
		"survey_location": "東京都日野市大字川辺堀之内542-1",
		"hole_mouth_elevation": "KBM ±0.00 m",
		"survey_date": "2020-02-17",
		"final_penetration_depth": "5.55 m",
		"tester": "新留　徹",
		"survey_equipment": "",
		"0.25": {
			"wsw": "testtest",
			"half_revolution": "abc",
			"shari": "1",
			"jari": "1",
			"gully": "1",
			"excavation": "1",
			"ston": "1",
			"sursul": "1",
			"yukuri": "1",
			"jinwali": "1",
			"number_of_hits": "123",
			"idling": "1",
			"sandy_soil": "1",
			"clay_soil": "1",
			"other": "123",
        		"penetration_amount": "1",
        		"nws": "2",
        		"sound_and_feel": "eqwe",
        		"intrusion_status": "貫入",
        		"soil_name": "粘性土",
        		"conversion_N_value": "100",
        		"allowable_bearing_capacity": "< 100"
		},
		...
		"10.00": {
			"wsw": "testtest",
			"half_revolution": "abc",
			"shari": "1",
			"jari": "1",
			"gully": "1",
			"excavation": "1",
			"ston": "1",
			"sursul": "1",
			"yukuri": "1",
			"jinwali": "1",
			"number_of_hits": "123",
			"idling": "1",
			"sandy_soil": "1",
			"clay_soil": "1",
			"other": "123",
        		"penetration_amount": "1",
        		"nws": "2",
        		"sound_and_feel": "eqwe",
        		"intrusion_status": "貫入",
        		"soil_name": "粘性土",
        		"conversion_N_value": "100",
        		"allowable_bearing_capacity": "< 100"
		}
	}
```

## <a name="3"></a>3. Cập nhật SurveyInfo theo id
* **URL:** [{API_ROOT}/surveyinfo/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
		"site_name": string,
		"weather": string,
		"remarks": string,
		"measurement_point_no": int,
		"water_level": string,
		"measurement_content": string,
		"phenol_reaction": int,
		
		"survey_name": string,
		"survey_location": string,
		"hole_mouth_elevation": string,
		"survey_date": datetime,
		"final_penetration_depth": string,
		"tester": string,
		"survey_equipment": string,
		"0.25": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		},
		...
		"10.00": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		}
	}
```

### Dữ liệu trả về:
```
	{
		"site_name": string,
		"weather": string,
		"remarks": string,
		"measurement_point_no": int,
		"water_level": string,
		"measurement_content": string,
		"phenol_reaction": int,
		
		"survey_name": string,
		"survey_location": string,
		"hole_mouth_elevation": string,
		"survey_date": datetime,
		"final_penetration_depth": string,
		"tester": string,
		"survey_equipment": string,
		"0.25": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		},
		...
		"10.00": {
			"wsw": string,
			"half_revolution": string,
			"shari": int,
			"jari": int,
			"gully": int,
			"excavation": int,
			"ston": int,
			"sursul": int,
			"yukuri": int,
			"jinwali": int,
			"number_of_hits": string,
			"idling": int,
			"sandy_soil": int,
			"clay_soil": int,
			"other": string,
        		"penetration_amount": string,
        		"nws": string,
        		"sound_and_feel": string,
        		"intrusion_status": string,
        		"soil_name": string,
        		"conversion_N_value": string,
        		"allowable_bearing_capacity": string
		}
	}
```

##### Ví dụ: 
```
	{
		"site_name": "text site name",
		"weather": "晴,雪",
		"remarks": "text remarks",
		"measurement_point_no": "1",
		"water_level": "不明",
		"measurement_content": "新規,再調査",
		"phenol_reaction": "モーターストール",
		
		"survey_name": "小林　裕二　様邸",
		"survey_location": "東京都日野市大字川辺堀之内542-1",
		"hole_mouth_elevation": "KBM ±0.00 m",
		"survey_date": "2020-02-17",
		"final_penetration_depth": "5.55 m",
		"tester": "新留　徹",
		"survey_equipment": "",
		"0.25": {
			"wsw": "testtest",
			"half_revolution": "abc",
			"shari": "1",
			"jari": "1",
			"gully": "1",
			"excavation": "1",
			"ston": "1",
			"sursul": "1",
			"yukuri": "1",
			"jinwali": "1",
			"number_of_hits": "123",
			"idling": "1",
			"sandy_soil": "1",
			"clay_soil": "1",
			"other": "123",
        		"penetration_amount": "1",
        		"nws": "2",
        		"sound_and_feel": "eqwe",
        		"intrusion_status": "貫入",
        		"soil_name": "粘性土",
        		"conversion_N_value": "100",
        		"allowable_bearing_capacity": "< 100"
		},
		...
		"10.00": {
			"wsw": "testtest",
			"half_revolution": "abc",
			"shari": "1",
			"jari": "1",
			"gully": "1",
			"excavation": "1",
			"ston": "1",
			"sursul": "1",
			"yukuri": "1",
			"jinwali": "1",
			"number_of_hits": "123",
			"idling": "1",
			"sandy_soil": "1",
			"clay_soil": "1",
			"other": "123",
        		"penetration_amount": "1",
        		"nws": "2",
        		"sound_and_feel": "eqwe",
        		"intrusion_status": "貫入",
        		"soil_name": "粘性土",
        		"conversion_N_value": "100",
        		"allowable_bearing_capacity": "< 100"
		}
	}
```

## <a name="4"></a>4. Xóa SurveyInfo theo id
Xem api xóa survey, trường hợp xóa survey sẽ xóa luôn dữ liệu survey info

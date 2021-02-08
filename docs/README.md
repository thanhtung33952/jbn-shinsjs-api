## API public

Server: 153.126.153.165 (https://jinos.online)


|STT|URL|Method|Nhiệm vụ|Đang sử dụng|
| ------------- | ------------- | ------------- | ------------- | ------------- |
|1|/geocode/coordinate?lat=[{lat}&lng=[{lng}]|GET|Lấy thông tin địa chỉ theo tọa độ|x|

#

Server: 153.125.228.20 (https://jibannet.online/api/)


|STT|URL|Method|Nhiệm vụ|Đang sử dụng|
| ------------- | ------------- | ------------- | ------------- | ------------- |
|1|/zipaddress/[{zipcode}]|GET||x|
|2|/download/[{filename}]|GET||x|
|3|/token|POST|||
|4|/common/uploadfile|POST|Upload file|x|
|5|/common/uploadphoto|POST|Upload hình ảnh|x|
|6|/account/register|POST|Đăng kí tài khoản mới|x|
|7|/account/login|POST|Đăng nhập tài khoản|x|
|8|/account/forgetpassword|POST|Quên mật khẩu|x|
|9|/account/checkpasswordtemp|POST|Kiểm tra mật khẩu tạm|x|
|10|/account/infouser/[{id}]|GET|Lấy thông tin User|x|
|11|/account/infouser|PUT|Chỉnh sửa thông tin User|x|
|12|/account/updatepassword|PUT|Cập nhật lại mật khẩu|x|
|13|/users|GET|Lấy thông tin toàn bộ User|x|
|14|/users/search/[{name}]|GET|Tìm kiếm User theo tên|x|
|15|/tags|GET|Lấy danh sách Thẻ|x|
|16|/tag/[{id}]|GET|Lấy thông tin thẻ theo id|x|
|17|/tags|PUT|Cập nhật thẻ theo id|x|
|18|/tag/[{id}]|PUT|Cập nhật thẻ theo id|x|
|19|/article/[{id}]|GET||x|
|20|/articles/search/[{title}]|GET||x|
|21|/article|POST||x|
|22|/article/[{id}]|DELETE||x|
|23|/article/[{id}]|PUT||x|
|24|/uploadphoto|POST||x|
|25|/uploadfile|POST||x|
|26|/companies|GET||x|
|27|/company/[{id}]|GET||x|
|28|/company|POST||x|
|29|/company/[{id}]|PUT||x|
|30|/company/[{id}]|DELETE||x|
|31|/company/search/[{name}]|GET||x|
|32|/temp/companies|GET||x|
|33|/temp/company/[{id}]|GET||x|
|34|/temp/company|POST||x|
|35|/temp/company/[{id}]|PUT||x|
|36|/temp/company/[{id}]|DELETE||x|
|37|/addresses|GET||x|
|38|/address/[{id}]|GET||x|
|39|/address|POST||x|
|40|/address/[{id}]|PUT||x|
|41|/address/[{id}]|DELETE||x|
|42|/address/search/province/[{key}]|GET||x|
|43|/address/search/city/[{key}]|GET||x|
|44|/address/search/street/[{key}]|GET||x|
|45|/address/search/building/[{key}]|GET||x|
|46|/bankaccounts|GET||x|
|47|/bankaccount/[{id}]|GET||x|
|48|/bankaccount|POST||x|
|49|/bankaccount/[{id}]|PUT||x|
|50|/bankaccount/[{id}]|DELETE||x|
|51|/temp/users|GET||x|
|52|/temp/user/[{id}]|GET||x|
|53|/temp/user|POST||x|
|54|/temp/user/[{id}]|PUT||x|
|55|/temp/user/[{id}]|DELETE||x|
|56|/temp/user/checkpassword|POST||x|
|57|/temp/user/checkexistuser|POST||x|
|58|/companysettings|GET||x|
|59|/companysetting/[{id}]|GET||x|
|60|/companysurveys/[{id}]|GET||x|
|61|/companysetting|POST||x|
|62|/companysetting/[{id}]|PUT||x|
|63|/companysetting/[{id}]|DELETE||x|
|64|/creditapprovallogs|GET||x|
|65|/creditapprovallog/[{id}]|GET||x|
|66|/creditapprovallog|POST||x|
|67|/creditapprovallog/[{id}]|DELETE||x|
|68|/surveys|GET||x|
|69|/survey/[{id}]|GET||x|
|70|/survey|POST||x|
|71|/survey/[{id}]|PUT||x|
|72|/survey/updatestatus/[{id}]|PUT||x|
|73|/survey/[{id}]|DELETE||x|
|74|/survey/sendemail|POST||x|
|75|/applicant/totalsurvey|POST||x|
|76|/applicant/detailssurvey|POST||x|
|77|/totalsurvey|POST||x|
|78|/detailssurvey|POST||x|
|79|/totalsurveybystatus|POST||x|
|80|/detailssurveybystatus|POST||x|
|81|/permissionsurvey|POST||x|
|82|/checksurvey/[{id}]|GET||x|
|83|/surveymaps|POST||x|
|84|/totalsurveymap|POST||x|
|85|/surveychats|GET||x|
|86|/surveychat|POST||x|
|87|/chats|GET||x|
|88|/chat|POST||x|
|89|/commentsurveys|GET||x|
|90|/commentsurvey|POST||x|
|91|/commentsurvey/[{id}]|PUT||x|
|92|/commentsurvey/[{id}]|DELETE||x|
|93|/surveyinfo/[{id}]|GET||x|
|94|/statussurveyinfo/[{id}]|GET||x|
|95|/surveyinfo|POST||x|
|96|/surveyinfo/[{id}]|PUT||x|
|97|/surveyinfo/[{id}]|DELETE||x|
|98|/totalnotifyinbox|POST||x|
|99|/detailnotifyinbox|POST||x|
|100|/groundsurveyreport/[{id}]|GET||x|
|101|/groundsurveyreport1and2/[{id}]|GET||x|
|102|/groundsurveyreport1and2|POST||x|
|103|/groundsurveyreport1and2/[{id}]|PUT||x|
|104|/groundsurveyreport4/[{id}]|GET||x|
|105|/groundsurveyreport4|POST||x|
|106|/groundsurveyreport4/[{id}]|PUT||x|
|107|/groundsurveyreport5/[{id}]|GET||x|
|108|/groundsurveyreport5|POST||x|
|109|/groundsurveyreport5/[{id}]|PUT||x|
|110|/groundsurveyreport6/[{id}]|GET||x|
|111|/groundsurveyreport6|POST||x|
|112|/groundsurveyreport6/[{id}]|PUT||x|
|113|/groundsurveyreport7/[{id}]|GET||x|
|114|/groundsurveyreport7|POST||x|
|115|/groundsurveyreport7/[{id}]|PUT||x|
|116|/groundsurveyreport8to12/[{id}]|GET||x|
|117|/groundsurveyreport13/[{id}]|GET||x|
|118|/groundsurveyreport14_1/[{id}]|GET||x|
|119|/groundsurveyreport14_1|POST||x|
|120|/groundsurveyreport14_1/[{id}]|PUT||x|
|121|/groundsurveyreport14_2/[{id}]|GET||x|
|122|/groundsurveyreport14_2|POST||x|
|123|/groundsurveyreport14_2/[{id}]|PUT||x|
|124|/groundsurveyreport14_3/[{id}]|GET||x|
|125|/groundsurveyreport14_3|POST||x|
|126|/groundsurveyreport14_3/[{id}]|PUT||x|
|127|/groundsurveyreport14_4/[{id}]|GET||x|
|128|/groundsurveyreport14_4|POST||x|
|129|/groundsurveyreport14_4/[{id}]|PUT||x|
|130|/groundsurveyreport5/[{id}]|GET||x|
|131|/groundsurveyreport5|POST||x|
|132|/groundsurveyreport5/[{id}]|PUT||x|
|133|/groundsurveyreport6/[{id}]|GET||x|
|134|/groundsurveyreport6|POST||x|
|135|/groundsurveyreport6/[{id}]|PUT||x|
|136|/groundsurveyreport7/[{id}]|GET||x|
|137|/groundsurveyreport7|POST||x|
|138|/groundsurveyreport7/[{id}]|PUT||x|
|139|/groundsurveyreport8to12/[{id}]|GET||x|
|140|/groundsurveyreport13/[{id}]|GET||x|
|141|/groundsurveyreport14_1/[{id}]|GET||x|
|142|/groundsurveyreport14_1|POST||x|
|143|/groundsurveyreport14_1/[{id}]|PUT||x|
|144|/groundsurveyreport14_2/[{id}]|GET||x|
|145|/groundsurveyreport14_2|POST||x|
|146|/groundsurveyreport14_2/[{id}]|PUT||x|
|147|/groundsurveyreport14_3/[{id}]|GET||x|
|148|/groundsurveyreport14_3|POST||x|
|149|/groundsurveyreport14_3/[{id}]|PUT||x|
|150|/groundsurveyreport14_4/[{id}]|GET||x|
|151|/groundsurveyreport14_4|POST||x|
|152|/groundsurveyreport14_4/[{id}]|PUT||x|
|153|/judgement/[{id}]|GET||x|
|154|/judgement|POST||x|
|155|/judgement/[{id}]|PUT||x|
|156|/constructionplan/[{id}]|GET||x|
|157|/constructionplan|POST||x|
|158|/constructionplan/[{id}]|PUT||x|
|159|/profile/[{id}]|GET||x|
|160|/profile|POST||x|
|161|/profile/[{id}]|PUT||x|
|162|/costbalance/[{id}]|GET||x|
|163|/costbalancefilters/[{id}]|GET||x|
|164|/costbalancefilter/[{id}]|GET||x|
|165|/costbalancefilter|POST||x|
|166|/executesqlcostbalance|POST||x|
|167|/costbalancefilter/[{id}]|PUT||x|
|168|/costbalancefilter/[{id}]|DELETE||x|
|169|/security/[{id}]|GET|Lấy thông tin thiết bị đăng nhập theo id|x|
|170|/security|POST|Thêm 1 thiết bị đăng nhập|x|
|171|/checksecurity|POST|Kiểm tra tồn tại thiết bị trong CSDL|x|
|172|/checkexistsecurity|POST|Kiểm tra tồn tài thiết bị đang đăng nhập|x|
|173|/checkcodelogin|POST|Kiểm tra Code đăng nhập|x|
|174|/updatedevice|PUT|Cập nhật thông tin thiết bị đăng nhập|x|
|175|/security/[{id}]|DELETE|Xóa thiết bị đăng nhập bởi id|x|
|176|/deletesecuritybyemail|DELETE|Xóa ds các thiết đăng nhập bị bởi email|x|

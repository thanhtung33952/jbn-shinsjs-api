<?php

use Slim\Http\Request;
use Slim\Http\Response;


//*************** Begin API Common *********************
// API get address from zipcode
$app->get('/zipaddress/[{zipcode}]', 'CommonController:zipaddress');

//API download file
$app->get('/download/[{filename}]', 'CommonController:downloadFile');

// get token
$app->post("/token",  'CommonController:getToken');

// API upload file
$app->post('/common/uploadfile', 'CommonController:uploadfile');

// API upload photo
$app->post('/common/uploadphoto', 'CommonController:uploadphoto');
//*************** End API Common *********************

//*************** Begin API Account *********************
$app->group('/account', function () use ($app) {
    // API register
    $app->post('/register', 'AccountController:register');

    // API login
    $app->post('/login', 'AccountController:login');

    // API forget password
    $app->post('/forgetpassword', 'AccountController:forgetpassword');

    // check password temp
    $app->post('/checkpasswordtemp', 'AccountController:checkPasswordTemp');

    //Get info user by id
    $app->get('/infouser/[{id}]', 'AccountController:getUserById');

    // API update info user
    $app->put('/infouser', 'AccountController:updateInfoUser');

    // API update password
    $app->put('/updatepassword', 'AccountController:updatePassword');
});

//api getAllUser
$app->get('/users', 'AccountController:getAllUser');

// Search user with name
$app->get('/users/search/[{name}]', 'AccountController:seachUsersWithName');

//*************** End API Account *********************

//*************** Begin API Article *********************
//Get all tag
$app->get('/tags', 'ArticleController:getAllTags');

//Get all title by tag
$app->get('/tag/[{id}]', 'ArticleController:getAllTitleByTagId');

// Update tags 
$app->put('/tags', 'ArticleController:updateTags');

// Update tag by id
$app->put('/tag/[{id}]', 'ArticleController:updateTagByTagId');

//Get article by article id
$app->get('/article/[{id}]', 'ArticleController:getArticleByArticleId');

// Search articles with title name
$app->get('/articles/search/[{title}]', 'ArticleController:seachArticlesWithTitle');

// Add a new title
$app->post('/article', 'ArticleController:addNewTitle');

// delete a article with given id
$app->delete('/article/[{id}]', 'ArticleController:deleteArticleByArticleId');

// Update tb_article_details with articleId
$app->put('/article/[{id}]', 'ArticleController:updateArticle');

// API upload photo
$app->post('/uploadphoto', 'ArticleController:uploadphoto');

// API upload file
$app->post('/uploadfile', 'ArticleController:uploadfile');

// //Get history by id article
// $app->get('/history/[{id}]', 'ArticleController:getHistoryWithId');
//*************** End API Article *********************


//*************** Begin API Company *********************
//Get all company
$app->get('/companies', 'CompanyController:getAllCompany');

//Get company by companyId
$app->get('/company/[{id}]', 'CompanyController:getCompanyByCompanyId');

// Add a new company
$app->post('/company', 'CompanyController:addNewCompany');

// Update company with companyId
$app->put('/company/[{id}]', 'CompanyController:updateCompanyWithCompanyId');

// delete a company with companyId
$app->delete('/company/[{id}]', 'CompanyController:deleteCompanyWithCompanyId');

// Search company with name
$app->get('/company/search/[{name}]', 'CompanyController:seachCompanyWithName');
//*************** End API Company *********************


//*************** Begin API CompanyTemp *********************
$app->group('/temp', function () use ($app) {
    //Get all company
    $app->get('/companies', 'CompanyTempController:getAllCompany');

    //Get company by companyId
    $app->get('/company/[{id}]', 'CompanyTempController:getCompanyByCompanyId');

    // Add a new company
    $app->post('/company', 'CompanyTempController:addNewCompany');

    // Update company with companyId
    $app->put('/company/[{id}]', 'CompanyTempController:updateCompanyWithCompanyId');

    // delete a company with companyId
    $app->delete('/company/[{id}]', 'CompanyTempController:deleteCompanyWithCompanyId');
});
//*************** End API CompanyTemp *********************


//*************** Begin API Address *********************
//Get all address
$app->get('/addresses', 'AddressController:getAllAddress');

//Get address by addressId
$app->get('/address/[{id}]', 'AddressController:getAddressByAddressId' );

// Add a new address
$app->post('/address', 'AddressController:addNewAddress' );

// Update address with addressId
$app->put('/address/[{id}]', 'AddressController:updateAddressWithAddressId' );

// delete a address with addressId
$app->delete('/address/[{id}]', 'AddressController:deleteAddressWithAddressId' );

// Search province with key
$app->get('/address/search/province/[{key}]', 'AddressController:seachProvinceWithKey');

// Search city with key
$app->get('/address/search/city/[{key}]', 'AddressController:seachCityWithKey');

// Search street with key
$app->get('/address/search/street/[{key}]', 'AddressController:seachStreetWithKey');

// Search building with key
$app->get('/address/search/building/[{key}]', 'AddressController:seachBuildingWithKey');

//*************** End API Address *********************


//*************** Begin API BankAccount *********************
//Get all bankaccount
$app->get('/bankaccounts', 'BankAccountController:getAllBankAccount');

//Get bankaccount by Id
$app->get('/bankaccount/[{id}]', 'BankAccountController:getBankAccountById' );

// Add a new bankaccount
$app->post('/bankaccount', 'BankAccountController:addNewBankAccount' );

// Update bankaccount with Id
$app->put('/bankaccount/[{id}]', 'BankAccountController:updateBankAccountWithId' );

// delete a bankaccount with Id
$app->delete('/bankaccount/[{id}]', 'BankAccountController:deleteBankAccountWithId' );
//*************** End API BankAccount *********************


//*************** Begin API User Temp *********************
$app->group('/temp', function () use ($app) {
    //Get all user
    $app->get('/users', 'UserTempController:getAllUser');

    //Get User by userId
    $app->get('/user/[{id}]', 'UserTempController:getUserByUserId');

    // Add a new user
    $app->post('/user', 'UserTempController:addNewUser');

    // Update user with userId
    $app->put('/user/[{id}]', 'UserTempController:updateUserWithUserId');

    // delete a user with userId
    $app->delete('/user/[{id}]', 'UserTempController:deleteUserWithUserId');

    // check password user
    $app->post('/user/checkpassword', 'UserTempController:checkPassword');

    // check password user
    $app->post('/user/checkexistuser', 'UserTempController:checkExistUserTemp');
});
//*************** End API Address *********************


//*************** Begin API Company Setting *********************
//Get all companysetting
$app->get('/companysettings', 'CompanySettingController:getAllCompanySetting');

//Get companysetting by companyId
$app->get('/companysetting/[{id}]', 'CompanySettingController:getCompanySettingByCompanyId');

//Get companysurveys by companyId
$app->get('/companysurveys/[{id}]', 'CompanySettingController:getCompanySurveysByCompanyId');

// Add a new companysetting
$app->post('/companysetting', 'CompanySettingController:addNewCompanySetting');

// Update companysetting with companyId
$app->put('/companysetting/[{id}]', 'CompanySettingController:updateCompanySettingWithCompanyId');

// delete a companysetting with companyId
$app->delete('/companysetting/[{id}]', 'CompanySettingController:deleteCompanySettingWithCompanyId');
//*************** End API Company Setting *********************


//*************** Begin API credit approval log *********************
//Get all creditapprovallog
$app->get('/creditapprovallogs', 'CreditApprovalLogController:getAllCreditApprovalLog');

//Get creditapprovallog by companyId
$app->get('/creditapprovallog/[{id}]', 'CreditApprovalLogController:getCreditApprovalLogByCompanyId');

// Add a new creditapprovallog
$app->post('/creditapprovallog', 'CreditApprovalLogController:addNewCreditApprovalLog');

// // Update creditapprovallog with companyId
// $app->put('/companysetting/[{id}]', 'CreditApprovalLogController:updateCreditApprovalLogWithCompanyId');

// delete a creditapprovallog with companyId
$app->delete('/creditapprovallog/[{id}]', 'CreditApprovalLogController:deleteCreditApprovalLogWithCompanyId');
//*************** End API credit approval log *********************

//*************** Begin API Survey *********************
//Get all Survey
$app->get('/surveys', 'SurveyController:getAllSurvey');

//Get Survey by Id
$app->get('/survey/[{id}]', 'SurveyController:getSurveyById');

// Add a new Survey
$app->post('/survey', 'SurveyController:addNewSurvey');

// Update Survey with Id
$app->put('/survey/[{id}]', 'SurveyController:updateSurveyWithId');

// Update status Survey with Id
$app->put('/survey/updatestatus/[{id}]', 'SurveyController:updateStatusSurveyWithId');

// delete a Survey with Id
$app->delete('/survey/[{id}]', 'SurveyController:deleteSurveyWithId');

// API send email survey
$app->post('/survey/sendemail', 'SurveyController:sendMailSurvey');

//Get total survey by status
$app->post('/applicant/totalsurvey', 'SurveyController:totalSuveyByStatus');

//Get details survey by status
$app->post('/applicant/detailssurvey', 'SurveyController:detailSuveyByStatus');

//Get total survey by status
$app->post('/totalsurvey', 'SurveyController:totalSuveyByStatus1');

//Get details survey by status
$app->post('/detailssurvey', 'SurveyController:detailSuveyByStatus1');

//Get total survey by status
$app->post('/totalsurveybystatus', 'SurveyController:totalSuveyByStatusEq1');

//Get details survey by status
$app->post('/detailssurveybystatus', 'SurveyController:detailSuveyByStatusEq1');

//Get permission survey by id + userID
$app->post('/permissionsurvey', 'SurveyController:getPermissionByUserId');

//check exists Survey by Id
$app->get('/checksurvey/[{id}]', 'SurveyController:checkSurveyById');

//Get all Survey map
$app->post('/surveymaps', 'SurveyController:getAllSurveyMap');

//Get total survey map
$app->post('/totalsurveymap', 'SurveyController:totalSuveyMap');

//Get all Survey chat
$app->get('/surveychats', 'SurveyChatController:getAllMessage');

// Add a new Message
$app->post('/surveychat', 'SurveyChatController:addNewMessage');
//*************** End API Survey *********************

//*************** Begin API History Chat *********************
//Get all Survey
$app->get('/chats', 'HistoryChatController:getAllMessage');

// Add a new Message
$app->post('/chat', 'HistoryChatController:addNewMessage');

//*************** End API History Chat *********************


//*************** Begin API Comment survey *********************
//Get all Comment Survey
$app->get('/commentsurveys', 'CommentSurveyController:getAllComment');

// Add a new Comment Survey
$app->post('/commentsurvey', 'CommentSurveyController:addNewComment');

// Update Comment with Id
$app->put('/commentsurvey/[{id}]', 'CommentSurveyController:updateCommentWithId');

// delete a Comment Survey with Id
$app->delete('/commentsurvey/[{id}]', 'CommentSurveyController:deleteComment');
//*************** End API Comment survey *********************


//*************** Begin API survey info *********************
//Get survey info
$app->get('/surveyinfo/[{id}]', 'SurveyInfoController:getSurveyInfoById');

//Get status survey info
$app->get('/statussurveyinfo/[{id}]', 'SurveyInfoController:getStatusSurveyInfoById');

// Add a new survey info
$app->post('/surveyinfo', 'SurveyInfoController:addNewSurveyInfo');

// Update survey info with Id
$app->put('/surveyinfo/[{id}]', 'SurveyInfoController:updateSurveyInfoWithId');

// delete a survey info with Id
$app->delete('/surveyinfo/[{id}]', 'SurveyInfoController:deleteSurveyInfoWithId');
//*************** End API survey info *********************

//*************** Begin API Notify Inbox *********************
//Get all Notify Inbox
$app->post('/totalnotifyinbox', 'NotifyInboxController:totalNotifyInbox');

//Get all Notify Inbox
$app->post('/detailnotifyinbox', 'NotifyInboxController:detailNotifyInbox');

//*************** End API Notify Inbox *********************

//*************** Begin API GroundSurveyReport *********************
//Get GroundSurveyReport
$app->get('/groundsurveyreport/[{id}]', 'GroundSurveyReportController:getGroundSurveyReportById');

//Get GroundSurveyReport
$app->get('/groundsurveyreport1and2/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport1And2ById');

// Add a new GroundSurveyReport
$app->post('/groundsurveyreport1and2', 'GroundSurveyReportController:addNewGroundSurveyReport1And2');

// Update GroundSurveyReport with Id
$app->put('/groundsurveyreport1and2/[{id}]', 'GroundSurveyReportController:updateGroundSurveyReport1And2WithId');


//Get GroundSurveyReport
$app->get('/groundsurveyreport4/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport4ById');

// Add a new GroundSurveyReport
$app->post('/groundsurveyreport4', 'GroundSurveyReportController:addNewGroundSurveyReport4');

// Update GroundSurveyReport with Id
$app->put('/groundsurveyreport4/[{id}]', 'GroundSurveyReportController:updateGroundSurveyReport4WithId');


//Get GroundSurveyReport
$app->get('/groundsurveyreport5/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport5ById');

// Add a new GroundSurveyReport
$app->post('/groundsurveyreport5', 'GroundSurveyReportController:addNewGroundSurveyReport5');

// Update GroundSurveyReport with Id
$app->put('/groundsurveyreport5/[{id}]', 'GroundSurveyReportController:updateGroundSurveyReport5WithId');


//Get GroundSurveyReport
$app->get('/groundsurveyreport6/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport6ById');

// Add a new GroundSurveyReport
$app->post('/groundsurveyreport6', 'GroundSurveyReportController:addNewGroundSurveyReport6');

// Update GroundSurveyReport with Id
$app->put('/groundsurveyreport6/[{id}]', 'GroundSurveyReportController:updateGroundSurveyReport6WithId');


//Get GroundSurveyReport
$app->get('/groundsurveyreport7/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport7ById');

// Add a new GroundSurveyReport
$app->post('/groundsurveyreport7', 'GroundSurveyReportController:addNewGroundSurveyReport7');

// Update GroundSurveyReport with Id
$app->put('/groundsurveyreport7/[{id}]', 'GroundSurveyReportController:updateGroundSurveyReport7WithId');

//Get GroundSurveyReport
$app->get('/groundsurveyreport8to12/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport8ById');

//Get GroundSurveyReport
$app->get('/groundsurveyreport13/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport13ById');

//Get GroundSurveyReport
$app->get('/groundsurveyreport14/[{id}]', 'GroundSurveyReportController:getGroundSurveyReport14ById');

// Add a new GroundSurveyReport
$app->post('/groundsurveyreport14', 'GroundSurveyReportController:addNewGroundSurveyReport14');

// Update GroundSurveyReport with Id
$app->put('/groundsurveyreport14/[{id}]', 'GroundSurveyReportController:updateGroundSurveyReport14WithId');
//*************** End API GroundSurveyReport *********************


//*************** Begin API Judgement *********************
//Get Judgement
$app->get('/judgement/[{id}]', 'JudgementController:getJudgementById');

// Add a new Judgement
$app->post('/judgement', 'JudgementController:addNewJudgement');

// Update Judgement with Id
$app->put('/judgement/[{id}]', 'JudgementController:updateJudgementWithId');
//*************** End API Judgement *********************


//*************** Begin API ConstructionPlan *********************
//Get ConstructionPlan
$app->get('/constructionplan/[{id}]', 'ConstructionPlanController:getConstructionPlanById');

// Add a new ConstructionPlan
$app->post('/constructionplan', 'ConstructionPlanController:addNewConstructionPlan');

// Update ConstructionPlan with Id
$app->put('/constructionplan/[{id}]', 'ConstructionPlanController:updateConstructionPlanWithId');
//*************** End API ConstructionPlan *********************


//*************** Begin API Profile *********************
//Get Profile
$app->get('/profile/[{id}]', 'ProfileController:getProfileById');

// Add a new Profile
$app->post('/profile', 'ProfileController:addNewProfile');

// Update Profile with Id
$app->put('/profile/[{id}]', 'ProfileController:updateProfileWithId');
//*************** End API Profile *********************

//*************** Begin API Cost Balance *********************
//Get Cost Balance
$app->get('/costbalance', 'CostBalanceController:getCostBalanceById');

//Get costbalancefilter by userId
$app->get('/costbalancefilter/[{id}]', 'CostBalanceController:getCostBalanceFilterByUserId');

// Add a new costbalancefilter
$app->post('/costbalancefilter', 'CostBalanceController:addNewCostBalanceFilter');

// Execute sql cost balance
$app->post('/executesqlcostbalance', 'CostBalanceController:checkExecuteSqlCostBalance');

// update costbalancefilter
$app->put('/costbalancefilter/[{id}]', 'CostBalanceController:updateNewCostBalanceFilter');

// delete a costbalancefilter with Id
$app->delete('/costbalancefilter/[{id}]', 'CostBalanceController:deleteCostBalanceFilterWithId');
//*************** End API Cost Balance *********************

//*************** Begin API Security *********************
// Add a new security
$app->post('/security', 'SecurityController:addNewSecurity');

// Update Profile with Id
$app->post('/checksecurity', 'SecurityController:checkSecurity');

// API update device
$app->put('/updatedevice', 'SecurityController:updateDevice');
//*************** End API Security *********************
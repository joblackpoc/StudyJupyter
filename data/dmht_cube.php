<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=dmhtcube.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('รหัสสถานบริการ'
,'ชื่อสถานบริการ'
,'ประเภทสถานบริการ'
,'PID'
,'CID'
,'ชื่อสกุล'
,'ที่อยู่'
,'ปี'
,'วันเกิด'
,'อายุ'
,'กลุ่มอายุ'
,'เพศ'
,'ตำบล'
,'หมู่ที่'
,'ขึ้นทะเบียนผู้ป่วยความดันสูง'
,'ความดันสุง'
,'ควาดันสูงรายใหม่'
,'วันวินิจฉัยความดันสูง'
,'systolic'
,'diastolic'
,'ผลวามดัน'
,'ยังไม่ขึ้นทะเบียนเบาหวาน'
,'เบาหวาน'
,'เบาหวานรายใหม่'
,'วันวินิฉัยเบาหวาน'
,'วันคัดกรองเบาหวาน'
,'น้ำตาล'
,'ผลเบาหวาน'
,'HT_EYE'
,'HT_KIDNEY'
,'HT_HEART'
,'HT_BRAIN'
,'HT_FOOT'
,'HT_OTHER'
,'DM_EYE'
,'DM_KIDNEY'
,'DM_HEART'
,'DM_BRAIN'
,'DM_FOOT'
,'DM_OTHER'));

// fetch the data
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bireport";
$dbc = mysql_connect($dbhost,$dbuser,$dbpass)or die ("Cannot Connect Mysql") ;
$dbs = mysql_select_db($dbname)or die ("Cannot Connect Db");
mysql_db_query($dbname,"SET NAMES UTF8");
$rows = mysql_query("SELECT 
HOSPCODE as 'รหัสสถานบริการ'
,HOSPNAME as 'ชื่อสถานบริการ'
,HOSPTYPENAME as 'ประเภทสถานบริการ'
,PID
,CID
,NAME AS 'ชื่อสุกล'
,ADDRESS as 'ที่อยู่'
,YEAR_RPT as 'ปี'
,BIRTH as 'วันเกิด'
,AGE as 'อายุ'
,CASE WHEN AGE BETWEEN 0 AND 14 THEN '0 - 14'
			WHEN AGE BETWEEN 15 AND 35 THEN '15 - 35'
			WHEN AGE BETWEEN 36 AND 60 THEN '35 - 60'
			WHEN AGE BETWEEN 61 AND 100 THEN  '61 - 100'
	ELSE '100+' END as 'กลุ่มอายุ'
,CASE WHEN SEX = 1 THEN 'ชาย' WHEN SEX = 2 THEN 'หญิง' ELSE 'error' END as 'เพศ'
,TAMBON as 'ตำบล'
,VILLAGE_ID AS 'หมู่ที่'
,IS_HT_NON_REGISTER AS 'ขึ้นทะเบียนผู้ป่วยความดันสูง'
,IS_HT as 'ความดันสุง'
,IS_HT_FIRST as 'ความดันสูงรายใหม่'
,DATE_DIAG_HT as 'วันวินิจฉัยความดันสูง' 
,HT_SBP as 'systolic'
,HT_DBP as 'diastolic'
,CASE WHEN HT_RESULT = 1 THEN 'ปกติ'
			WHEN HT_RESULT = 2 THEN 'เสี่ยง'
			WHEN HT_RESULT = 3 THEN 'สูง'
			ELSE 'no' END as 'ผลวามดัน'
,IS_DM_NON_REGISTER AS 'ยังไม่ขึ้นทะเบียนเบาหวาน'
,IS_DM AS 'เบาหวาน'
,IS_DM_FIRST as 'เบาหวานรายใหม่'
,DATE_DIAG_DM AS 'วันวินิฉัยเบาหวาน'
,DATE_SCREEN_DM AS 'วันคัดกรองเบาหวาน'
,CASE WHEN BSLEVEL IS NOT null THEN BSLEVEL ELSE 0 END  AS 'น้ำตาล'
,CASE WHEN DM_RESULT = 1 THEN 'ปกติ'
			WHEN DM_RESULT = 2 THEN 'เสี่ยง'
			WHEN DM_RESULT = 3 THEN 'สูง'
			ELSE 'no' END as 'ผลเบาหวาน'
,CASE WHEN HT_COM_EYE is not null THEN 'Y' ELSE 'N' END AS 'HT_EYE'
,CASE WHEN HT_COM_KIDNEY IS NOT NULL THEN 'Y' ELSE 'N' END AS 'HT_KIDNEY'
,CASE WHEN HT_COM_HEART IS NOT NULL      THEN 'Y' ELSE 'N' END AS 'HT_HEART'
,CASE WHEN HT_COM_BRAIN IS NOT NULL THEN 'Y' ELSE 'N' END AS 'HT_BRAIN'
,CASE WHEN HT_COM_FOOT IS NOT NULL THEN 'Y' ELSE 'N' END AS 'HT_FOOT'
,CASE WHEN HT_COM_OTHER IS NOT NULL THEN 'Y' ELSE 'N' END AS 'HT_OTHER'
,CASE WHEN DM_COM_EYE IS NOT NULL THEN 'Y' ELSE 'N' END AS 'DM_EYE'
,CASE WHEN DM_COM_KIDNEY IS NOT NULL THEN 'Y' ELSE 'N' END AS 'DM_KIDNEY'
,CASE WHEN DM_COM_HEART IS NOT NULL THEN 'Y' ELSE 'N' END AS 'DM_HEART'
,CASE WHEN DM_COM_BRAIN IS NOT NULL THEN 'Y' ELSE 'N' END AS 'DM_BRAIN'
,CASE WHEN DM_COM_FOOT IS NOT NULL THEN 'Y' ELSE 'N' END AS 'DM_FOOT'
,CASE WHEN DM_COM_OTHER IS NOT NULL THEN 'Y' ELSE 'N' END AS 'DM_OTHER' FROM mas_person_onerecord_chronic");
 

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>
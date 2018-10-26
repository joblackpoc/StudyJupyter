# Study Jupyter by Natthawut Ponkrut Joblackpoc 12-10-2018

case study about data_exchange from HDC database

1. Install anaconda from www.anaconda.com
2. Update anaconda -> conda update --all
3. Upgrade python pip -> python -m pip install --upgrade pip
4. Install pivottablejs -> 
	4.1 pip install pivottablejs 
	4.2 conda install pivottablejs
5. Install package -> Open Anaconda Navigator
	install package - matplotlib, numpy, pandas, pivottable
6. Install pymysql -> conda install -c anaconda pymysql

# Mysql connection
	import os
	import pymysql
	import pandas as pd
	
	host = os.getenv('Mysql_host')
	port = os.getenv('Mysql_port')
	user = os.getenv('Mysql_user')
	password = os.getenv('Mysql_password')
	database = os.getenv('Mysql_database')
	
	conn = pymysql.connect(
			host = host,
			port = int(3306),
			user = "root",
			passwd = "",
			db = "typearea_4",
			chaset = "utf8mb4"
			)
	df = pd.read_sql_query("select * from typearea_4", conn)
	df.tail(10)
	
7. Read csv file
	import pandas as pd
	df = pd.read_csv('data/typearea_4.csv')
	df.head()

8. pivot_ui
	import pandas as pd
	df = pd.read_csv('data/QueryTypearea_4JOIN.csv')
	from pivottablejs import pivot_ui
	pivot_ui(df)
	right click pop_out open in new tab

9. Past folder rdc_report in htdocs
	http://localhost/rdc_report

# Please Clear person typearea_4 from your database soon
We will support you when we follow up 


# See you next time
Thank you Good Luck

Natthawut Ponkrut : Joblackpoc@gmail.com

from selenium import webdriver
import time
from bs4 import BeautifulSoup
import json
import csv

chorme = "C:\\extChrome\\chromedriver.exe"
driver = webdriver.Chrome(chorme)
x = driver.get("https://db2e44a32048cb4c9c15151e7f56b3e5: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@tungkthd.myshopify.com/admin/api/2021-07/customers.json")
filename = ["id","first_name","last_name","email","phone","updated_at","verified_email"]
soup = BeautifulSoup(driver.page_source)

dict_from_json = json.loads(soup.find("body").text)
print(json.dumps(dict_from_json, indent=4, sort_keys=True))
# for i in dict_from_json['customers']:
#     print(i['id'])
rows = dict_from_json['customers']
a =[]
with open("bai3.csv","w+",encoding='UTF8', newline='') as f:
    writer = csv.writer(f)
    writer.writerow(filename)
    for i in rows:
        a.append(i['id'])
        a.append(i['first_name'])
        a.append(i['last_name'])
        a.append(i['email'])
        a.append(i['phone'])
        a.append(i['updated_at'])
        a.append(i['verified_email'])
        writer.writerow(a)
        a = []
f.close()
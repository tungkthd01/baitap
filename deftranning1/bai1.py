from pyquery import PyQuery
import requests
from selenium import webdriver
import time
from bs4 import BeautifulSoup

def byRequest():
    session = requests.session()


    url = 'http://45.79.43.178/source_carts/wordpress/wp-login.php'
    payload = {
        "log": "admin",
        "pwd": "123456aA"
        }
    #r = requests.post(url,data = payload)
    r = session.post('http://45.79.43.178/source_carts/wordpress/wp-login.php', data=payload)
    SteamStatus =  BeautifulSoup(r.text, 'html.parser')
    x = SteamStatus.find("span", {"class": "display-name"})
    print("ten nguoi dung:",x.text)
    # x = session.cookies.get_dict()
    # print(x)
    # k = "wordpress_logged_in"
    # for i in x.keys():
    #     if i.find(k) >= 0:
    #         y = x[i].split("%")[0]
    # print(y)
#
def bySelenium():
    chorme = "C:\\extChrome\\chromedriver.exe"
    driver = webdriver.Chrome(chorme)
    driver.get("http://45.79.43.178/source_carts/wordpress/wp-login.php")
    username = driver.find_element_by_id("user_login")
    #print("username:",username.text)
    username.send_keys("admin")
    password = driver.find_element_by_id("user_pass")
    password.send_keys("123456aA")
    driver.find_element_by_id("wp-submit").submit()
    name = driver.find_element_by_class_name('display-name')
    print(name.text)
#bySelenium()
byRequest()
from pyquery import PyQuery
import requests
from selenium import webdriver
import time
def byRequest():
    session = requests.session()


    url = 'http://45.79.43.178/source_carts/wordpress/wp-login.php'
    payload = {
        "log": "admin",
        "pwd": "123456aA"
        }
    #r = requests.post(url,data = payload)
    r = session.post('http://45.79.43.178/source_carts/wordpress/wp-login.php', data=payload)
    print(r.text)
    x = session.cookies.get_dict()
    y = x['wordpress_logged_in_9b3f1ac684a4401c524e27c6c40e95d5'].split("%")[0]
    print(y)
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
bySelenium()
#byRequest()
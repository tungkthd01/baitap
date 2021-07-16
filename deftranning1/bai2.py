import mysql.connector
import csv
import datetime
def connectData():
    conection = mysql.connector.connect(host='localhost',
                               user='root',
                               password='',                            
                                db='customer')
    if (conection):
        print("connection Successul")
    else:
        print("connection Fail")
    cursor1 = conection.cursor()
    string = "create table if  not exists khachhang (\
        customerid int primary key auto_increment,\
        firstname varchar(200),\
        lastname varchar(150),\
        companyname varchar(150),\
        billingaddress1 varchar(150),\
        billingaddress2 varchar(150),\
        city varchar(150),\
        state varchar(150),\
        postalcode int,\
        country varchar(150),\
        phonenumber varchar(150),\
        emailaddress varchar(150),\
        createddate  date)"
    x = cursor1.execute(string)
    conection.commit()
    cursor1.close() 
#connectData()
def readfileCsv(path):
    a = []
    query = []
    with open(path) as csvfile:
        data = csv.reader(csvfile)
        
        for i in data:
            a.append(i)
    a.pop(0)
    for i in a:
        string = 'insert into khachhang (customerid, firstname, lastname, companyname, billingaddress1,billingaddress2,city, state, postalcode, country, phonenumber, emailaddress, createddate) \
                value("{}","{}","{}","{}","{}","{}","{}","{}","{}","{}","{}","{}","{}")'.format(*i)
        query.append(string)
    return query

def InsertData(query):
    conection = mysql.connector.connect(host='localhost',
                               user='root',
                               password='',                            
                                db='customer')
    if (conection):
        print("connection Successul")
    else:
        print("connection Fail")

    cursor1 = conection.cursor()
    for i in query:
        x = cursor1.execute(i)
    conection.commit()
    cursor1.close()
    
if __name__ == '__main__':
    path = "A:\\liteextensi\\deftranning\\customer.csv"
    string = readfileCsv(path)
    InsertData(string)

import pymysql
import selenium
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.common.exceptions import NoSuchElementException

# Begin Database
host = "localhost"
user = "root"
password = ""
db = "db_clickbait"

conn = pymysql.connect(host, user, password, db)
cursor = conn.cursor()
# End Database

# Begin Selenium
browser = webdriver.Chrome()
browser.get('http://www.tribunnews.com/tag/malang')

def getData():
    judulLinks = browser.find_elements_by_css_selector('.mr140>h3>a')
    for judulLink in judulLinks :
        judul = judulLink.text
        sql = "INSERT INTO document (document) VALUES (%s)"
        cursor.execute(sql, (judul))
        conn.commit()

pages_remaining = True
getData()
while pages_remaining:
    try:
        next_link = browser.find_element_by_xpath('//*[@id="paginga"]/div/a[text()="Next"]')
        next_link.click()
        getData()
    except NoSuchElementException:
        pages_remaining = False
        browser.quit()
# End Selenium
conn.close()
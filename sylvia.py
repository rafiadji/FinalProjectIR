import selenium
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.common.exceptions import NoSuchElementException

browser = webdriver.Chrome()

# tribunnews

browser.get('http://www.tribunnews.com/tag/malang')

def getData():
    judulLinks = browser.find_elements_by_css_selector('.mr140>h3>a')
    for judulLink in judulLinks :
        judul = judulLink.text
        print(judul)

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
# detik.com

# browser.get('https://news.detik.com/')

# judulLinks = browser.find_elements_by_css_selector('.desc_nhl>a>h2')
# for judulLink in judulLinks :
#     judul = judulLink.text
#     print(judul)

# Reference

# browser.get('http://stiki.ac.id/')

# searchLink = browser.find_element_by_class_name('fusion-main-menu-icon')
# searchLink.click()

# searchInput = browser.find_element_by_class_name('s')
# searchInput.send_keys('kemahasiswaan' + Keys.RETURN)

# judulLinks = browser.find_elements_by_css_selector('h2.entry-title>a')
# for judulLink in judulLinks :
#     judul = judulLink.text
#     print(judul)
# browser.quit()
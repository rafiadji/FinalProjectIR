import pymysql

# Konfigurasi Database
conn = pymysql.connect(host="localhost", user="root", password="", db="db_clickbait")

myCursor = conn.cursor()

# Query
judul = "Strategi Susi Berantas Sampah Plastik di Laut"
myCursor.execute("INSERT INTO judul(judul_berita) VALUES('"+ judul +"')")
print(" > Data Berhasil Masuk")

conn.commit()
conn.close()
from flask import Flask, render_template, request, redirect, url_for
import sqlite3

app = Flask(__name__)

# Fungsi untuk menghubungkan ke database
def connect_db():
    return sqlite3.connect('koperasi_pegawai.db')

# Halaman utama
@app.route('/')
def index():
    conn = connect_db()
    cursor = conn.cursor()
    
    # Ambil data customer
    cursor.execute("SELECT * FROM customer")
    customers = cursor.fetchall()
    
    # Ambil data item
    cursor.execute("SELECT * FROM item")
    items = cursor.fetchall()
    
    conn.close()
    return render_template('index.html', customers=customers, items=items)

# Menambah customer
@app.route('/add_customer', methods=['POST'])
def add_customer():
    name = request.form['customerName']
    address = request.form['customerAddress']
    phone = request.form['customerPhone']
    
    conn = connect_db()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO customer (name, address, phone) VALUES (?, ?, ?)", (name, address, phone))
    conn.commit()
    conn.close()
    
    return redirect(url_for('index'))

# Menambah item
@app.route('/add_item', methods=['POST'])
def add_item():
    name = request.form['itemName']
    price = request.form['itemPrice']
    
    conn = connect_db()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO item (name, price) VALUES (?, ?)", (name, price))
    conn.commit()
    conn.close()
    
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)
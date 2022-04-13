from multiprocessing import connection
import string
import mysql.connector 

class BotDB:

    def __init__(self, db_file):
        self.db_file = db_file
        self.conn = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            port="3306",
            database=db_file
        )
        self.cursor = self.conn.cursor()

    def user_exists(self, user_id):
        """Проверяем, есть ли юзер в базе"""
        result = self.cursor.execute(f"SELECT telegram_id FROM users WHERE telegram_id = {user_id}")
        data = self.cursor.fetchone()
        if (data is None):
            return False
        return True

    def check_user_exists(self, user_id):
        """Проверяем, есть ли юзер в базе и его статус"""
        try:
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(f"SELECT * FROM users WHERE telegram_id = {user_id}")
            result = cursor.fetchone()
            connection.close()
            return result
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))


    def add_address(self, address):
        """Добавляем адрес в базу"""
        try:
            sql = f"INSERT INTO addresses (address) VALUES ('{address}')"
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(sql)
            connection.commit()
            connection.close()
            return True
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return False

    def selectId_Address(self, address):
        """Получаем ID адреса"""
        try:
            sql = f"SELECT * FROM addresses WHERE address = '{address}'"
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(sql)
            id_Ad = cursor.fetchone()
            connection.commit()
            connection.close()
            return id_Ad[0] if id_Ad != None else -1
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return -2


    def add_user(self, name, surname, patronymic, user_phone, user_addr, user_id):
        """Добавляем юзера в базу"""
        try:
            sql = "INSERT INTO users (name, surname, patronymic, phone_number, id_address, telegram_id, approved, id_role, id_essence) VALUES (%s, %s, %s, %s, %s, %s, 0, 1, 1)"
            val = ( surname, name, patronymic, user_phone, user_addr, user_id)
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(sql, val)
            connection.commit()
            connection.close()
            return True
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return False

    def get_message(self, id_message: string):
        try:
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(f"SELECT * FROM messages WHERE id_message = '{id_message}'")
            result = cursor.fetchone()
            connection.close()
            return result[1]
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return None

    def check_cars(self, model, num_car, tuser_id, formatted_date):
        """Добавляем юзера в базу"""
        try:
            sql = "INSERT INTO reg_cars (num_car, model, id_user, dateTime_order, approved) VALUES (%s, %s, %s, %s, 0)"
            val = (model, num_car, tuser_id, formatted_date)
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(sql, val)
            connection.commit()
            connection.close()
            return True
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return False


    def selectId_User(self, tuser_id):
        """Получаем ID адреса"""
        try:
            sql = f"SELECT * FROM users WHERE telegram_id = '{tuser_id}'"
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(sql)
            id_Ad = cursor.fetchone()
            connection.commit()
            connection.close()
            return id_Ad[0] if id_Ad != None else -1
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return -2
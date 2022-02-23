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
        result = self.cursor.execute(f"SELECT id_telegramm FROM users WHERE id_telegramm = {user_id}")
        data = self.cursor.fetchone()
        if (data is None):
            return False
        return True

    def check_user_exists(self, user_id):
        """Проверяем, есть ли юзер в базе и его статус"""
        try:
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(f"SELECT * FROM users WHERE id_telegramm = {user_id}")
            result = cursor.fetchone()
            connection.close()
            return result
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))

    def add_user(self, user_name, user_phone, user_addr, user_id):
        """Добавляем юзера в базу"""
        try:
            sql = "INSERT INTO users (name, phone_number, lot_number, id_telegramm, approved) VALUES (%s, %s, %s, %s, 0)"
            val = (user_name, user_phone, user_addr, user_id)
            connection = mysql.connector.connect(user='root', passwd="", port="3306", host="localhost", database=self.db_file)
            cursor = connection.cursor()
            cursor.execute(sql, val)
            connection.commit()
            connection.close()
            return True
        except mysql.connector.Error as err:
            print("Something went wrong: {}".format(err))
            return False

    def add_record(self, user_id, operation, value):
        """Создаем запись о доходах/расходах"""
        self.cursor.execute("INSERT INTO `records` (`users_id`, `operation`, `value`) VALUES (?, ?, ?)",
            (self.get_user_id(user_id),
            operation == "+",
            value))
        return self.conn.commit()

    def get_records(self, user_id, within = "all"):
        """Получаем историю о доходах/расходах"""

        if(within == "day"):
            result = self.cursor.execute("SELECT * FROM `records` WHERE `users_id` = ? AND `date` BETWEEN datetime('now', 'start of day') AND datetime('now', 'localtime') ORDER BY `date`",
                (self.get_user_id(user_id),))
        elif(within == "week"):
            result = self.cursor.execute("SELECT * FROM `records` WHERE `users_id` = ? AND `date` BETWEEN datetime('now', '-6 days') AND datetime('now', 'localtime') ORDER BY `date`",
                (self.get_user_id(user_id),))
        elif(within == "month"):
            result = self.cursor.execute("SELECT * FROM `records` WHERE `users_id` = ? AND `date` BETWEEN datetime('now', 'start of month') AND datetime('now', 'localtime') ORDER BY `date`",
                (self.get_user_id(user_id),))
        else:
            result = self.cursor.execute("SELECT * FROM `records` WHERE `users_id` = ? ORDER BY `date`",
                (self.get_user_id(user_id),))

        return result.fetchall()

    def close(self):
        """Закрываем соединение с БД"""

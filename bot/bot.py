from aiogram import executor
import aiogram
from dispatcher import dp
import personal_actions

from db import BotDB
BotDB = BotDB('pass_system')

if __name__ == "__main__":
    executor.start_polling(dp, skip_updates=True)

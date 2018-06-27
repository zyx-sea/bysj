import json
import random

from django.db import models

# Create your models here.
from mongoengine import *
from mongoengine import connect

connect('cate_search', host='127.0.0.1', port=27017)


# 定义全部地址类
class Adress(Document):
    index = IntField()  # 数据库中的属性
    adress = StringField()
    meta = {'collection': 'sheet_tab'}  # 读取本地数据库


# 定义美食类型
class Bcategory(Document):
    _id = StringField()
    # 类型编号
    id = IntField()
    # 小类型
    category = StringField()
    # 大类型
    bcategory = StringField()
    # 对应数据库中的表
    meta = {'collection': 'bcategory'}


# 定义城市
class Badress(Document):
    _id = StringField()
    id = IntField()
    badress = StringField()  # 区域属性
    meta = {'collection': 'badress'}


# 定义全部商家信息类
class Message(Document):
    _id = StringField()
    name = StringField()
    ipadress = StringField()
    image = StringField()
    evaluate = StringField()
    grade = FloatField()
    comments = IntField()
    bcategory_id = IntField()
    adress = StringField()
    price = IntField()
    longitude = FloatField()
    latitude = FloatField()
    badress_id = IntField()
    meta = {'collection': 'message'}

# 筛选
# for item in Message.objects.filter(badress='莘县'):
# i=1
# if i>0:
#     for item in Message.objects((Q(bcategory_id=i)|Q(bcategory_id=2))&Q(badress_id=5)):
#         print(item.name)
# 排序（升序）
# for item in Message.objects.order_by('price'):
#     print(item.price)

# i=1
# while i<13 :
#     print("style"+str(i))
#     i=i+1

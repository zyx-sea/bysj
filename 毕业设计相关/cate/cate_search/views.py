from django.core.paginator import Paginator
from django.http import HttpResponse
from django.shortcuts import render
import json
# Create your views here.
from cate_search.models import Adress, Message
from mongoengine import *


# 主页
def index(request):
    # 分页设置
    limit = 6
    message_info = Message.objects
    pageinatior = Paginator(message_info, limit)
    page = request.GET.get('page', 1)
    loaded = pageinatior.page(page)
    message = []
    for item in Message.objects:
        message.append([item.longitude, item.latitude, item.name, item.adress, item.ipadress])
    return render(request, 'index.html', {'context': loaded, 'messages': message})


# 批量地址解析
def trans_all(request):
    list = []
    for item in Message.objects:
        list.append(item.adress)
    return render(request, 'trans_all.html', {'list': json.dumps(list)})


# 按照价格升序排列
def des_price(request):
    # 分页设置
    limit = 6
    message_info = Message.objects.order_by('price')
    pageinatior = Paginator(message_info, limit)
    page = request.GET.get('page', 1)
    loaded = pageinatior.page(page)
    message = []
    for item in Message.objects.order_by('price'):
        message.append([item.longitude, item.latitude, item.name, item.adress, item.ipadress])
    return render(request, 'index.html', {'context': loaded, 'messages': message})


# 按照价格降序排列
def aes_price(request):
    # 分页设置
    limit = 6
    message_info = Message.objects.order_by('-price')
    pageinatior = Paginator(message_info, limit)
    page = request.GET.get('page', 1)
    loaded = pageinatior.page(page)
    message = []
    for item in Message.objects.order_by('price'):
        message.append([item.longitude, item.latitude, item.name, item.adress, item.ipadress])
    return render(request, 'index.html', {'context': loaded, 'messages': message})


# 按照评分降序排列
def des_grade(request):
    # 分页设置
    limit = 6
    message_info = Message.objects.order_by('-grade')
    pageinatior = Paginator(message_info, limit)
    page = request.GET.get('page', 1)
    loaded = pageinatior.page(page)
    message = []
    for item in Message.objects.order_by('-grade'):
        message.append([item.longitude, item.latitude, item.name, item.adress, item.ipadress])
    return render(request, 'index.html', {'context': loaded, 'messages': message})


# 按照区域和类型检索
def by_type_area(request):
    area = int(request.GET['area'])
    type1 = int(request.GET['type1'])
    type2 = int(request.GET['type2'])
    i = 1
    # 分页设置
    limit = 6
    message_info = Message.objects(Q(badress_id=area) & (Q(bcategory_id=type1) | Q(bcategory_id=type2)))
    pageinatior = Paginator(message_info, limit)
    page = request.GET.get('page', 1)
    loaded = pageinatior.page(page)
    message = []
    for item in Message.objects(Q(badress_id=area) & (Q(bcategory_id=type1) | Q(bcategory_id=type2))):
        message.append([item.longitude, item.latitude, item.name, item.adress, item.ipadress])
    return render(request, 'index.html', {'context': loaded, 'messages': message})


# 聚类可视化页
def cluster(request):
    message = []
    for item in Message.objects:
        message.append([item.longitude, item.latitude, item.name, item.adress, item.ipadress])
    return render(request, 'cluster.html', {'messages': message})


# 热力图可视化页
def heatmap(request):
    message = []
    for item in Message.objects:
        message.append([item.longitude, item.latitude])
    return render(request, 'heatmap.html', {'messages': message})


def add(request):
    return render(request, 'add.html')


def add2(request):
    a = request.GET['a']
    b = request.GET['b']
    a = int(a)
    b = int(b)
    return HttpResponse(str(a + b))

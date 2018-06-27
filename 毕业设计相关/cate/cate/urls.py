"""cate URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/2.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.conf.urls import url
from django.contrib import admin
from django.urls import path

from cate_search import views

urlpatterns = [
    url(r'^admin/', admin.site.urls),
    # url(r"^$",views.index),
    path('', views.index),
    path('by_type_area',views.by_type_area),
    # url(r"^$", views.add),
    # url(r"^add2/$", views.add2),
    path('trans_all/', views.trans_all),
    path('des_price/', views.des_price),
    path('aes_price/', views.aes_price),
    path('des_grade/', views.des_grade),
    path('trans_all/', views.trans_all),
    path('cluster/', views.cluster),
    path('heatmap/', views.heatmap)
]

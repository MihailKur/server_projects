from django.conf import settings
from django.conf.urls.static import static
from django.urls import path

from . import views

urlpatterns = [
    path("", views.index, name="index"),
    path("meal", views.meal, name="meal"),
    path("cafes", views.cafes, name="cafes"),
    path("graphs", views.graphs, name="graphs"),
    path("meal/all", views.rest_meal, name="rest_meal"),
    path("meal/<int:meal_id>", views.meal_id, name="meal_id"),
    path("cafes/all", views.rest_cafes, name="rest_cafes"),
    path("cafes/<int:cafes_id>", views.cafes_id, name="cafes_id"),
    path("pdf_list", views.pdfloaded, name="pdfloaded"),
    path("pdf_loader", views.pdfloader_site, name="pdfloader"),
]

if settings.DEBUG:
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)

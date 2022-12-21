from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import render

from .forms import pdfloaderForm
from .graphs import get_graph
from .models import Meal, Cafe, pdfloader


def index(request):
    return render(request, "site_library/index.html")


def meal(request):
    context = {"meal": Meal.objects.all()}
    return render(request, "site_library/meal.html", context)


def cafes(request):
    context = {"cafes": Cafe.objects.all()}
    return render(request, "site_library/cafes.html", context)


def graphs(request):
    graphs_dict = get_graph(20)
    context = {"graphs": graphs_dict}
    return render(request, "site_library/graphs.html", context)


def rest_meal(request):
    meals = Meal.objects.all()
    meals = " ".join(meal.__str__() for meal in meals)
    return HttpResponse(meals)


def meal_id(request, meal_id):
    meal = Meal.objects.get(id=meal_id)
    meal = meal.__str__()
    return HttpResponse(meal)


def rest_cafes(request):
    cafes = Cafe.objects.all()
    cafes = " ".join(cafe.__str__() for cafe in cafes)
    return HttpResponse(cafes)


def cafes_id(request, cafes_id):
    cafe = Cafe.objects.get(id=cafes_id)
    cafe = cafe.__str__()
    return HttpResponse(cafe)


def pdfloader_site(request):
    submitted = False
    if request.method == "POST":
        form = pdfloaderForm(request.POST, request.FILES)
        if form.is_valid():
            form.save()
            return HttpResponseRedirect("/pdf_loader?submitted=True")
    else:
        form = pdfloaderForm
        if "submitted" in request.GET:
            submitted = True
    return render(
        request, "site_library/pdf_loader.html", {"form": form, "submitted": submitted}
    )


def pdfloaded(request):
    context = {"pdfs": pdfloader.objects.all()}
    return render(request, "site_library/pdf_list.html", context)

from django.db import models


class Meal(models.Model):
    name = models.CharField(max_length=100)
    price = models.CharField(max_length=100)

    def __str__(self):
        return self.name + " " + self.price


class Cafe(models.Model):
    name = models.CharField(max_length=100)
    address = models.CharField(max_length=100)

    def __str__(self):
        return self.name + " " + self.address


class pdfloader(models.Model):
    title = models.CharField(max_length=100)
    pdf = models.FileField(upload_to="pdfs/")

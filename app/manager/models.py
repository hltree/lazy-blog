from django.db import models

class Post(models.Model):
    title = models.CharField(max_length=128)
    published = models.DateTimeField()
    image = models.ImageField(upload_to = 'uploads', null=True, blank=True)
    content = models.TextField()

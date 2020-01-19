from django.db import models
from markdownx.models import MarkdownxField

class Post(models.Model):
    title = models.CharField(max_length=128)
    published = models.DateTimeField()
    image = models.ImageField(upload_to = 'uploads', null=True, blank=True)
    content = MarkdownxField('Content', help_text='Please write Markdown format.')

from django.db import models
from markdownx.models import MarkdownxField

class Post(models.Model):
    title = models.CharField(max_length=128)
    published = models.DateTimeField()
    content = MarkdownxField('Content', help_text='Please write Markdown format. header content start for h3.')

from django.shortcuts import render, redirect, get_object_or_404
from django.views.generic import TemplateView
from manager.models import *

#get_object_or_404()

class index(TemplateView):
    template_name = "index.html"

    def get(self, request, *args, **kwargs):
        context = super(index, self).get_context_data(**kwargs)
        
        posts = Post.objects.all()
        context['posts'] = posts
        
        return render(self.request, self.template_name, context)

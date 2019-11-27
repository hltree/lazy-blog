from django.shortcuts import render, redirect, get_object_or_404
from django.views.generic import TemplateView
from manager.models import *

class index(TemplateView):
    template_name = 'index.html'

    def get(self, request, *args, **kwargs):
        context = super(index, self).get_context_data(**kwargs)

        posts = Post.objects.all()
        context['posts'] = posts

        return render(self.request, self.template_name, context)

class post_detail(TemplateView):
    template_name = 'post_detail.html'

    def get(self, request, post_id):
        post = get_object_or_404(Post, pk=post_id)

        return render(self.request, self.template_name, {'post': post})

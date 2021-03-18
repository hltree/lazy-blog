FROM python:3.7-alpine

WORKDIR /usr/src/app

ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1

RUN pip install --upgrade pip \
    && pip install pipenv

COPY ./data/Pipfile /usr/src/app/Pipfile
COPY ./data/Pipfile.lock /usr/src/app/Pipfile.lock

RUN pipenv install --system --dev

COPY ./data /usr/src/app/

{% extends 'dashboard/base.html' %}
{% load static %}
{% load tz %}

{% block title %}
<title>Transaction Details</title>
{% endblock %}

{% block style %}
<style>
</style>
{% endblock %}

{% block content %}
<div class="card-details mt-5">
    <div class="col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header">
            <h4>Transaction Details</h4>
            </div>
            <div class="card-body">
            <div class="py-4">
                <p class="clearfix">
                <span class="float-left">
                    Transaction Type
                </span>
                <span class="float-right text-muted">
                    {% if transaction.from_user == request.user %}
                    Debit
                    {% elif transaction.to_user == request.user %}
                    Credit
                    {% endif %}
                </span>
                </p>
                <p class="clearfix">
                <span class="float-left">
                    Description
                </span>
                <span class="float-right text-muted">
                    {{transaction.get_description_display}}
                </span>
                </p>
                {% if transaction.description == 'transfer' %}
                <p class="clearfix">
                <span class="float-left">
                    Issuer
                </span>
                <span class="float-right text-muted">
                    {{transaction.from_user}}
                </span>
                </p>
                <p class="clearfix">
                <span class="float-left">
                    Recipient
                </span>
                <span class="float-right text-muted">
                    {{transaction.to_user}}
                </span>
                </p>
                {% else %}
                <p class="clearfix">
                <span class="float-left">
                    Customer
                </span>
                <span class="float-right text-muted">
                    {% if transaction.from_user == request.user %}
                        transaction.from_user
                    {% elif transaction.to_user == request.user %}
                        transaction.to_user
                    {% endif %}
                </span>
                </p>
                {% endif %}
                <p class="clearfix">
                <span class="float-left">
                    Amount
                </span>
                <span class="float-right text-muted">
                    {{transaction.transaction_amount}}
                </span>
                </p>
                {% if transaction.remark %}
                <p class="clearfix">
                <span class="float-left">
                    Remark
                </span>
                <span class="float-right text-muted">
                    {{transaction.remark|truncatewords:5}}
                </span>
                </p>
                {% endif %}
                <p class="clearfix">
                <span class="float-left">
                    Session ID
                </span>
                <span class="float-right text-muted">
                    {{transaction.session_id}}
                </span>
                </p>
                <p class="clearfix">
                <span class="float-left">
                    Transaction Number
                </span>
                <span class="float-right text-muted">
                    {{transaction.transaction_number}}
                </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                        Transaction Date
                    </span>
                    <span class="float-right text-muted">
                        {{transaction.timestamp|timezone:request.user.timezone}}
                    </span>
                </p>
                <p class="clearfix">
                    <span class="float-left">
                        Status
                    </span>
                    <span class="float-right text-muted">
                        {% if transaction.status == 'successful' %}
                        <span class="badge badge-success">{{transaction.get_status_display|upper}}</span>
                        {% elif transaction.status == 'pending' %}
                        <span class="badge badge-warning">{{transaction.get_status_display|upper}}</span>
                        {% else %}
                        <span class="badge badge-danger">{{transaction.get_status_display|upper}}</span>
                        {% endif %}
                    </span>
                </p>
            </div>

            <div class="text-md-left">
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
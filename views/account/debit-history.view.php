{% extends 'dashboard/base.html' %}
{% load static %}
{% load tz %}

{% block style %}
<style>
    .pagination-container {
        display: flex;
        justify-content:center;
        align-items: center;
    }
</style>
{% endblock %}

{% block content %}
<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header">
          <h4>Debit History</h4>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th class="text-center">
                  <div class="custom-checkbox custom-checkbox-table custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                      class="custom-control-input" id="checkbox-all">
                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                  </div>
                </th>
                <th>Date/Time</th>
                <th>Amount</th>
                <th>Transaction Type</th>
                <th>Description</th>
                <th>Recipient</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              {% for transaction in transactions %}
              <tr>
                <td class="p-0 text-center">
                  <div class="custom-checkbox custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                      id="checkbox-1">
                    <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                  </div>
                </td>
                <td>{{transaction.timestamp|timezone:request.user.timezone}}</td>
                <td>{{transaction.amount}}</td>
                <td>
                  {% if transaction.from_user == request.user %}
                  Debit
                  {% elif transaction.to_user == request.user %}
                  Credit
                  {% endif %}
                </td>
                <td>{{transaction.get_description_display}}</td>
                <td>
                  {% if transaction.to_user %}
                  {{transaction.to_user|upper}}
                  {% else %}
                  -
                  {% endif %}
                </td>
                <td class="status">
                  {% if transaction.status == 'successful' %}
                  <div class="badge badge-success">{{transaction.get_status_display|upper}}</div>
                  {% elif transaction.status == 'pending' %}
                  <div class="badge badge-warning">{{transaction.get_status_display|upper}}</div>
                  {% else %}
                  <div class="badge badge-danger">{{transaction.get_status_display|upper}}</div>
                  {% endif %}
                </td>
                <td><a href="{% url 'banking:transaction' transaction.id %}" class="btn btn-outline-primary">View</a></td>
              </tr>
              {% endfor %}
            </table>
          </div>
        </div>

        
        <div class="card-body pagination-container">
            <div class="buttons" style="text-align: right !important;">
              <nav aria-label="Page navigation example">
                <span>Showing Page <b>{{ transactions.number }}</b> 0f <b>{{ transactions.paginator.num_pages }}</b></span>
                <ul class="pagination">
                  {% if transactions.has_previous %}
                  <li class="page-item">
                    <a class="page-link" href="?page={{transactions.previous_page_number}}" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  {% else %}
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  {% endif %}


                  <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ transactions.number }}</a></li>

                  {% if transactions.has_previous %}
                  <li class="page-item">
                    <a class="page-link" href="?page={{transactions.next_page_number}}" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                  {% else %}
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                  {% endif %}
                </ul>
              </nav>
            </div>
          </div>
      </div>
    </div>
  </div>
{% endblock %}
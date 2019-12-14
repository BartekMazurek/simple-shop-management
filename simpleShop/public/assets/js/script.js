$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    setInitialFilterValues();
    getInitialReport();
});

$('#submitFilter').on('click', function(event) {
    event.preventDefault();
    let reportType = $('#reportType').val();
    let dateFromValue = $('#dateFrom').val();
    let dateToValue = $('#dateTo').val();

    if (dateFromValue.length == 10 && dateToValue.length == 10) {
        if (reportType) {
            let clientType = getClientType();
            switch (reportType) {
                case 'overall':
                    clearOverallResults();
                    fetchOverallReport(dateFromValue, dateToValue);
                    break;
                case 'clients':
                    clearClientsResults();
                    fetchClientsReport(dateFromValue, dateToValue, clientType);
                    break;
                case 'orders':
                    clearOrdersList();
                    fetchOrdersList(dateFromValue, dateToValue, clientType);
                    break;
            }
        }
    }
});

$(document).on('click', '.btn-edit', function() {
    disableEditButtons();
    disableFilterButton();
    createSaveButton($(this));
    makeRowEditable($(this));
    setEditedOrderSessionStorage($(this).data('order-id'));
});

$(document).on('click', '#btn-save', function() {
    saveEditedOrderValues();
    unsetEditedOrderSessionStorage();
    enableEditButtons();
    enableFilterButton();
    hideSaveButton();
    hideEditableFields();
});

function saveEditedOrderValues() {
    let orderId = getEditedOrderSessionStorage();
    let editedStatus = $('#editedStatus').val();
    let editedModifiedAt = $('#editedModifiedAt').val();
    $.ajax({
        type:'POST',
        url:'saveOrderDetails',
        data: {
            orderId: orderId,
            editedStatus: editedStatus,
            editedModifiedAt: editedModifiedAt
        },
        success:function(data){
            if (data == 'ok') {
                showSuccessMsg();
            } else {
                showErrorMsg();
            }
        },
        error: function(error) {
            showErrorMsg();
        }
    });
}

function showSuccessMsg() {
    let alertRow = document.querySelector('#alert-row');
    let msg = document.createElement('div');
    msg.classList.add('alert', 'alert-success');
    msg.innerHTML = 'Changes has been saved';
    alertRow.append(msg);
}

function showErrorMsg() {
    let alertRow = document.querySelector('#alert-row');
    let msg = document.createElement('div');
    msg.classList.add('alert', 'alert-danger');
    msg.innerHTML = 'An error has occurred';
    alertRow.append(msg);
}

function makeRowEditable(editButton) {
    let currentRow = editButton.closest('tr');
    let rowColumns = currentRow[0].cells;
    makeStatusEditable(rowColumns);
    makeLastModifiedEditable(rowColumns);
}

function makeStatusEditable(rowColumns) {
    let statusColumnValue = rowColumns[3].innerHTML;
    rowColumns[3].innerHTML = '';
    let statusSelect = document.createElement('select');
    statusSelect.id = 'editedStatus';
    statusSelect.classList.add('form-control');
    let statuses = getStatusNameByValue(0);

    for (let i=0; i < statuses.length; i++) {
        let statusOption = document.createElement('option');
        statusOption.value = i + 1;
        statusOption.innerHTML = statuses[i];
        if (statusColumnValue == statuses[i]) {
            statusOption.selected = true;
        }
        statusSelect.append(statusOption);
    }
    rowColumns[3].append(statusSelect);
}

function makeLastModifiedEditable(rowColumns) {
    let modifiedColumnValue = rowColumns[4].innerHTML;
    rowColumns[4].innerHTML = '';
    let modifiedColumnInput = document.createElement('input');
    modifiedColumnInput.type = 'date';
    modifiedColumnInput.id = 'editedModifiedAt';
    modifiedColumnInput.classList.add('form-control');
    modifiedColumnInput.value = modifiedColumnValue;
    rowColumns[4].append(modifiedColumnInput);
}

function hideSaveButton() {
    $('#btn-save').remove();
}

function hideEditableFields() {

    let statusColumnValue = $('#editedStatus').val();
    let modifiedAtColumnValue = $('#editedModifiedAt').val();
    let statusColumn = $('#editedStatus').closest('td');
    let modifiedAtColumn = $('#editedModifiedAt').closest('td');

    $('#editedStatus').remove();
    $('#editedModifiedAt').remove();

    statusColumn.append(document.createTextNode(getStatusNameByValue(statusColumnValue)));
    modifiedAtColumn.append(document.createTextNode(modifiedAtColumnValue));
}

function getStatusNameByValue(value) {
    let statuses = ['Opened', 'Collecting', 'Sent', 'Finished'];
    if (value > 0) {
        let position = value - 1;
        return statuses[position];
    } else {
        return statuses;
    }
}

function createSaveButton(editButton) {
    let currentColumn = editButton.closest('td');
    let saveButton = document.createElement('button');
    saveButton.classList.add('btn', 'btn-success', 'btn-sm', 'btn-save');
    saveButton.innerHTML = 'SAVE';
    saveButton.id = 'btn-save';
    currentColumn.append(saveButton);
}

function getEditedOrderSessionStorage() {
    return sessionStorage.getItem('editedOrderId');
}

function setEditedOrderSessionStorage(orderId) {
    sessionStorage.setItem('editedOrderId', orderId);
}

function unsetEditedOrderSessionStorage() {
    sessionStorage.removeItem('editedOrderId');
}

function disableEditButtons() {
    $('.btn-edit').attr('disabled', true);
}

function enableEditButtons() {
    $('.btn-edit').attr('disabled', false);
}

function disableFilterButton() {
    $('#submitFilter').attr('disabled', true);
}

function enableFilterButton() {
    $('#submitFilter').attr('disabled', false);
}

function getInitialReport() {
    let reportType = $('#reportType').val();
    let dateFromValue = $('#dateFrom').val();
    let dateToValue = $('#dateTo').val();
    if (reportType) {
        let clientType = getClientType();
        switch (reportType) {
            case 'overall':
                fetchOverallReport(dateFromValue, dateToValue);
                break;
            case 'clients':
                fetchClientsReport(dateFromValue, dateToValue, clientType);
                break;
            case 'orders':
                fetchOrdersList(dateFromValue, dateToValue, clientType);
                break;
        }
    }
}

function fetchOverallReport(dateFrom, dateTo) {
    $.ajax({
        type:'POST',
        url:'overallReport',
        data: {
            dateFrom: dateFrom,
            dateTo: dateTo
        },
        success:function(data){
            results = JSON.parse(data);
            showOverallResults(results);
        }
    });
}

function showOverallResults(results) {
    if (results && results.length > 0) {
        let overallTable = document.querySelector('#overallReportTable');
        let overallTableBody = overallTable.tBodies[0];

        for (let i=0; i < results.length; i++) {
            let newRow = document.createElement('tr');
            let countColumn = document.createElement('td');
            let amountColumn = document.createElement('td');
            let groupColumn = document.createElement('td');

            let countValue = document.createTextNode(results[i]['ordersCount']);
            let amountValue = document.createTextNode(results[i]['ordersValue']);
            let groupValue = document.createTextNode(results[i]['groupName']);

            countColumn.append(countValue);
            amountColumn.append(amountValue);
            groupColumn.append(groupValue);

            newRow.append(countColumn, groupColumn, amountColumn);
            overallTableBody.append(newRow);
        }
    }
}

function clearOverallResults() {
    let overallTable = document.querySelector('#overallReportTable');
    let overallTableBody = overallTable.tBodies[0];

    while (overallTableBody.firstChild) {
        overallTableBody.firstChild.remove();
    }
}

function fetchClientsReport(dateFrom, dateTo, clientType) {
    $.ajax({
        type:'POST',
        url:'clientsReport',
        data: {
            dateFrom: dateFrom,
            dateTo: dateTo,
            clientType: clientType
        },
        success:function(data){
            results = JSON.parse(data);
            showClientResults(results);
        }
    });
}

function showClientResults(results) {
    if (results && results.length > 0) {
        let clientsTable = document.querySelector('#clientsReportTable');
        let clientsTableBody = clientsTable.tBodies[0];

        for (let i=0; i < results.length; i++) {
            let newRow = document.createElement('tr');
            let idColumn = document.createElement('td');
            let nameColumn = document.createElement('td');
            let ordersCountColumn = document.createElement('td');
            let ordersValueColumn = document.createElement('td');

            let idValue = document.createTextNode(results[i]['id']);
            let nameValue = document.createTextNode(results[i]['name']);
            let ordersCountValue = document.createTextNode(results[i]['ordersCount']);
            let ordersValue = document.createTextNode(results[i]['ordersValue']);

            idColumn.append(idValue);
            nameColumn.append(nameValue);
            ordersCountColumn.append(ordersCountValue);
            ordersValueColumn.append(ordersValue);

            newRow.append(idColumn, nameColumn, ordersCountColumn, ordersValueColumn);
            clientsTableBody.append(newRow);
        }
    }
}

function clearClientsResults() {
    let clientsTable = document.querySelector('#clientsReportTable');
    let clientsTableBody = clientsTable.tBodies[0];

    while (clientsTableBody.firstChild) {
        clientsTableBody.firstChild.remove();
    }
}

function fetchOrdersList(dateFrom, dateTo, clientType) {
    console.log('wysylam' + dateFrom + dateTo + clientType);
    $.ajax({
        type:'POST',
        url:'ordersList',
        data: {
            dateFrom: dateFrom,
            dateTo: dateTo,
            clientType: clientType
        },
        success:function(data) {
            results = JSON.parse(data);
            showOrdersList(results);
        }
    });
}

function showOrdersList(results) {
    if (results && results.length > 0) {
        let ordersTable = document.querySelector('#ordersTable');
        let ordersTableBody = ordersTable.tBodies[0];

        for (let i=0; i < results.length; i++) {
            let newRow = document.createElement('tr');

            let orderIdColumn = document.createElement('td');
            let clientIdColumn = document.createElement('td');
            let clientNameColumn = document.createElement('td');
            let orderStatusColumn = document.createElement('td');
            let lastModifiedColumn = document.createElement('td');
            let editColumn = document.createElement('td');

            let orderIdValue = results[i]['orderId'];
            let clientIdValue = results[i]['clientId'];
            let clientNameValue = results[i]['clientName'];
            let orderStatusValue = results[i]['statusName'];
            let lastModifiedValue = results[i]['lastModified'];

            let editButton = document.createElement('button');
            editButton.innerHTML = 'EDIT';
            editButton.dataset.orderId = results[i]['orderId']
            editButton.classList.add('btn', 'btn-primary', 'btn-sm', 'btn-edit');

            orderIdColumn.append(orderIdValue);
            clientIdColumn.append(clientIdValue);
            clientNameColumn.append(clientNameValue);
            orderStatusColumn.append(orderStatusValue);
            lastModifiedColumn.append(lastModifiedValue);
            editColumn.append(editButton);

            newRow.append(orderIdColumn, clientIdColumn, clientNameColumn, orderStatusColumn, lastModifiedColumn, editColumn);
            ordersTableBody.append(newRow);
        }
    }
}

function clearOrdersList() {
    let ordersTable = document.querySelector('#ordersTable');
    let ordersTableBody = ordersTable.tBodies[0];

    while (ordersTableBody.firstChild) {
        ordersTableBody.firstChild.remove();
    }
}

function getClientType() {
    let clientType = $('#clientType').val();
    return clientType;
}

function setInitialFilterValues() {
    $('#dateFrom').val(getFirstDayOfYear());
    $('#dateTo').val(getLastDayOfYear());
}

function getFirstDayOfYear() {
    return moment().startOf('year').format('YYYY-MM-DD');
}

function getLastDayOfYear() {
    return moment().endOf('year').format('YYYY-MM-DD');
}

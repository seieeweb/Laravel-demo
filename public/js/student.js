function addStudentRow(id, name, phone, birthday) {
    $('tbody').append('<tr id="student-' + id + '"> \
                    <th scope="row" class="col-md-2">' + id + '</th> \
                    <td class="col-md-2">' + escapeHtml(name) + '</td> \
                    <td class="col-md-2">' + phone + '</td> \
                    <td class="col-md-2">' + birthday + '</td> \
                    <td class="col-md-2">' + calculateAge(birthday) + '</td> \
                    <td class="col-md-2"> \
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateDialog" data-id="' + id + '"> \
                            <span class="glyphicon glyphicon-edit"></span> \
                        </button> \
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDialog" data-id="' + id + '"> \
                            <span class="glyphicon glyphicon-trash"></span> \
                        </button> \
                    </td> \
                </tr>');
}

function addStudentCallback(data, status, newName, newPhone, newBirthday) {
    $('#addStatus').removeClass('hidden');
    if (data.result == 'success') {
        $('#addStatus').html(shortSuccessText('添加学生成功！', true));
        setTimeout(function () {
            $('#addDialog').modal('hide');
            $('#addStudentName').val('');
            $('#addStudentPhone').val('');
            $('#addStudentBirthday').val('');
        }, 1000);
        addStudentRow(data.id, newName, newPhone, newBirthday);
    }
    else {
        $('#btnAddStudent').removeAttr('disabled');
        if (data.msg)
            $('#addStatus').html(shortFailText(data.msg, true));
        else if (status != 'success')
            $('#addStatus').html(shortFailText(status, true));
        else
            $('#addStatus').html(shortFailText('发生未知错误', true));
    }
}

function updateStudentCallback(data, status, id, newName, newPhone, newBirthday) {
    $('#updateStatus').removeClass('hidden');
    if (data.result == 'success') {
        $('#updateStatus').html(shortSuccessText('修改学生信息成功！', true));
        setTimeout(function () {
            $('#updateDialog').modal('hide');
        }, 1000);
        $('#student-' + id).children().first().next().text(newName);
        $('#student-' + id).children().first().next().next().text(newPhone);
        $('#student-' + id).children().first().next().next().next().text(newBirthday);
        $('#student-' + id).children().first().next().next().next().next().text(calculateAge(newBirthday));
    }
    else {
        $('#btnUpdateStudent').removeAttr('disabled');
        if (data.msg)
            $('#updateStatus').html(shortFailText(data.msg, true));
        else if (status != 'success')
            $('#updateStatus').html(shortFailText(status, true));
        else
            $('#updateStatus').html(shortFailText('发生未知错误', true));
    }
}

function deleteStudentCallback(data, status, id) {
    $('#deleteStatus').removeClass('hidden');
    if (data.result == 'success') {
        $('#deleteStatus').html(shortSuccessText('删除学生成功！'));
        setTimeout(function () {
            $('#deleteDialog').modal('hide');
        }, 1000);
        $('#student-' + id).remove();
    }
    else {
        $('#btnDeleteStudent').removeAttr('disabled');
        if (data.msg)
            $('#deleteStatus').html(shortFailText(data.msg));
        else if (status != 'success')
            $('#deleteStatus').html(shortFailText(status));
        else
            $('#deleteStatus').html(shortFailText('发生未知错误'));
    }
}

$('#addDialog').on('show.bs.modal', function () {
    $('#addStatus').addClass('hidden');
    $('#btnAddStudent').removeAttr('disabled');
});

$('#addDialog').on('shown.bs.modal', function () {
    $('#addStudentName').focus();
});

$('#btnAddStudent').click(function () {
    $('#btnAddStudent').attr('disabled', 'disabled');
    var newName = $('#addStudentName').val();
    var newPhone = $('#addStudentPhone').val();
    var newBirthday = $('#addStudentBirthday').val();
    var postData = {
        'name': newName,
        'phone': newPhone,
        'birthday': newBirthday
    };
    $.post('/api/students/add', postData, function (data, status) {
        addStudentCallback(data, status, newName, newPhone, newBirthday);
    }).fail(function (xhr, status, error) {
        addStudentCallback(tryJSONParse(xhr.responseText), newName, newPhone, newBirthday);
    });
});

$('#updateDialog').on('show.bs.modal', function (event) {
    var updateId = $(event.relatedTarget).data('id');
    var updateName = $('#student-' + updateId).children().first().next().text();
    var updatePhone = $('#student-' + updateId).children().first().next().next().text();
    var updateBirthday = $('#student-' + updateId).children().first().next().next().next().text();
    $('#updateStudentId').val(updateId);
    $('#updateStudentName').val(updateName);
    $('#updateStudentPhone').val(updatePhone);
    $('#updateStudentBirthday').val(updateBirthday);
    $('#updateStatus').addClass('hidden');
    $('#btnUpdateStudent').removeAttr('disabled');
});

$('#updateDialog').on('shown.bs.modal', function () {
    $('#updateStudentName').focus();
});

$('#btnUpdateStudent').click(function () {
    $('#btnUpdateStudent').attr('disabled', 'disabled');
    var id = $('#updateStudentId').val();
    var newName = $('#updateStudentName').val();
    var newPhone = $('#updateStudentPhone').val();
    var newBirthday = $('#updateStudentBirthday').val();
    var postData = {
        'id': id,
        'name': newName,
        'phone': newPhone,
        'birthday': newBirthday
    };
    $.post('/api/students/update', postData, function (data, status) {
        updateStudentCallback(data, status, id, newName, newPhone, newBirthday);
    }).fail(function (xhr, status, error) {
        updateStudentCallback(tryJSONParse(xhr.responseText), error, id, newName, newPhone, newBirthday);
    });
});

$('#deleteDialog').on('show.bs.modal', function (event) {
    var deleteId = $(event.relatedTarget).data('id');
    var deleteName = $('#student-' + deleteId).children().first().next().text();
    $('#deleteStudentId').val(deleteId);
    $('#deleteText').html('您确实要删除学生 <strong>' + escapeHtml(deleteName) + '</strong> 吗？');
    $('#deleteStatus').addClass('hidden');
    $('#btnDeleteStudent').removeAttr('disabled');
});

$('#btnDeleteStudent').click(function () {
    $('#btnDeleteStudent').attr('disabled', 'disabled');
    var id = $('#deleteStudentId').val();
    var postData = {'id': id};
    $.post('/api/students/delete', postData, function (data, status) {
        deleteStudentCallback(data, status, id);
    }).fail(function (xhr, status, error) {
        deleteStudentCallback(tryJSONParse(xhr.responseText), error, id);
    });
});
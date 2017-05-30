@extends('layout')

@section('title', '师生信息管理系统 - 学生管理')

@section('content')

<div class="container">
    <h1>学生管理
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDialog">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>手机</th>
                    <th>生日</th>
                    <th>年龄</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr id="{{ 'student-' . $student->id }}">
                    <th scope="row" class="col-md-2">{{ $student->id }}</th>
                    <td class="col-md-2">{{ $student->name }}</td>
                    <td class="col-md-2">{{ $student->phone }}</td>
                    <td class="col-md-2">{{ $student->birthday }}</td>
                    <td class="col-md-2">{{ $student->age }}</td>
                    <td class="col-md-2">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateDialog" data-id="{{ $student->id }}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDialog" data-id="{{ $student->id }}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="addDialog" tabindex="-1" role="dialog" aria-labelledby="addDialogLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addDialogLabel">添加学生</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="addStudentName" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addStudentName" placeholder="姓名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addStudentPhone" class="col-sm-2 control-label">手机</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addStudentPhone" placeholder="手机">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addStudentBirthday" class="col-sm-2 control-label">生日</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addStudentBirthday" placeholder="生日">
                        </div>
                    </div>
                </form>
                <p id="addStatus"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnAddStudent">添加</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateDialog" tabindex="-1" role="dialog" aria-labelledby="updateDialogLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="updateDialogLabel">修改学生信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <input type="text" class="form-control hidden" id="updateStudentId">
                    <div class="form-group">
                        <label for="updateStudentName" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateStudentName" placeholder="姓名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="updateStudentPhone" class="col-sm-2 control-label">手机</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateStudentPhone" placeholder="手机">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="updateStudentBirthday" class="col-sm-2 control-label">生日</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateStudentBirthday" placeholder="生日">
                        </div>
                    </div>
                </form>
                <p id="updateStatus"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnUpdateStudent">修改</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="deleteDialogLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteDialogLabel">删除学生</h4>
            </div>
            <div class="modal-body">
                <p id="deleteText"></p>
                <input type="text" class="form-control hidden" id="deleteStudentId">
                <p id="deleteStatus"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDeleteStudent">删除</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-content')

<script src="{{ asset('js/student.js') }}"></script>

@endsection

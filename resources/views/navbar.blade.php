<nav class="navbar navbar-fixed-top bg-info">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">师生信息管理系统</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/students') }}">学生管理</a></li>
                <li><a href="{{ url('/teachers') }}">教师管理</a></li>
            </ul>
        </div>
    </div>
</nav>
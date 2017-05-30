var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
};

function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    });
}

function tryJSONParse(s) {
    try {
        return JSON.parse(s);
    }
    catch (e) {
        return s;
    }
}

function shortSuccessText (text, is12) {
    return '<div class="' + (is12 ? 'col-md-12 ' : '') + 'text-success"><span class="glyphicon glyphicon-ok"></span> ' + text + '</div>';
}

function shortFailText (text, is12) {
    return '<div class="' + (is12 ? 'col-md-12 ' : '') + 'text-danger"><span class="glyphicon glyphicon-ban-circle"></span> ' + text + '</div>';
}

function calculateAge(birthday) {
    var birth = new Date(birthday);
    var today = new Date();
    var age = today.getFullYear() - birth.getFullYear();
    birth.setFullYear(today.getFullYear());
    if (birth > today)
        age--;
    return age;
}